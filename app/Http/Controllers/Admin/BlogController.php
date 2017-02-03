<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests; 
use Auth;
use App\Contracts\UserInterface;
use App\Contracts\ItemInterface;
use App\Contracts\CollectionInterface; 
use App\Contracts\CategoryInterface;
use App\Contracts\ImageInterface;
use App\Contracts\MetalInterface;
use App\Contracts\GemstoneInterface;
use App\Contracts\VideoInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\SliderInterface;
use App\Contracts\BlogInterface;
use App\Contracts\BlogImageInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\OrderInterface;
use App\Http\Requests\Items\CreateItemRequest;
use App\Http\Requests\Items\EditItemRequest;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Collections\CreateSliderRequest;
use Validator;
use File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;

class BlogController extends BaseAdminController
{

    /**
     * the admin service.
     *
     * @var string
     */
    public $userRepo;

    /**
     * the item service.
     *
     * @var string
     */
    public $itemRepo;

    /**
     * the collection service.
     *
     * @var string
     */
    public $collectionRepo;

    /**
     * the catgeory service.
     *
     * @var string
     */
    public $categoryRepo;
    
    /**
     * the image service.
     *
     * @var string
     */
    public $imageRepo;

    /**
     * the metal service.
     *
     * @var string
     */
    public $metalRepo;

    /**
     * the video service.
     *
     * @var string
     */
    public $videoRepo;    

    /**
     * the gemstone service.
     *
     * @var string
     */
    public $gemstoneRepo;

    /**
     * the slider service.
     *
     * @var string
     */
    public $sliderRepo;

    /**
     * the review service.
     *
     * @var string
     */
    public $reviewRepo;

    /**
     * the review service.
     *
     * @var string
     */
    public $articleRepo;

    /**
     * the review service.
     *
     * @var string
     */
    public $blogImageRepo;

    /**
     * the newsLetter service.
     *
     * @var string
     */
    public $newsLetterRepo;

    /**
     * the newsLetter service.
     *
     * @var string
     */
    public $orderRepo;

    /**
     * Create a new instance of AdminController class.
     *
     * @return void
     */
    public function __construct( 
                                UserInterface $userRepo,
                                ItemInterface $itemRepo,
                                CollectionInterface $collectionRepo,
                                CategoryInterface $categoryRepo,
                                ImageInterface $imageRepo,
                                MetalInterface $metalRepo,
                                GemstoneInterface $gemstoneRepo,
                                VideoInterface $videoRepo,
                                SliderInterface $sliderRepo,
                                ReviewInterface $reviewRepo,
                                BlogInterface $articleRepo,
                                BlogImageInterface $blogImageRepo,
                                NewsLetterInterface $newsLetterRepo,
                                OrderInterface $orderRepo
                                )
                                
    { 
        $this->userRepo = $userRepo;
        $this->itemRepo = $itemRepo;
        $this->collectionRepo = $collectionRepo;
        $this->categoryRepo = $categoryRepo;
        $this->imageRepo = $imageRepo;
        $this->metalRepo = $metalRepo;
        $this->gemstoneRepo = $gemstoneRepo;
        $this->videoRepo = $videoRepo;
        $this->sliderRepo = $sliderRepo;
        $this->reviewRepo = $reviewRepo;
        $this->articleRepo = $articleRepo;
        $this->blogImageRepo = $blogImageRepo;
        $this->newsLetterRepo = $newsLetterRepo;
        $this->orderRepo = $orderRepo;   
        $this->middleware("admin", ['except' => [
                                        'getLogin', 
                                        'postLogin'
                                    ]]);
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * Get all articles
     * 
     * @param
     * @return articles
     */
    public function getArticles($page)
    {
    	$articles = $this->articleRepo->getAllArticles();
        if(count($articles)/10 > 1 && count($articles)%10 > 0 && count($articles)%10 < 0.5 )
        {
            $articlePage = count($articles)/10 + 1;
        }else{
            $articlePage = count($articles)/10;
        }
        $artS = []; 
        $articleArr = [];
        foreach($articles as $article)
        {
            $artS[] = $article;
        }
        for($i = 0; $i < count($articles); $i+=10)
        {
            $articleArr[] = array_slice($artS, $i,10);
        }
    	foreach($articles as $article)
    	{
    		$url = $article->video;
            if($url)
            {
        		if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
                {
                    $name = $match[1];
                    $article['video'] = $name;
                }else{
                    $article['video'] = null;
                }
            } 
        	if($article->main_image)
            {
                $image = $this->blogImageRepo->getMainImage($article->main_image);
            }else{
                $image = $this->blogImageRepo->getImage($article->id);
            } 
        	$article['image'] = $image['name'];
    	}
    	$data = [
    		'articles' => $articles,
            'articleArr' => $articleArr,
            'page' => $page,
            'maxPage' => $articlePage,
            'blogActive' => true,
            'articlesList' => true,
        ];
    	return view('admin.blog.articles', $data);
    }

    /**
     * Get article create page
     * 
     * @param Request $request
     * @return view
     */
    public function getCreateArticle()
    {
    	$data = [
    	    	'blogActive' => true,
        		'createArticle' => true
        	];
    	return view('admin.blog.create_article', $data);
    }

    /**
     * Create new article
	 * 
	 * @param
	 * @return
     */
    public function postCreateArticle(Request $request) 
    {
    	$article = $request->except('main_image');
        $rules = [
        'title' => 'required',
        'content' => 'required',
        'article_image' => 'required',
        'alt' => 'required'
            ];
        $validator = Validator::make($article, $rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($article);
        }else{
            if(!isset($request['article_image']))
        {
            return redirect()->back()->withErrors('blogImage', 'You can not create article without images. Please add images first.')->withInput($article);
        }else{

            $article_images = $request['article_image'];
        }
        $new_art = $this->articleRepo->createArticle($article);
        $id = $new_art->id;
        foreach($article_images as $img)
        {
            $this->blogImageRepo->setArticleId($img, $new_art->id);
        }
        if($request['main_image'])
        {
            $main_image = $this->blogImageRepo->getImageByName($request['main_image']);
            $this->articleRepo->editArticle($new_art->id, ['main_image' => $main_image->id]);
        } 
        $this->blogImageRepo->deleteExtraImages();     
        return redirect()->action('Admin\BlogController@getArticles', 1);
        }
        
                                                 
    }

    /**
     * Upload images
     * 
     * @param
     * @return
     */
    public function postUploadImages(Request $request)
    {
    	$files = $request->file;
        foreach($files as $key => $file){
            $data = ['image' => $file];
            $rules = ['image' => 'required']; 
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {
                if($file->isValid()) {
                    $destinationPath = public_path().'/uploads';
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $request['article_image'][$key].'.'.$extension;
                    $file->move($destinationPath, $fileName);
                    $imageData =[
                        'article_id' => 0,
                        'name' => $fileName
                    ];
                      
                    $this->blogImageRepo->addImage($imageData);          
                }
                else {
                    return redirect()->back()->with('warning', "Error. Please, try again.");
                }
            }
            
        }
        return redirect()->back();
    }

    public function postUploadArticleImages(Request $request)
    {
         $files = $request->file;
        
        foreach($files as $file){
            $data = ['image' => $file];
            $rules = ['image' => 'required']; 
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {
                if($file->isValid()) {
                    $destinationPath = public_path().'/uploads';
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(11111,99999).'.'.$extension;
                    $file->move($destinationPath, $fileName);
                    $imageData =[
                        'article_id' => $request['article_id'],
                        'name' => $fileName
                    ];
                      
                    $this->blogImageRepo->addImage($imageData);
                }
                else {
                    return redirect()->back()->with('warning', "Error, please try again.");
                }
            }
            
        }
        return redirect()->back();
    }

    public function getRemoveArticleImageDropzone(Request $request){
        $name = $request->name;
        $this->blogImageRepo->deleteImageByName($name);
        return redirect()->back();
    }

    public function getDeleteArticleImage(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $deleteImage = $this->blogImageRepo->deleteImage($id);
        File::delete( public_path().'/uploads/'.$name);
        return response()->json(['status' => 1]);  
    }

    /**
     * Set article main image
     * 
     * @param
     * @return
     */
    public function postSetMainImage(Request $request)
    {
        $main_image_id = $request->main_image_id;
        $article_id = $request->id;
        $data = ['main_image' => $main_image_id];
        $this->articleRepo->editArticle($article_id, $data);
    }

    /**
     * Delete article
     * 
     * @param
     * @return
     */
    public function getDeleteArticle($id)
    {
        $article = $this->articleRepo->getArticle($id);
        $images = $article->blogImages;
        foreach($images as $image)
        {
            $this->blogImageRepo->deleteImage($image->id);
        }
        $this->articleRepo->delete($id);
        return redirect()->action('Admin\BlogController@getArticles', 1);;
    }

    /**
     * Get article edit page
     * 
     * @param int $id
     * @return 
     */
    public function getEditArticle($id)
    {
        $article = $this->articleRepo->getArticle($id);
        $url = $article->video;
            if($url){
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
            {
                $name = $match[1];
            }else{

            $name = null;
            }
             $article['video'] = $name;
        }
       
        $data = [
        'article' => $article,
        'blogActive' => true,
            ];
    	return view('admin.blog.edit_article', $data);
    }

    /**
     * Edit article
     * 
     * @param int $id
     * @param Request $request
     * @return 
     */
    public function postEditArticle($id, Request $request)
    {
        $data = [
        'title' => $request['title'],
        'content' => $request['content'],
        'alt' => $request['alt']
            ];
        if($request['video'])
        {
            $data['video'] = $request['video'];
        }
        $newArt = $this->articleRepo->editArticle($id, $data);
        $files = $request['file'];
        if($files){
            foreach($files as $file)
            {
                if($file)
                {
                    $destinationPath = public_path().'/uploads';
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(11111,99999).'.'.$extension;
                    $file->move($destinationPath, $fileName);
                    $imageData =[
                        'article_id' => $id, 
                        'name' => $fileName
                        ];                 
                    $this->blogImageRepo->addImage($imageData); 
                }
            }
        }
    	return redirect()->action('Admin\BlogController@getArticles', 1);
    }

    /**
     * Delete selected articles
     * 
     * @param Reqesut $request
     */
    public function getDeleteArticles(Request $request)
    {
        $articleArr = $request['articleArr'];
        foreach($articleArr as $articleId)
        {
            $article = $this->articleRepo->getArticle($articleId);
            $images = $article->blogImages;
            foreach($images as $image)
            {
                $this->blogImageRepo->deleteImage($articleId);
            }
            $this->articleRepo->delete($articleId);
        }
        return response()->json();
    }

}
