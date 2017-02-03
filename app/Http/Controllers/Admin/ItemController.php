<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Contracts\ItemInterface;
use App\Contracts\CollectionInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\ImageInterface;
use App\Contracts\MetalInterface;
use App\Contracts\GemstoneInterface;
use App\Contracts\VideoInterface;
use App\Contracts\RingSizeInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\CartInterface;
use App\Contracts\TagInterface;
use App\Contracts\OrderInterface;
use App\Http\Requests\Items\CreateItemRequest;
use App\Http\Requests\Items\EditItemRequest;
use Validator;
use File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;

class ItemController extends BaseAdminController
{
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
     * the ring size service.
     *
     * @var string
     */
    public $sizeRepo;

    /**
     * the review service.
     *
     * @var string
     */
    public $reviewRepo;

    /**
     * the cart service.
     *
     * @var string
     */
    public $cartRepo;
   
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
    public $tagRepo;

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
                                ItemInterface $itemRepo,
                                CollectionInterface $collectionRepo,
                                CategoryInterface $categoryRepo,
                                ImageInterface $imageRepo,
                                MetalInterface $metalRepo,
                                GemstoneInterface $gemstoneRepo,
                                VideoInterface $videoRepo,
                                RingSizeInterface $sizeRepo,
                                ReviewInterface $reviewRepo,
                                NewsLetterInterface $newsLetterRepo,
                                CartInterface $cartRepo,
                                TagInterface $tagRepo,
                                OrderInterface $orderRepo
                                )
                                
    {       
        $this->itemRepo = $itemRepo;
        $this->collectionRepo = $collectionRepo;
        $this->categoryRepo = $categoryRepo;
        $this->imageRepo = $imageRepo;
        $this->metalRepo = $metalRepo;
        $this->gemstoneRepo = $gemstoneRepo;
        $this->videoRepo = $videoRepo;  
        $this->sizeRepo = $sizeRepo;   
        $this->reviewRepo = $reviewRepo; 
        $this->newsLetterRepo = $newsLetterRepo;  
        $this->cartRepo = $cartRepo;
        $this->orderRepo = $orderRepo;
        $this->tagRepo = $tagRepo;  
        $this->middleware("admin");
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * create item page
     * GET admin/item/create-item
     *
     * @return response
     */
    public function getCreateItem()
    {
        //dd('asd');
       //dd(\Session::get('errors'));
        $categories = $this->categoryRepo->getAll()->all();
        $collections = $this->collectionRepo->collections()->all();
        $metals = $this->metalRepo->getAll()->all();
        $gemstones = $this->gemstoneRepo->getGemstones()->all();
        $sizes = [6, 7, 8, 9];
        $data = [
            'categories' => $categories,
            'collections' => $collections, 
            'metals' =>$metals,
            'gemstones' => $gemstones,
            'itemActive' => true,
            'createItem' => true,
            'sizes' => $sizes
        ];
        return view('admin.items.create_item', $data);
    }

    /**
     * Create new item.
     * POST admin/item/create-item
     *
     * @param CreateItemRequest $itemRequest
     * @return response
     */
    public function postCreateItem(CreateItemRequest $itemRequest)
    {
        $items =$this->itemRepo->showItemList();
        $page = round((count($items)+1)/20);
        $request = $itemRequest->except('sizes');
        if(!$request['category_id'] )
        {
            return redirect()->back()->withErrors('You can not create item without category. Please create category first.');
        }
        $price = $request['price'];
        if($request['discount'] == "0" || $request['discount'] == ""){
             $itemData['new_price'] = $price;
             $request['new_price'] = $price;
        }else{
             $percent = $price * $request['discount'] / 100;
             $itemData['new_price'] =  $price - $percent;
             $request['new_price'] =  $price - $percent;
        }
        
        if(!isset($request['item_image']))
        {
            return redirect()->back()->withErrors('You can not create item without images. Please add images first.');
        }else{

            $item_images = $request['item_image'];
        }

        if($request['status'] == 'Out of the store')
        {
            $request['quantity'] = '0';
        }
        if($request['quantity'] == '0')
        {
            $request['status'] = 'Out of the store';
            $itemData['status'] = 'Out of the store';
        }
        $newItem = $this->itemRepo->addItem($request);
        $itemId = $newItem->id;
        if($request['category_id'] == "1")
        {
            if(isset($request['size_checkbox']))
            {
                $sizes = $request['size_checkbox'];
                foreach($sizes as $size)
                {
                    $data = [
                        'size' => $size,
                        'item_id' => $itemId
                            ];
                    $this->sizeRepo->setSize($data);
                }
            }else{
                $this->itemRepo->deleteItem($itemId);
                return redirect()->back()->withErrors('You can not add a ring without size. Please choose size for the ring.');
            }

        }
        $tags = $request['tags'];
        if($tags)
        {
            $tagArr = explode(',', $tags[0]);
            foreach($tagArr as $tag)
            {
                if($tag != "")
                {
                    $data = [
                        'name' => $tag,
                        'item_id' => $itemId
                            ];
                    $this->tagRepo->createTag($data);
                }               
            }
        }
            if(isset($request['metal_checkbox']))
                {
                    $metals = $request['metal_checkbox'];
                    $newItem->metals()->detach();
                    foreach($metals as $metal_id)
                    {
                        $newItem->metals()->attach($metal_id);
                    }
        
                }else{
                    $newItem->metals()->detach();
                }
            if(isset($request['gemstone_checkbox']))
                {
                    $gemstones = $request['gemstone_checkbox'];
                    $newItem->gemstones()->detach();
                    foreach($gemstones as $gemstone_id)
                    {
                        $newItem->gemstones()->attach($gemstone_id);
                    }
                }else{
                    $newItem->gemstones()->detach();
                }
        $data = [
        'title' => $request['title'],
        'price' => $request['price'],
        'quantity' => $request['quantity'],
        'description' => $request['description']
        ];
        $rules = [
        'title' => 'required',
        'price' => 'required',
        'quantity' => 'required',
        'description' => 'required'
        ];
        $validator = Validator::make($data, $rules);
        if($request['video'])
        {
            $data = ['name' => $request['video'],
                     'item_id' => $newItem->id
                ];
            $this->videoRepo->createVideo($data);
        }

        foreach($item_images as $image)
        {
            $this->imageRepo->setItemId($image, $newItem->id);
        }

        if($request['main_image'])
        {
            $main_image = $this->imageRepo->getImageByName($request['main_image']);
            $id = $main_image->id;
            $data = ['main_image_id' => $id];
            $this->itemRepo->editItem($newItem->id, $data);
        }

        $this->imageRepo->deleteExtraImages();
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            if($newItem->collection_id != 0)
            {
                $collection = $this->collectionRepo->getCollection($newItem->collection_id);
                return redirect()->action('Admin\CollectionController@getCollectionItems', [$collection->name, 1]);
            }else{
                return redirect()->action('Admin\ItemController@getShowItemList', 1);
            } 
        }
    }

    /**
     * Show items' list.
     * GET admin/item/show/item
     * 
     * @return items_list view
     */
    public function getShowItemList($page)
    {

        $items = $this->itemRepo->showItemList();
        $itemPage = round(count($items)/20);
        $itemA = [];
        $items = $this->itemRepo->getItemsWithoutCollection();
        if(count($items)/20 > 1 && count($items)%20 > 0 && count($items)%20 < 0.5 )
        {
            $itemPage = count($items)/20 + 1;
        }else{
            $itemPage = count($items)/20;
        }
        $itemA = []; 
        $itemArr = [];
        foreach($items as $item)
        {
            $itemA[] = $item;
        }
        for($i = 0; $i < count($items); $i+=20)
        {
            $itemArr[] = array_slice($itemA, $i,20);
        }

        session()->put('page', $page);
        session()->put('type', 'items');
        $data = [
            'maxPage' => $itemPage,
            'page'=> $page,
            'items' => $items,
            'itemArr' => $itemArr,
            'itemActive' => true,
            'itemsList' => true,
            'type' => 'items'
        ];

        return view('admin.items.items', $data);
    }

    /**
     * item View
     * GET admin/item/view-item 
     *
     * @param integer $id
     * @return response
     */
    public function getViewItem($slug)
    {  
        $item = $this->itemRepo->showItem($slug);
        $id = $item->id;
        if($this->videoRepo->getVideo($id))
        {
            $video = $this->videoRepo->getVideo($item->id);
            $url = $video->name;
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
                $video = $match[1];
        } else 
        {
            $video = 0;
        }
        $data = [
            'item' => $item,
            'video' => $video,
            'itemActive' => true,
            'itemsList' => true,
        ];

        return view('admin.items.item_view_gallery',$data);
    }

    /**
     * Show last created item
     * GET admin/item/show-item 
     *
     * @param integer $id
     * @return item page
     */
    public function getShowItem($id)
    {        
        $item = $this->itemRepo->showItem($id); 
        $url = $collection->video;
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
        {
            $video_id = $match[1];
        }
        $collections = $this->collectionRepo->collections();
        $data = [
            'items' => $item,
            'collections' => $collections,
            'itemActive' => true,
            'itemsList' => true,
        ];
        return view('admin.items.items', $data);
    }

    /**
     * delete item image
     * GET admin/item/delete-item-image 
     *
     * @param integer $id
     * @return item page
     */
    public function getDeleteItemImage(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $deleteImage = $this->imageRepo->deleteOne($id);
        File::delete( public_path().'/uploads/'.$name);
        return response()->json(['status' => 1]);  
    }

    /**
     * upload item image
     * POST admin/item/upload-item-image 
     *
     * @param integer $id
     * @return response
     */
    // public function postUploadItemImage(Request $request)
    // {
    //     $imageCount = $this->imageRepo->countImages($request['item_id']);
    //     $file = $request->file[0];
    //     $data = ['image' => $file];
    //     $rules = ['image' => 'required']; 
    //     $validator = Validator::make($data, $rules);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator);
    //     } else {
    //         if ($file->isValid() && $imageCount < 5) {
    //           $destinationPath = public_path().'/uploads';
    //           $extension = $file->getClientOriginalExtension();
    //           $fileName = rand(11111,99999).'.'.$extension;
    //           $file->move($destinationPath, $fileName);
    //           $imageData =[
    //             'item_id' => $request['item_id'],
    //             'name' => $fileName
    //           ];
    //           $this->imageRepo->addImage($imageData);
    //         }
    //         else {
    //          return redirect()->back()->with('warning', "You can't upload more than 5 images!");
    //         }
    //     }
    //     return redirect()->back();
    // }

    /**
     * edit item
     * GET admin/item/edit-item 
     *
     * @param integer $id
     * @return response
     */
    public function getEditItem($slug)
    {
        $item = $this->itemRepo->showItem($slug); 
        $collections = $this->collectionRepo->collections();
        $categories = $this->categoryRepo->getAll()->all();
        $metals = $this->metalRepo->getAll()->all();
        $gemstones = $this->gemstoneRepo->getGemstones()->all();
        $items_gemstones = $item->gemstones()->pluck('gemstone_id')->all();
        $items_metals = $item->metals()->pluck('metal_id')->all();
        $item_images_count = $item->images->count();
        if($this->videoRepo->getVideo($item->id))
        {
            $video = $this->videoRepo->getVideo($item->id);
            $url = $video->name;
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
                $video = $match[1];
        }else 
        {
            $video = 0;
        }
        foreach ($categories as $category) {
           $dataCat[$category->id] = $category->category;
        }
        foreach ($collections as $collection) {
            $dataColl[$collection->id] = $collection->name;
        }
        $sizes = [6,7,8,9];
        $itemSizes = $item->size; 
        $sizeArr = [];
        foreach($itemSizes as $itemSize)
        {
            $sizeArr[] = $itemSize->size; 
        }
        $data = [
            'item' => $item,
            'collections' => $collections,
            'categories' => $dataCat,
            'itemActive' => true,
            'itemsList' => true,
            'video' => $video,
            'metals' => $metals,
            'gemstones' => $gemstones,
            'items_gemstones' => $items_gemstones,
            'items_metals' =>$items_metals,
            'sizes' => $sizes,
            'sizeArr' => $sizeArr,
            'item_images_count' =>$item_images_count,
            'page' => session()->get('page')
        ];
        return view('admin.items.edit_item', $data);
    }

    /**
     * edit item
     * POST admin/item/edit-item 
     *
     * @param EditItemRequest $itemRequest
     * @return response
     */
    public function postEditItem(EditItemRequest $request)
    { 

        $itemData = $request->except(['metal_check', 'metal_checkbox', 'gemstone_checkbox', 'size_checkbox', 'size_check', 'id', '_token', 'tags']);   
        $itemId = $request['id'];
        $item = $this->itemRepo->getItem($itemId);
        if($request['status'] == 'Out of the store')
        {
            $request['quantity'] ='0';
            $itemData['quantity'] = $request['quantity'];
        }
        if($request['quantity'] == '0')
        {
            $request['status'] = 'Out of the store';
            $itemData['status'] = 'Out of the store';
        }
        if($request['status'] != 'Available')
        {
            $this->cartRepo->deleteCartsByItemId($itemId);
        }
        $price = $request['price'];
        if($request['discount'] == "0" || $request['discount'] == ""){
             $itemData['new_price'] = $price;
             $request['new_price'] = $price;
        }else{
             $percent = $price * $request['discount'] / 100;
             $itemData['new_price'] =  $price - $percent;
             $request['new_price'] =  $price - $percent;
        }
        $metalsArr = $this->metalRepo->getAll();
        if($metalsArr)
        {
            if($request->has('metal_checkbox'))
                {
                    $metals = $request['metal_checkbox'];
                    $item->metals()->detach();
                    foreach($metals as $metal_id)
                    {
                        $item->metals()->attach($metal_id);
                    }
        
                }else{
                    $item->metals()->detach();
                }
        }
        $sizes = $request['size_checkbox'];
        if($sizes)
        {
            $oldSizes = $this->sizeRepo->getSizeRow($itemId);
            foreach($oldSizes as $oldSize)
            {
                $this->sizeRepo->deleteSize($oldSize->id);
            }
            foreach($sizes as $size)
            {
                
                $data = [
                    'size' => $size,
                    'item_id' => $itemId
                        ];
                $this->sizeRepo->setSize($data);
            }
        }elseif($request['category_id'] == 1 && !isset($sizes)){
            return redirect()->back()->withErrors('You can not add a ring without size. Please choose size for the ring.');
        }
        $tags = $request['tags'];
        if($tags)
        {
            $tagArr = explode(',', $tags[0]);
            foreach($tagArr as $tag)
            {
                if($tag != "")
                {
                    $data = [
                        'name' => $tag,
                        'item_id' => $itemId
                            ];
                    $this->tagRepo->createTag($data); 
                }
            }
        }
        $gemstoneArr = $this->gemstoneRepo->getGemstones();
        if($gemstoneArr)
        {
            if($request->has('gemstone_checkbox'))
                {
                    $gemstones = $request['gemstone_checkbox'];
                    $item->gemstones()->detach();
                    foreach($gemstones as $gemstone_id)
                    {
                        $item->gemstones()->attach($gemstone_id);
                    }
                }else{
                    $item->gemstones()->detach();
                }
        }
        $newItem = $this->itemRepo->updateItem($itemId, $itemData);
        $newItem = $this->itemRepo->getItem($itemId);
        $page = session()->get('page');
        if($item->collection_id == 0 &&  $newItem->collection_id == 0)
        {
            return redirect()->action('Admin\ItemController@getShowItemList', $page);
        }elseif($item->collection_id != 0 &&  $newItem->collection_id == 0){

            return redirect()->action('Admin\ItemController@getShowItemList', 1); 
        }elseif($item->collection_id != 0 &&  $newItem->collection_id != 0){

            $collection = $this->collectionRepo->getCollection($newItem->collection_id);
            return redirect()->action('Admin\CollectionController@getCollectionItems', [$collection->name, $page]);
        }elseif($item->collection_id == 0 &&  $newItem->collection_id != 0){

            $collection = $this->collectionRepo->getCollection($newItem->collection_id);
            return redirect()->action('Admin\CollectionController@getCollectionItems', [$collection->name, 1]);
        }
        
    }

    /**
     * delete item
     * GET admin/item/delete-item 
     *
     * @param int $id
     * @return response
     */
    public function getDeleteItem($id) 
    {
        session()->put('deleteItem', true);
        $page = session()->get('page');
        $item = $this->itemRepo->getItem($id);
        $tags = $item->tags;
        foreach($tags as $tag)
        {
            $this->tagRepo->removeTag($tag->id);
        }
        $reviews = $this->reviewRepo->itemReviews($id);
        foreach($reviews as $review)
        {
            $this->reviewRepo->deleteReview($review->id);
        }
        $this->imageRepo->deleteItemImages($id); 
        $this->videoRepo->deleteItemVideos($id);
        $this->cartRepo->getDeleteUnorderedCarts($id);
        $this->sizeRepo->deleteItemSizes($id);
        $this->itemRepo->deleteItem($id);
        if($item->collection_id != 0)
        {
            $collection = $this->collectionRepo->getCollection($item->collection_id);
            return redirect()->action('Admin\CollectionController@getCollectionItems', [$collection->name, $page]);
        }else{
            return redirect()->action('Admin\ItemController@getShowItemList', $page);
        }      
    }

    /**
     * Add video for item
     * 
     * @param Request $request
     * @return redirect
     */

    public function postAddVideo(Request $request) 
    {  
        session()->put('uploadStatus', 'true');
        if($this->videoRepo->getVideo($request['item_id']))
        {
            $data = ['name' => $request['name'],
            'item_id' => $request['item_id']];
            $this->videoRepo->updateVideo($request['item_id'], $data);
            return redirect()->back();

        } else
        {
            $data = ['name' => $request['name'],
                     'item_id' => $request['item_id']
                ];
            $this->videoRepo->createVideo($data);
            return redirect()->back();
        }

    }

    public function postUploadItemImages(Request $request)
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
                        'item_id' => $request['item_id'], 
                        'name' => $fileName
                    ];
                      
                    $this->imageRepo->addImage($imageData);
                }
                else {
                    return redirect()->back()->with('warning', "Error, please try again.");
                }
            }
            
        }
        return redirect()->back();
    }

    public function postUploadItemImagesDrop(Request $request)
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
                    $fileName = $request['item_image'][$key].'.'.$extension;
                    $file->move($destinationPath, $fileName);
                    $imageData =[
                        'item_id' => 0,
                        'name' => $fileName
                    ];
                      
                    $this->imageRepo->addImage($imageData);
                }
                else {
                    return redirect()->back()->with('warning', "Error, please try again.");
                }
            }
            
        }
        return redirect()->back();
    }

    public function getRemoveImageDropzone(Request $request)
    {
        $name = $request->name;
        $this->imageRepo->deleteImageByName($name);
        return redirect()->back();
    }


    public function getAddedImage($files)
    {
        dd($files);
    }

    public function postSetMainImage(Request $request)
    {
        $main_image_id = $request->main_image_id;
        $item_id = $request->id;
        $data = ['main_image_id' => $main_image_id];
        $this->itemRepo->updateItem($item_id, $data);
    }


    /**
     * Delete selected images
     * 
     * @param 
     * @return
     */
    public function getDeleteItems(Request $request)
    {
        $itemArr = $request['itemArr'];
        foreach($itemArr as $itemId) 
        {
            $item = $this->itemRepo->getItem($itemId);
            $tags = $item->tags;
            foreach($tags as $tag)
            {
                $this->tagRepo->removeTag($tag->id);
            }
            $reviews = $this->reviewRepo->itemReviews($itemId);
            foreach($reviews as $review)
            {
                $this->reviewRepo->deleteReview($review->id);
            }

            $this->imageRepo->deleteItemImages($itemId); 
            $this->videoRepo->deleteItemVideos($itemId);
            $this->cartRepo->getDeleteUnorderedCarts($itemId);
            $this->sizeRepo->deleteItemSizes($itemId);
            $this->itemRepo->deleteItem($itemId);
        }
        return response()->json();

    }

    /**
     * Search items 
     */
    public function getSearchItems(Request $request, $page)
    {
        $search = $request['search'];
        $search = preg_replace('!\s+!', ' ', $search);
        if($search == ' ')
        {
            return redirect()->back();
        }
        $previoustURL = url()->previous();
        if(stristr($previoustURL, "collection"))
        {
            $type = 'collection';
        }else{
            $type = 'items';
        }
        $results = $this->itemRepo->searchItemByTitle($search, $type);
        $itemPage = round(count($results)/20);
        $itemA = [];
        $itemArr = [];
        foreach($results as $item)
        {
            $itemA[] = $item;
        }
        for($i = 0; $i < count($results); $i+=20)
        {
            $itemArr[] = array_slice($itemA, $i,20);
        }
        $data = [
            'search' => $search,
            'maxPage' => $itemPage,
            'page' => $page,
            'itemArr' => $itemArr,
            'items' => $results,
            'itemActive' => true,
            'itemsList' => true,
            'type' => session()->get('type')
                ];
        return view('admin.items.search_results', $data);

    }

    /**
     * Add to occasions
     */
    public function getAddToOccasions(Request $request)
    {
        $items = $request['itemArr'];
        foreach($items as $item)
        {
            $this->itemRepo->updateItem($item, ['occasion' => 1]);

        }
        return response()->json();
    }

    /**
     * Get occassion items
     */
    public function getOccasions()
    {
        $items = $this->itemRepo->getOccasions();
        $data = [
        'items' => $items,
        'itemActive' => true,
        'occasions' => true
        ];
        return view('admin.items.occasions', $data);
    }

    /**
     * Delete from occasions
     */
    public function getDeleteOccasions(Request $request)
    {   
        $items = $request['itemArr'];
        foreach($items as $item)
        {
            $this->itemRepo->updateItem($item, ['occasion' => 0]);
        }
        return response()->json();

    }

    /**
     * Delete tags
     */
    public function getRemoveTags($id)
    {
        $this->tagRepo->removeTag($id);
        return response()->json();
    }

    /**
     * Delete selected images
     */
    public function getDeleteImages(Request $request)
    {
        $imageArr = $request['imageArr'];
        foreach($imageArr as $img)
        {
            $image = $this->imageRepo->oneImage($img);
            $item = $image->items;
            if($item && $item->main_image_id == $img)
            {
                $this->itemRepo->updateItem($item->id, ['main_image_id', '0']);
            }
            $this->imageRepo->deleteOne($img);
        }
        return response()->json();
    }

}
