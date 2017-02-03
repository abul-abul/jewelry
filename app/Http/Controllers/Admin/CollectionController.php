<?php
 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Contracts\CollectionInterface;
use App\Contracts\ItemInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\OrderInterface;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;
use App\Http\Requests\Collections\CreateCollectionRequest;
use App\Http\Requests\Collections\EditCollectionRequest;

class CollectionController extends BaseAdminController
{
    /**
     * the collection service.
     *
     * @var string
     */
    public $collectionRepo;

    /**
     * the item service.
     *
     * @var string
     */
    public $itemRepo;

    /**
     * the reiew service.
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
     * the newsLetter service.
     *
     * @var string
     */
    public $orderRepo;

    public function __construct(
                                CollectionInterface $collectionRepo,
                                ItemInterface $itemRepo,
                                ReviewInterface $reviewRepo,
                                NewsLetterInterface $newsLetterRepo,
                                OrderInterface $orderRepo
                                )
                                
    {   $this->itemRepo = $itemRepo;   
        $this->collectionRepo = $collectionRepo; 
        $this->reviewRepo = $reviewRepo; 
        $this->newsLetterRepo = $newsLetterRepo;
        $this->orderRepo = $orderRepo;      
        $this->middleware("admin");
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * get created collections
     * GET admin/collection/collections 
     *
     * @return response
     */
    public  function getCollections()
    {
        $collections = $this->collectionRepo->collections();
        $data = [
            'collections' => $collections,
            'collectionActive' => true,
            'collectionsList' => true
        ];
        return view('admin.collections.collections', $data);
    }

    /**
     * get delete collections
     * GET admin/collection/delete-coll 
     *
     * @return response
     */
    public function getDeleteCollection($id)
    {
        $collection = $this->collectionRepo->getCollection($id)->name;
        $collItems = $this->collectionRepo->getCollectionItems($id);
        foreach($collItems as $item) 
        {
            $this->itemRepo->deleteItem($item->id);
        }
        $this->collectionRepo->removeCollection($id);     
        return redirect()->back();
    }

    /**
     * get create collection page
     * GET admin/collection/create-collection 
     *
     * @return response
     */ 
    public function getCreateCollection()
    {
        $data = [
            'collectionActive' => true,
            'collectionCreate' => true
        ];
        return view('admin.collections.create_collection',$data);
    }

    /**
     * create collection 
     * POSt admin/collection/create-collection 
     *
     * @param Request $request
     * @return response
     */
    public function postCreateCollection(CreateCollectionRequest $request)
    {
        $file = $request['image'];
        $collData = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'image' => $file,
            'video' => $request->get('video'),
            'alt' => $request->get('alt')
                ];
        $this->collectionRepo->createCollection($collData);
        return redirect()->action('Admin\CollectionController@getCollections');
    }

    /**
     * edit collection 
     * GET admin/collection/edit-collection 
     *
     * @param int $id
     * @return response
     */
    public function getEditCollection($id) 
    {
        $collection = $this->collectionRepo->getCollection($id);       
        $data = [
            'collection' => $collection,
            'collectionActive' => true,
            'collectionsList' => true
        ];

        return view('admin.collections.edit_collection', $data);
    }

    /**
     * edit collection 
     * POST admin/collection/edit-collection 
     *
     * @param Request $request
     * @return response
     */
    public function postEditCollection(EditCollectionRequest $request)
    {
        $collID = $request['id'];
        $file = $request['image'];
        $collData = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'alt' => $request->get('alt'),
        ];
   
        if ($file ) {
            $collData['image'] = $file;
        }
        $this->collectionRepo->editCollection($collID, $collData);

        return redirect()->action('Admin\CollectionController@getCollections');

    }

    /**
     * Delete selected collections
     * 
     * @param Request $request 
     */
    public function getDeleteCollections(Request $request)
    {
        $collArr = $request['collArr'];
        foreach($collArr as $collection)
        {
            $collItems = $this->collectionRepo->getCollectionItems($collection);
            foreach($collItems as $item)
            {
                $this->itemRepo->deleteItem($item->id);
            }
            $this->collectionRepo->removeCollection($collection);
        }
        return response()->json();
    }

    /**
     * Get collection items
     * 
     * @param string $collectionName
     * @return
     */
    public function getCollectionItems($collectionName, $page)
    {
        $items = $this->itemRepo->getItemsByCollection($collectionName);
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
        session()->put('type', 'collection');
        $data = [
            'maxPage' => $itemPage,
            'page'=> $page,
            'items' => $items,
            'itemArr' => $itemArr,
            'collectionName' => $collectionName,
            'collectionActive' => true,
            'type' => 'collection'
        ];

        return view('admin.collections.collection_items', $data);
    }
}
