<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contracts\CategoryInterface;
use App\Contracts\ItemInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\OrderInterface;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;

class CategoryController extends BaseAdminController
{
    /**
     * the catgeory service.
     *
     * @var string
     */
    public $categoryRepo;

    /**
     * the item service.
     *
     * @var string
     */
    public $itemRepo;

    /**
     * the review service.
     *
     * @var string
     */
    public $reviewRepo;

    /**
     * the newsLetter service.
     *
     * @var string
     */
    public $newsLetterRepo;

    /**
     * the order service.
     *
     * @var string
     */
    public $orderRepo;
    
    public function __construct(
                                CategoryInterface $categoryRepo,
                                ItemInterface $itemRepo,
                                ReviewInterface $reviewRepo,
                                NewsLetterInterface $newsLetterRepo,
                                OrderInterface $orderRepo
                                )
                                
    {  
        $this->categoryRepo = $categoryRepo;
        $this->itemRepo = $itemRepo;
        $this->reviewRepo = $reviewRepo; 
        $this->newsLetterRepo = $newsLetterRepo;
        $this->orderRepo = $orderRepo;       
        $this->middleware("admin");
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * categories 
     * GET admin/category/categories 
     *
     * @param Request $request
     * @return response
     */
    public function getCategories()
    {
        $categories = $this->categoryRepo->getAll();
        $main = ['Rings', 'Earrings', 'Bracelets', 'Chains', 'Crosses & Rosaries', 'Necklaces'];
        foreach($categories as $category)
        {
            if(in_array($category->category, $main))
                $category->status = '0';
            else
                $category->status = '1';

            $categoryItems = $category->item()->get();
            if(count($categoryItems) > 0)
            {
                $category->itemStatus = 1;
            }else{
                $category->itemStatus = 0;
            }
        }
        $data = [
           'categories' => $categories,
           'categoryActive' => true,
           'categoriesList' => true
        ];
        return view('admin.categories.categories', $data);
    }

    /**
     * get delete collections
     * GET admin/category/delete-category 
     *
     * @return response
     */
    public function getDeleteCategory($id)
    {
        $category = $this->categoryRepo->getCategory($id);
        $defaultCategories = ['Rings', 'Earrings', 'Chains', 'Bracelets', 'Necklaces', 'Crosses & Rosaries'];
        if(in_array($category->category, $defaultCategories ))
        {
            if( isset($request['category']))
            {
                return redirect()->back()->withErrors('You can not change the name of this category.');
            }
        }else{
            $items = $this->itemRepo->getItemsByCategory($category->category,  'no Sort', '48');
            foreach($items as$item)
            {
                $this->itemRepo->editItem($item->id, ['category_id' => '0']);
            }
            $this->categoryRepo->getDeleteCategory($id);
        }
        
        return redirect()->back();
    }

    /**
     * get create category page
     * GET admin/category/create-category 
     *
     * @return response
     */ 
    public function getCreateCategory(Request $request)
    {
        $data = [
            'categoryActive' => true,
            'createCategory' => true
            ];
        return view('admin.categories.create_category', $data);
    }

    /**
     * create category 
     * POST admin/category/create-category 
     *
     * @param Request $request
     * @return response
     */
    public function postCreateCategory(CreateCategoryRequest $request)
    {
        $file = $request['image']; 
        $catData = [
                'category' => $request->get('category'),
                'style' => $request->get('style'),
                'alt' => $request->get('alt'),
            ];
        if($file){
            $catData['alt'] = $request->get('alt');           
        }

        $this->categoryRepo->createCategory($catData);
        return redirect()->action('Admin\CategoryController@getCategories');
    }

    /**
     * Get edit category page
     *
     * @param int $id
     */
    public function getEditCategory($id)
    {
        $category = $this->categoryRepo->getCategory($id);
        $data = [
        'category' => $category,
        ];
        return view('admin.categories.edit_category', $data);
    }

    public function postEditCategory(EditCategoryRequest $request)
    {
        $catId = $request['id'];
        $category = $this->categoryRepo->getCategory($catId);
        $defaultCategories = ['Rings', 'Earrings', 'Chains', 'Bracelets', 'Necklaces', 'Crosses & Rosaries'];
        if(in_array($category->category, $defaultCategories ))
        {
            if( $request['category'] != $category->category)
            {
                return redirect()->back()->withErrors('You can not change the name of this category.');
            } else{
                $name = $category->category;
            }
            if(isset($request['style']) && $request['style'] != null)
            {
                if(strpos('>'.$category->category.'<', $request['style']) != false)
                {
                    return redirect()->back()->withErrors('You can not change the name of this category.');
                }else{
                    $style = $request['style'];
                }
            }else{
                $style = "";
            }
        }else{
            $name = $request['category'];
            $style = $request['style'];
        }
        $file = $request['image'];
        $catData = [
            'category' => $name,
            'alt' => $request['alt']
                ];  
        if ($file ) {
            $catData['image'] = $file;
        }
        $this->categoryRepo->updateCategory($catId, $catData);
        return redirect()->action('Admin\CategoryController@getCategories');
    }

    /**
     * Delete selected categories
     * 
     * @param Request $request
     */
    public function getDeleteCategories(Request $request)
    {
        $categoryArr = $request['catArr'];
        $mainCategories = ['Rings', 'Earrings', 'Chains', 'Bracelets', 'Necklaces', 'Crosses & Rosaries'];
        if($categoryArr)
        {
            foreach( $categoryArr as $categoryId)
                {
                    $category = $this->categoryRepo->getCategory($categoryId);
                    if(!in_array($category->category, $mainCategories))
                    {
                        $items = $this->itemRepo->getItemsByCategory($category->category, 'no Sort', '48');
                        foreach($items as$item)
                        {
                            $this->itemRepo->editItem($item->id, ['category_id' => '0']);
                        }
                        $this->categoryRepo->getDeleteCategory($categoryId);
                    }
                }
        }
        $data = ['mainCategories' => $mainCategories];
        return response()->json($data);
    }
}
