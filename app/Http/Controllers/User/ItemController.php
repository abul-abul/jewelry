<?php
 
namespace App\Http\Controllers\User; 

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;  
use App\Contracts\UserInterface;
use App\Contracts\MailInterface;
use App\Contracts\ItemInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\CollectionInterface;
use App\Contracts\CartInterface;
use App\Contracts\SliderInterface;
use App\Contracts\VideoInterface;
use App\Contracts\MetalInterface;
use App\Contracts\GemstoneInterface;
use App\Contracts\ImageInterface;
use App\Contracts\FavoritesInterface;
use App\Contracts\OrderInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\RatingInterface;
use App\Services\UserService;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\AddToShoppingCardRequest;
use Auth;
use Socialite;
use App\Http\Requests\Users\EditAccountRequest;
use Session, Input , Config;
use Carbon\Carbon;
use Validator;
use Share;
use Facebook;
use Illuminate\Routing\UrlGenerator;

class ItemController extends BaseController
{
    /**
     * the user service.
     *
     * @var string
     */
    public $userRepo;

    /**
     * the mail service.
     *
     * @var string
     */
    public $mailRepo;

    /**
     * the intem service.
     *
     * @var string
     */
    public $itemRepo;

    /**
     * the category service.
     *
     * @var string
     */
    public $categoryRepo;

    /**
     * the cart service.
     *
     * @var string
     */
    public $cartRepo;

    /**
     * the calection service.
     *
     * @var string
     */
    public $collectionRepo;

    /**
     * the slider service.
     *
     * @var string
     */
    public $sliderRepo;
    
    /**
     * the video service.
     *
     * @var string
     */
    
    /**
     * the metal service.
     *
     * @var string
     */
    public $metalRepo;

    /**
     * the gemstone service.
     *
     * @var string
     */
    public $gemstoneRepo;

    /**
     * the image service.
     *
     * @var string
     */
    public $imageRepo;

    /**
     * the favorites service.
     *
     * @var string
     */
    public $favoritesRepo;


     /** the review service.
     *
     * @var string
     */
    public $reviewRepo;

    /** the rating service.
     *
     * @var string
     */
    public $ratingRepo;
    /** the rating service.
     *
     * @var string
     */
    public $orderRepo;    

    /**
     * Create a new instance of UsersController class.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepo,
                                MailInterface $mailRepo,
                                ItemInterface $itemRepo,
                                CategoryInterface $categoryRepo,
                                CollectionInterface $collectionRepo,
                                CartInterface $cartRepo,
                                SliderInterface $sliderRepo,
                                VideoInterface $videoRepo,
                                MetalInterface $metalRepo,
                                GemstoneInterface $gemstoneRepo,
                                ImageInterface $imageRepo,
                                FavoritesInterface $favoritesRepo,   
                                ReviewInterface $reviewRepo,
                                RatingInterface $ratingRepo,
                                OrderInterface $orderRepo,
                                Request $request
                                )
    {
        $this->userRepo = $userRepo;
        $this->mailRepo = $mailRepo;
        $this->itemRepo = $itemRepo;
        $this->categoryRepo = $categoryRepo;
        $this->cartRepo = $cartRepo;
        $this->videoRepo = $videoRepo;
        $this->collectionRepo = $collectionRepo;
        $this->sliderRepo = $sliderRepo; 
        $this->metalRepo = $metalRepo;
        $this->gemstoneRepo = $gemstoneRepo;
        $this->imageRepo = $imageRepo;
        $this->favoritesRepo = $favoritesRepo;
        $this->reviewRepo = $reviewRepo;
        $this->ratingRepo = $ratingRepo;
        $this->orderRepo = $orderRepo;
        $this->middleware('auth', ['except' =>['getRegistration',
                                               'postRegistration',
                                               'getActivationUser',
                                               'getLogin',
                                               'postLogin',
                                               'getFacebookLogin',
                                               'getFacebookCallback',
                                               'getGoogleLogin',
                                               'getGoogleCallback',
                                               'getTwitterLogin',
                                               'getTwitterCallback',
                                               'getAllItemsFullWidth',
                                               'getAllItemsSidebar',
                                               'getAllItemsListSidebar',
                                               'getIndex',
                                               'getForgetPassword',
                                               'postForgetPassword',
                                               'getChangePassword',
                                               'postChangePassword',
                                               'getContact',
                                               'postSendContact',
                                               'getItem',
                                               'getItems',
                                               'getCollection',
                                               'getVideos',
                                               'getSearch',
                                               'getSearchFilter',
                                               'getAddToShoppingCart',
                                               'getItemData',
                                               'getShoppingCart',
                                               'getLastItem',
                                               'getDeleteCart',
                                               'getEditOrderStatus',
                                               'getItemsList',
                                               'getNewArrivals',
                                               'getFacebookShare',
                                               'getCollectionCategories',
                                               'getChangeCurrency',
                                               'getSession',
                                               'getAdvancedSearchResult',
                                               'getAdvancedSearchPage',
                                               'getFeaturedProducts',
                                               'getCategoryItems',
                                               'getCategoryFeaturedItems',
                                               'getSortType'                                            
                                               
                                            ]]);
        $ip = $request->ip();
        parent::__construct($categoryRepo, $collectionRepo, $imageRepo, $ip);
    }

    /**
     * get item details
     * GET user/item
     *
     * @param integer $id
     * @return view
     */
    public function getItem($cat, $slug, Request $request)
    {
        $previousUrl = url()->previous();
        $user = Auth::user();
        $item = $this->itemRepo->showItem($slug);
        if(stristr($previousUrl, "new-arrivals"))
        {
            session()->put('breadcrumb', 'New Arrivals');
        }elseif((stristr($previousUrl, "collections") || stristr($previousUrl, "collection")) && !stristr($previousUrl, "NoCollection"))
        {
            session()->put('breadcrumb', 'Collections');
        }elseif(stristr($previousUrl, "featured") && $item->status == 'Coming Soon')
        {
            session()->put('breadcrumb', 'Featured Products');
        }elseif(stristr($previousUrl, "category"))
        {
            session()->put('breadcrumb', $item->category->category);
        }elseif(stristr($previousUrl, "item/item"))
        {
            session()->put('breadcrumb', $item->category->category);
        }elseif(stristr($previousUrl, "favorites"))
        {
            session()->put('breadcrumb', 'Favorites');
        }else{
            session()->forget('breadcrumb');
        }
    
        if (stristr($previousUrl, "category-featured-items") || stristr($previousUrl, "collection-categories")) {
            $type = $item->category->category;
        }else{
            $type = "";
        }
        if(stristr($previousUrl, "with"))
        {
            $gemstoneBreadcrumb = "with-gesmtones"; 
            $gemstone = "With Gemstones";
        }elseif(stristr($previousUrl, "without"))
        {
            $gemstoneBreadcrumb = "without-gesmtones"; 
            $gemstone = "Without Gemstones";
        }else{
            $gemstoneBreadcrumb = "";
            $gemstone = "";
        }   
        $desc = explode('*', $item->description);
        $count = count($desc);
        $descriptionOne = array_slice($desc, 0, 4);
        $descriptionTwo = array_slice($desc, 4, $count-5);
        if(!$item->collection)
        {
            $suggested_items = $this->itemRepo->getSixItemsByCat($cat, $item->id);
        }else{
            $suggested_items = $this->itemRepo->getSixItemsByColl($item->collection->name, $item->id);
        }
        foreach($suggested_items as $sItem)
        {
            $sItem->discount = (int)$sItem->discount;
        }
        $video = 0;
        if($item->videos){
        $url = $item->videos->name;
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
            $video = $match[1];
        }
        if(Auth::check())
        {
            $cart = $this->cartRepo->getUserCart($user->id, $item->id);
            $user_id = Auth::user()->id;
            $favorite = $this->favoritesRepo->getFavorites($user_id, $item->id);
            if($favorite)
            {
                $status = 1; 
            }else{
                $status = 0;
            }
        }else{
            $cart =  $this->cartRepo->getCart($item->id, $request->ip());
            $status = 0;
        }
        $main_image_id = $item->main_image_id;
        if($main_image_id)
        {
            $main_image = $this->imageRepo->oneImage($main_image_id);
        }else{
            $main_image = "";
        }
        $metal_id = $item->metal_id;
        $metal = $this->metalRepo->getMetalById($metal_id);       
        $count = count($this->reviewRepo->getReviewByItemId($item->id));
        $reviews = [];
        $reviews = $this->reviewRepo->getReviewOrder($item->id);
        foreach ($reviews as $review){
            $date = $review->created_at;
            $date = date_format($date, 'F j Y');
            $review['date'] = $date;
        }
        $item_status = $item->status;
        $item->discount =  (int)$item->discount;
        if($item->images->first())
        {
           $shareImage = $item->images->first()->name;
           $data['shareImage'] = $shareImage; 
        }
        
        $data = [
            'descriptionOne' => $descriptionOne,
            'descriptionTwo' => $descriptionTwo,
            'item' => $item,
            'meta_keywords' => $item->meta_keywords,
            'meta_description' => $item->meta_description,
            'metal' => $metal,
            'count' => $count,
            'reviews' => $reviews,
            'status' => $status,
            'cart' => $cart,
            'main_image' => $main_image,
            'video' => $video,
            //'title' => $item->title.' | '.$item->coll.' | Jewelry Shop',
            'title' => $item->meta_title,
            'suggested_items' => $suggested_items,
            'item_status' => $item_status,
            'shareUrl' => action('User\ItemController@getItem',[$item->category->category,$item->slug]),
            // 'shareImage' => $shareImage,
            'type' => $type,
            'gemstone' => $gemstone,
            'gemstoneBreadcrumb' => $gemstoneBreadcrumb
        ];
        return view('users.item_details', $data);
    }

   /**
     * Get item details
     * GET user/item
     *
     * @param string $type
     * @param integer $id
     * @return view
     */
    public function getItems(Request $request, $type, $name, $sort)  
    {
        session()->forget('collection');
        session()->forget('category');
        session()->forget('metals');
        session()->forget('gemstones');
        $number = $request->session()->get('number');
        $metals = $this->metalRepo->getAll();
        $gemstones = $this->gemstoneRepo->getGemstones();
        $searchData = [];
        if ($type == 'category') {

            $itemsCategory = $this->itemRepo->getItemsByCategory($name, $sort, $number);
            $items = $itemsCategory;
            $breadcrumb = $name;
            $type = 'category';
            $searchData['category'] = $this->categoryRepo->getCategoryByName($name)->id;
            session()->put('category',$this->categoryRepo->getCategoryByName($name)->id);
        } elseif ($type == 'collection') {
            $itemsCollections = $this->itemRepo->getItemsByColl($name, $sort, $number);
            $items = $itemsCollections;
            $breadcrumb = $name;
            $type = 'collection';
            $searchData['collection'] = $this->collectionRepo->getCollectionName($name)->id;
            session()->put('collection', $this->collectionRepo->getCollectionName($name)->id);
        }
        foreach ($items as $item){
            $reviews = $this->reviewRepo->getReviewByItemId($item->id);
            $item['review'] = count($reviews);
            if(!$item->collection)
            {
                $item->coll = 'NoCollection';
            }else{
                $item->coll = $item->collection->name;
            }
            if(Auth::check())
            {
                $user = Auth::user();
                $item->cart = $this->cartRepo->getUserCart($user->id, $item->id);
                $item->favorite = $this->favoritesRepo->getFavorites($user->id, $item->id);
            }else{
                $ip = $request->ip();
                $item->cart = $this->cartRepo->getCart($item->id, $ip);
            }
            $item->discount =  (int)$item->discount;
        }
        if($name == "Crosses & Rosaries")
        {
            $name = "Rosaries";
        }
        $data = [
            'sort' => $sort,
            'metals' => $metals,
            'gemstones' => $gemstones,
            'items' => $items,
            'breadcrumb' => $breadcrumb,
            'type' => $type,
            'searchData' => $searchData,
            'title' => $name.' jewelry',
            'meta_keywords' => 'Silver '.$name.' jewelry,Silver '.$name.',Sterling Silver '.$name.'',
            'meta_description' => ''
        ];
        session()->put('searchType', 'noType');
        return view('users.items_list', $data);
    }

    /**
     * Post add review
     * POST /user/add-review/{id}
     * 
     * @param integer $id
     * @param Request $request
     *
     * @return redirect 
     */
    public function postAddReview($id,Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'review' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('review_error', 'The review field is required.');
        }else{
            $dataReview = [
            'review' => $data['review'],
            'user_id' => Auth::user()->id,
            'item_id' => $id,
            'status' => 'unseen'
        ];
        $this->reviewRepo->getAddReview($dataReview);
        return redirect()->back()->with('review_message', 'Your review has been sent.');
        }
    }

    /**
     * Delete review
     * 
     * @param int $id
     * @return
     */
    public function getRemoveReview($id)
    {
        $this->reviewRepo->deleteReview($id);
        return redirect()->back();
    }

    /**
     * Edit review
     * 
     * @param Request $request
     * @param int $id
     * @return
     */
    public function postEditReview(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make(['review' => $data['review']], [
            'review' => 'required',
                ]);
        if ($validator->fails()) {
            return redirect()->back()->with('review_error', 'The review field is required.');
        }else{
            $dataReview = [
            'review' => $data['review'],
            'status' => 'unseen'
        ];
        $this->reviewRepo->editReview($id, $dataReview);
        return redirect()->back()->with('review_message', 'Your review has been sent.');
        }

    }

    public function getSearchFilter(Request $request) 
    {
        $number = session()->get('number');
        $sort = session()->get('sort');
        $search = $request->search;
        if(isset($request['collection']))
        {
            $collection = $request['collection'];

            if((session()->get('collection') && session()->get('collection') == $collection))
            {
                session()->forget('collection');
            }else
            {
                session()->put('collection', $collection);
            }
           return redirect()->action('User\ItemController@getSearchFilter','?search='.$search.'&collectiontype='.$collection);
        }
        if(isset($request['category']))
        {
            $category = $request['category'];
            if((session()->get('category') && session()->get('category') == $category))
            {
                session()->forget('category');
            }else
            {
                session()->put('category', $category);
            }
           return redirect()->action('User\ItemController@getSearchFilter','?search='.$search.'&categorytype='.$category);
        }
        $searchData = [
            'category' => session()->get('category'),
            'collection' => session()->get('collection'),
            'search' => $request['search'],
            'type' => session()->get('searchType'),

        ];
        $gemstones = [];
        $metals = [];
        if(isset($request['gemstones']))
        {
            $gemstone = $request['gemstones'][0];
            if(session()->get('gemstones') && in_array($gemstone, session()->get('gemstones')))
            {
                $keyGemstone = array_search($gemstone, session()->get('gemstones'));
                session()->forget('gemstones.'.$keyGemstone);
            }else{
                session()->push('gemstones', $gemstone);
            }
            return redirect()->action('User\ItemController@getSearchFilter','?search='.$search.'&gemstone='.$gemstone);
        }
        if(session()->get('gemstones'))
        {
            foreach (session()->get('gemstones') as $gem) 
            {
                $gemstones[] = $gem;
            }
            $searchData['gemstones'] = $gemstones;
        }
        if(isset($request['metals']))
        {
            $metal = $request['metals'][0];
            if(session()->get('metals') && in_array($metal, session()->get('metals')))
            {
                $keyMetal = array_search($metal, session()->get('metals'));
                session()->forget('metals.'.$keyMetal);
            }else{
                session()->push('metals', $metal);
            }
           return redirect()->action('User\ItemController@getSearchFilter','?search='.$search.'&metal='.$metal);  
        }
        if(session()->get('metals'))
        {
           foreach (session()->get('metals') as $met) 
            {
                $metals[] = $met;
            }
            $searchData['metals'] = $metals;
        }
        if(isset($request['price_min']) || isset($request['price_max']))
        {
            session()->put('price_min', $request['price_min']);
            session()->put('price_max', $request['price_max']);
           return redirect()->action('User\ItemController@getSearchFilter','?search='.$search.'&min_price='.$request['price_min'].'&max_price='.$request['price_max']);  
        }
        if(session()->get('price_min') != 0)
            $searchData['price_min'] = session()->get('price_min');
        if(session()->get('price_max') != 0)
            $searchData['price_max'] = session()->get('price_max');
        if(!isset($request['price_min']))
        {
            session()->forget('price_min');
        }

        if(!isset($request['price_max']))
        {
            session()->forget('price_max');
        }          
        $searchArray = [
            'sort' => $sort,
            'number' => $number
        ];
        if ($search != null) {
            $searchArray['search'] = $search;
        }
        $items = $this->itemRepo->itemsSearchFilter($searchArray,$searchData);

        $metals = $this->metalRepo->getAll();
        $gemstones = $this->gemstoneRepo->getGemstones();
        $images = [];
        foreach ($items as $item) {
            array_push($images, $item->main_image_id);
        }                  
        foreach ($items as $item){
            if(Auth::check())
            {
                     $user_id = Auth::user()->id;
           $item->cart = $this->cartRepo->getUserCart($user_id, $item->id);
                $item->favorite = $this->favoritesRepo->getFavorites($user_id, $item->id);
            }else{
                $ip = $request->ip();
                $item->cart = $this->cartRepo->getCart($item->id, $ip);
            }
            $item->discount =  (int)$item->discount;
        }
        $data = [             
            'metals' => $metals,
            'gemstones' => $gemstones,
            'items' => $items,
            'searchData' => $searchData,
            'search' => $search, 
            'title' => 'Jewelry Category',
            'meta_keywords' => 'Jewelry Category search filter',
            'meta_description' => '',       
        ];
        $data['items'] = $items->appends(Input::except('page'));

        return view('users.search_results', $data);
    }

    /**
     * Get items with gemstones
     * 
     * @param Request $request
     * @param string $cat
     * @param string $name
     * @param string $type
     * @param string $sort
     * @return
     */
    public function getItemsList(Request $request, $cat, $name, $type, $sort)
    {
        session()->forget('collection');
        session()->forget('category');
        session()->forget('metals');
        session()->forget('gemstones');
        $number = session()->get('number');    
        $metals = $this->metalRepo->getAll();
        $gemstones = $this->gemstoneRepo->getGemstones();
        $items = $this->itemRepo->getItemsByCategory($name, $sort, $number);
        $images = [];
        foreach ($items as $item) {

                array_push($images, $item->main_image_id);
        }
        $searchData['category'] = $this->categoryRepo->getCategoryByName($name)->id;
        $data = [
            'sort' => $sort,
            'metals' => $metals,
            'gemstones' => $gemstones,
            'searchData' => $searchData,
            'type' => 'Category',
            'meta_keywords' => ''.$type.' '.$name.'',
            'meta_description' => '',
        ];

        $cat = 'category';
        if($type == 'with-gemstones')
        {            
            $items = $this->itemRepo->withGemtsones($name, $sort, $number);
            $data['title'] = $name.' with gemstones';
        } elseif($type == 'without-gemstones'){
            $data['title'] = $name.' without gemstones';
            $items = $this->itemRepo->withoutGemstones($name, $sort, $number);
        }
        $breadcrumb = $name;
        foreach ($items as $item)
        {
            if(Auth::check())
            {
                $user_id = Auth::user()->id;
                $item->cart = $this->cartRepo->getUserCart($user_id, $item->id);
                $item->favorite = $this->favoritesRepo->getFavorites($user_id, $item->id);
            }else{
                $ip = $request->ip();
                $item->cart = $this->cartRepo->getCart($item->id, $ip);
            }
            $item->discount =  (int)$item->discount;
        }

        $data['items'] = $items;
        $data['breadcrumb'] = $breadcrumb;
        $data['type'] = $type;
        session()->put('searchType', 'noType');
        return view('users.category_type', $data);
    }

    /**
     * Get new arrivals
     * 
     * @param Request $request
     * @param string $sort
     * @return 
     */
    public function getNewArrivals(Request $request, $sort)
    {
        session()->forget('collection');
        session()->forget('category');
        session()->forget('metals');
        session()->forget('gemstones');
        $number = $request->session()->get('number');
        $categories = $this->categoryRepo->getAll();
        $metals = $this->metalRepo->getAll();
        $gemstones = $this->gemstoneRepo->getGemstones();
        $items = $this->itemRepo->latestItems($sort, $number);
        $images = [];
        foreach ($items as $item) {
            if(Auth::check())
            {
                $user_id = Auth::user()->id;
                $item->cart = $this->cartRepo->getUserCart($user_id, $item->id);
                $item->favorite = $this->favoritesRepo->getFavorites($user_id, $item->id);
            }else{
                $ip = $request->ip();
                $item->cart = $this->cartRepo->getCart($item->id, $ip);
            }
            array_push($images, $item->main_image_id);
            $item->discount =  (int)$item->discount;
        }

        $data = [
            'sort' => $sort,
            'metals' => $metals,
            'gemstones' => $gemstones,
            'title' => 'New arrivals jewelry',
            'items' => $items,
            'meta_keywords' => 'New Jewelry,New Silver Jewelry',
            'meta_description' => '',
            'type' => 'Arrivals',
            'breadcrumb' => 'New Arrivals',
        ];
        session()->put('searchType', 'newArrivals');
        return view('users.new_arrivals', $data);
    }

    /**
     * Get items by collection and category
     * 
     * @param Request $request
     * @param string $collName
     * @param string $catName
     * @param string $sort
     */
    public function getCollectionCategories(Request $request, $collName, $catName, $sort)
    {
        session()->forget('collection');
        session()->forget('category');
        session()->forget('metals');
        session()->forget('gemstones');
        $number = $request->session()->get('number');
        $collection = $this->collectionRepo->getCollectionName($collName);
        $category = $this->categoryRepo->getCategoryByName($catName);
        $metals = $this->metalRepo->getAll()->all();
        $gemstones = $this->gemstoneRepo->getGemstones()->all();
        $items = $this->itemRepo->getItems($collection->id, $category->id, $sort, $number);
        $images = [];
        foreach ($items as $item) 
        {
            if(Auth::check())
            {
                $user_id = Auth::user()->id;
                $item->cart = $this->cartRepo->getUserCart($user_id, $item->id);
                $item->favorite = $this->favoritesRepo->getFavorites($user_id, $item->id);
            }else{
                $ip = $request->ip();
                $item->cart = $this->cartRepo->getCart($item->id, $ip);
            }
            array_push($images, $item->main_image_id);
            $item->discount =  (int)$item->discount;
        }
        $searchData = [
            'collection' => $collection->id,
            'category' => $category->id
                ];
        session()->put('collection', $collection->id);
        session()->put('category', $category->id);
        $data = [
            'sort' => $sort,
            'items' => $items,
            'collection' =>$collection,
            'metals' => $metals,
            'gemstones' => $gemstones,
            'searchData' => $searchData,
            'type' => $category->category,
            'title' => 'Jewelry '.$category->category,
            'meta_keywords' => ''.$category->category.' Jewelry,Silver '.$category->category.' Jewelry',
            'meta_description' => '',
            'breadcrumb' => $collection->name,
        ];
        session()->put('searchType', 'noType');
        return view('users.collection_categories', $data);

    }

    /**
     * Search items by discription or tag
     * 
     * @param Request $request
     */
    public function getSearch(Request $request)
    {
        session()->forget('collection');
        session()->forget('category');
        session()->forget('metals');
        session()->forget('gemstones');
        $number = $request->session()->get('number');
        $search = $request->search;
        $search = preg_replace('!\s+!', ' ', $search);
        if($search == ' ')
        {
            return redirect()->back();
        }
        $results = $this->itemRepo->itemsSearch($search, $number);
        $metals = $this->metalRepo->getAll();
        $gemstones = $this->gemstoneRepo->getGemstones();
        $data = [
                'title' => 'Search Category',
                'metals' => $metals,
                'gemstones' => $gemstones,
                'items' => $results,
                'search' => $search,
                'meta_keywords' => 'Search Category',
                'meta_description' => '', 
        ];
        $data['items'] = $results->appends(Input::except('page'));
        session()->put('searchType', 'noType');
        return view('users.search_results', $data);
    }

    /**
     * Change currency
     * 
     * @param Request $request
     * @param string $code
     */
    public function getChangeCurrency(Request $request, $code) 
    {
        session()->put('currency', $code);
        return redirect()->back();
    }

    /**
     * Save pagination number in session
     * 
     * @param Request $request
     * @param $int $number
     */
    public function getSession(Request $request, $number)
    {       
       $request->session()->put('number', $number);
        return redirect()->back();
    }

    /**
     * Get advanced search page
     */
    public function getAdvancedSearchPage()
    {   
        $metals = $this->metalRepo->getAll();
        $gemstones = $this->gemstoneRepo->getGemstones();
        $data = [
            'metals' => $metals,
            'gemstones' => $gemstones,
            'title' => 'Advanced Search',
            'meta_keywords' => 'Advanced Search',
            'meta_description' => '',
        ];
        return view('users.advanced_search', $data);
    }

    /**
     * advanced search by item properties
     *
     * @param Request $request
     */
    public function getAdvancedSearchResult(Request $request)
    {
        $search = $request->all();
        $hasSearch = false;
        foreach($search as $key => $param)
        {
            if($param != "")
               $hasSearch = true ;
        }
        if($hasSearch)
        {
            $items = $this->itemRepo->advancedSearch($search); 
            foreach($items as $item)
            {
                if(Auth::check())
                {
                    $user = Auth::user();
                    $item->cart = $this->cartRepo->getUserCart($user->id, $item->id);
                    $item->favorite = $this->favoritesRepo->getFavorites($user->id, $item->id);
                }else{
                    $ip = $request->ip();
                    $item->cart = $this->cartRepo->getCart($item->id, $ip);
                }
                $item->discount =  (int)$item->discount;
            }
            $metals = [];
            if(isset($search['metals']))
            {        
                foreach($search['metals'] as $metal)
                {
                    $metals[] = $this->metalRepo->getMetalById($metal)->name;
                }
            }
            $gemstones = [];
            if(isset($search['gemstones']))
            {
                foreach($search['gemstones'] as $gemstone)
                {
                    $gemstones[] = $this->gemstoneRepo->getGemstoneById($gemstone)->name;
                }
            }
            if(isset($search['collection']) && $search['collection'] !=0)
            {
               $searchData['collection'] = $this->collectionRepo->getCollection($search['collection'])->name;
            }
            if(isset($search['category']) && $search['category'] !=0)
            {
                $searchData['category'] = $this->categoryRepo->getCategory($search['category'])->category;
            }
            $searchData['title'] =  $search['title'];
            $searchData['subtitle'] = $search['subtitle'];
            $searchData['description'] = $search['description'];
            $searchData['minPrice'] = $search['price_min'];
            $searchData['maxPrice'] = $search['price_max'];
            $searchData['gemstones'] = $gemstones;
            $searchData['metals'] = $metals;

            $data = [
                'title' => 'Search Results | Jewelry Shop',
                'items' => '',
                'search' => $request['description'],
                'searchData' => $searchData,
                'meta_keywords' => $items,
                'meta_description' => '',
            ];
            $data['items'] = $items->appends(Input::except('page'));
            return view('users.advanced_searched_items', $data);
        }else{
            return redirect()->back();
        }
        

    }

    /**
     * Get featured products
     * 
     * @param Request $request
     * @param string $sort
     */
    public function getFeaturedProducts($sort, Request $request)
    {
        $number = session()->get('number');
        session()->forget('collection');
        session()->forget('category');
        session()->forget('metals');
        session()->forget('gemstones');
        $items = $this->itemRepo->featuredItems($sort, $number);
        foreach($items as $item)
        {
            if(Auth::check())
            {
                $user = Auth::user();
                $item->cart = $this->cartRepo->getUserCart($user->id, $item->id);
                $item->favorite = $this->favoritesRepo->getFavorites($user->id, $item->id);
            }else{
                $ip = $request->ip();
                $item->cart = $this->cartRepo->getCart($item->id, $ip);
            }
            if($item->main_image_id)
            {
                $item->image =$this->imageRepo->oneImage($item->main_image_id)->name;
            }else{
                $item->image = $item->images->first()->name;
            }
            $item->discount =  (int)$item->discount;
        }
        $metals = $this->metalRepo->getAll();
        $gemstones = $this->gemstoneRepo->getGemstones();
        $data = [
            'items' => $items,
            'sort' => $sort,
            'metals' => $metals,
            'gemstones' => $gemstones,
            'title' => 'Jewelry Featured Products',
            'meta_keywords' => 'Jewelry Featured Products',
            'meta_description' => '', 
        ];
        session()->put('searchType', 'featureds');
        return view('users.featured_products', $data);
    }

    /**
     * Get category's featured items
     *
     * @param Request $request
     * @param string $sort
     * @param string $name
     */
    public function getCategoryFeaturedItems($name, $sort, Request $request)
    {
        // $number = session()->get('number');
        // $items = $this->itemRepo->categoryFeaturedItems($name, $sort, $number);
        // foreach($items as $item)
        // {
        //     if(Auth::check())
        //     {
        //         $user = Auth::user();
        //         $item->cart = $this->cartRepo->getUserCart($user->id, $item->id);
        //         $item->favorite = $this->favoritesRepo->getFavorites($user->id, $item->id);
        //     }else{
        //         $ip = $request->ip();
        //         $item->cart = $this->cartRepo->getCart($item->id, $ip);
        //     }
        //     if(!$item->collection)
        //     {
        //         $item->coll = 'NoCollection';
        //     }else{
        //         $item->coll = $item->collection->name; 
        //     }
        //     if($item->main_image_id)
        //     {
        //         $item->image =$this->imageRepo->oneImage($item->main_image_id)->name;
        //     }else{
        //         $item->image = $item->images->first()->name;
        //     }
        //     $item->discount =  (int)$item->discount;
        // }
        // $metals = $this->metalRepo->getAll();
        // $gemstones = $this->gemstoneRepo->getGemstones();
        // $data = [
        //     'items' => $items,
        //     'sort' => $sort,
        //     'category' => $name,
        //     'metals' => $metals,
        //     'gemstones' => $gemstones,
        //     'title' => 'Featured '.$name,
        //         ];
        // session()->put('searchType', 'featureds');
        // return view('users.category_featured_items', $data);

    }

    /**
     * Get sort type
     *
     * @param $sort
     * @return redirect
     */
    public function getSortType($sort)
    {
        session()->put('sort', $sort);
        return redirect()->back();
    }

}
