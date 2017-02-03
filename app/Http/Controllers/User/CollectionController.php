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

class CollectionController extends BaseController
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
                                               'getBlog',
                                               'getSearch',
                                               'getAddToShoppingCart',
                                               'getItemData',
                                               'getShoppingCart',
                                               'getLastItem',
                                               'getDeleteCart',
                                               'getEditOrderStatus',
                                               'getCollections'
                                            ]]);
        $ip = $request->ip();
        parent::__construct($categoryRepo, $collectionRepo, $imageRepo, $ip);
    }

    /**
     * Get collections
     * 
     * @param
     * @return 
     */
    public function getCollections()
    {
        $collections = $this->collectionRepo->collections();
        foreach($collections as $collection)
        {
            $id = $collection->id;
            $collection->categories = $this->categoryRepo->getCollCategories($id);
        }
        $data = [
                    'collections' => $collections,
                    'title' => 'jewelry collections',
                    'meta_keywords' => 'jewelry collections,silver jewelry,silver rings,wholesale sterling silver bracelets',
                    'meta_description' => '',
        ];
        return view('users.collections', $data);
    }
}