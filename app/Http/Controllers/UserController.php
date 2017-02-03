<?php  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
use App\Contracts\GalleryInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\ShippingAddressInterface;
use App\Services\UserService;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\LoginRequest; 
use App\Http\Requests\Users\AddToShoppingCardRequest;
use App\Http\Requests\Users\EditContactInformation;
use App\Http\Requests\Users\EditShippingAddress;
use Auth;
use Socialite;
use App\Http\Requests\Users\EditAccountRequest;
use Session, Input , Config;
use Carbon\Carbon;
use Validator;

class UserController extends BaseController
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

    /** the gallery service.
     *
     * @var string
     */
    public $galleryRepo; 

    /** the newsLetter service.
     *
     * @var string
     */
    public $newsLetterRepo;

    /** the address service.
     *
     * @var string
     */
    public $addressRepo;

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
                                GalleryInterface $galleryRepo,
                                NewsLetterInterface $newsLetterRepo,
                                ShippingAddressInterface $addressRepo,
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
        $this->galleryRepo = $galleryRepo;
        $this->addressRepo = $addressRepo;
        $this->newsLetterRepo = $newsLetterRepo;
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
                                               'getNewsLetter',
                                               'getAboutShop',
                                               'getFaq',
                                               'getCustomerService',
                                               'getCleanPieaces',
                                               'postFileUploadReg',
                                               'getSiteMap'

                                            ]]);
        $ip = $request->ip();
        parent::__construct($categoryRepo, $collectionRepo, $imageRepo, $ip);
    }

    /**
     * user home page
     * GET /user/index
     *
     * @return response
     */
    public function getIndex(Request $request)
    {   
        $request->session()->forget('number');
        $request->session()->put('number', 12);
        $number = $request->session()->get('number');
        $categories = $this->categoryRepo->getAll();
        foreach($categories as $key => $value)
        {
            $key = $value->category;
            $category[$key] = $value;
        }

        $user = Auth::user();
        
        $all_featured_items = $this->itemRepo->allFeaturedItems();
        foreach($all_featured_items as $featItem)
        {
            if(!$featItem->collection)
            {
                $featItem->coll = 'NoCollection';
            }else{
                $featItem->coll = $featItem->collection->name;
            }
            $img_Id = $featItem->main_image_id;
            if($img_Id)
            {
                $featItem->image = $this->imageRepo->oneImage($img_Id); 
            }else{
                $featItem->image = $featItem->images->first();
            }
        }
        $all_featured_items_count = $all_featured_items->count();
        $featuredItems = [];
        foreach($all_featured_items as $featured)
        {
            $featuredItems[] = $featured;
        }
        $featuredArr = [];
        for($i = 0; $i <  $all_featured_items_count; $i+=5)
        {
            $featuredArr[] = array_slice($featuredItems, $i, 5);
        }

//        var_dump($this->sliderRepo); die;
        $collectionsSlide = $this->sliderRepo->sliders();

        $gal= $this->galleryRepo->getAll();
        foreach($gal as $key => $value)
        {
            $key = $value->status;
            $gallery[$key] = $value;
        }
        $collGallery = $this->galleryRepo->getGalleryByName("Collections");
        $collImages = $collGallery->images;
        $data = [
            'user' => $user,
            'collectionsSlide' => $collectionsSlide,
            'title' => 'online jewelry shopping',
            'category' => $category,
            'meta_keywords' => 'online jewelry shopping,fashion jewelry,jewelry sets,buy fashion jewelry online',
            'meta_description' => 'Buy fashion jewelry online on OhScarlett.com, Sterling silver jewelry for women, online shopping silver plated pieces, Oh Scarlet silver jewelry, worldwide shipping',
            'gallery' => $gallery,
            'all_featured_items_count' => $all_featured_items_count,
            'featuredArr' => $featuredArr,
            'collImages' => $collImages,
        ];
        return view('users.home', $data);
    }

	/**
     * user registartion 
     * GET /user/registartion
     *
     * @return response
     */
	public function getRegistration()
	{
        $data = [
            'title' => 'Create an Account jewelry Shop',
            'meta_keywords' => 'Create an Account ohscarlett.com',
            'meta_description' => ''
        ];
		return view('auth.register', $data);
	}

	/**
	 * Registering a user.
     * POST user/registartion
	 *
	 * @param UserCreateRequest $request
	 * @return response
	 */
	public function postRegistration(UserCreateRequest $request, Validator $validator)
	{
		$data = $request->inputs();
		$token = str_random(30);
	    $activation_token = $token;
	    $data['activation_token'] = $activation_token;
        $file = $request['image'];
        if($file){
            $data['image'] = $file;
        }
		$registration = $this->userRepo->createOne($data); 

		if ($registration) {
            session()->forget('_old_input');
            $addressData = [
                'user_id' => $registration->id,
                'country' => $request['country'],
                'city' => $request['city'],
                'address' => $request['address'],
                'posatl_code' => $request['postal_code'],
                'state' => $request['state']
                    ];
            $this->addressRepo->createAddress($addressData);
	        $email = $data['email'];
	        $activation_token = $data['activation_token'];
	        $subject = "Account Activation";
	        $mailTemplate = "registration";
	        $maildata = ['activation_token' => $activation_token,
	                     'username' => $data['first_name'] ];
	        $this->mailRepo->send_email($data['email'], $maildata, $mailTemplate, $subject );
            session()->forget('errors');
			return redirect()->back()->with('registration_message', "Your registration has been successful. Please check your email.");                    
		}else{
            return redirect()->back()->withInput($request->all())->withErrors();
        }
	}

	/**
	 * Activating user.
	 * GET user/activation/user 
     *
	 * @param Illuminate\Http\Request $request
	 * @param string $code
	 * @return void
	 */
    public function getActivationUser($code)
    {
    	$userRepo = new UserService();
    	$activation_token = $code;
    	$user = $userRepo->getOne($activation_token);
        $data = [
            'user' => $user 
        ];
    	if($user){
    		$activate = $userRepo->updateByObject($user,['activation_token'=>'', 'is_active' => 1]);
            Auth::login($user);
            return redirect()->action('UserController@getAccountDashboard')->with('activationMessage','Your account is active!');
    	}
    	return redirect()->action('UserController@getIndex'); 
    }

    /**
     * user login
     * POST user/login
     *
     * @param LoginRequest $request
     * @return response
     */
    public function postLogin(Request $request)
    {
    	$email = $request->get('email');
    	$password = $request->get('password');
        $rememberMe = $request->has('remember_me') ? true : false; 
    	if(Auth::attempt(['email' => $email, 'password' => $password], $rememberMe)){
    		$user = Auth::user();
    		if($user->is_active == 1){
                $ip = $request->ip();
                $carts = $this->cartRepo->getAllCartsByIp($ip);
                foreach($carts as $cart)
                {
                    $data = [
                        'user_id' => $user->id,
                        'item_id' => $cart->item_id,
                        'user_ip' => $ip,
                        'quantity' => $cart->quantity,
                        'status' => $cart->status
                    ];
                    $card = $this->cartRepo->getOne($user->id,$cart->item_id);
                    if($card){
                        $data['quantity'] = $card->quantity + $cart->quantity;
                        $newCart = $this->cartRepo->update($card,$data);
                    }else{
                        $data['quantity'] = $cart->quantity;
                        $newCart = $this->cartRepo->createOne($data);                        
                    }
                    $this->cartRepo->deleteOne($cart);
                }
    			return redirect()->action('UserController@getIndex');
    		}else{
                Auth::logout();
    			return redirect()->back()->with('message_login','Please activate your account. Check your email.');
    		}
        }else{
    		return redirect()->action('UserController@getIndex')->with('message_login','Error login and password');
    	}
    }

    /**
     * user logout
     * GET user/logout
     *
     * @return response
     */
    public function getLogout()
    {
    	Auth::logout();
    	return redirect()->action('UserController@getIndex');
    }

    /**
     * Render view for changing password.
     * GET user/forget-password
     *
     * @return view
     */
    public function getForgetPassword()
    {
        $data = [
            'title' => 'Password Request | Jewelry Shop',
            'meta_keywords' => 'Password Request,Jewelry Shop,Ohscarlett Password Request',
            'meta_description' => '', 
        ];
        return view('users.forget_password', $data); 
    }

    /**
     * Sending mail for changing password
     * POST user/forget-password
     *
     * @param Request $request
     * @return responce
     */
    public function postForgetPassword(Request $request)
    {
        $email = $request->get('email');
        if($user = $this->userRepo->getOneByEmail($email)){
            $code = str_random(30);
            $this->userRepo->updateByObject($user, ['activation_token' => $code]);
            $subject = "Forget Password";
            $mailTemplate = "forgetPassword";
            $maildata = [
                'username' => $user->first_name,
                'passLink' => action('UserController@getChangePassword', $code),
            ];
            $this->mailRepo->send_email($email, $maildata, $mailTemplate, $subject);
            return redirect()->back()->with('message', "Please, check your email.");
        }else{
            return redirect()->back()->with('error_danger', "Invalid email.");
        }
    }

    /**
     * change password page
     * GET user/change-password
     *
     * @param string $code
     * @return responce
     */
    public function getChangePassword($code)
    {
        $user = $this->userRepo->getOne($code);
        if($user){
            $data = [
                'id' => $user->id,
                'title' => 'Change Password'
            ];
            return view('users.new_password',$data);
        }else{
            return redirect()->action('UserController@getIndex');
        }
    }

    /**
     * change password.
     * POST user/change-password
     *
     * @param ChangePasswordRequest $request
     * @return responce
     */
    public function postChangePassword($id,ChangePasswordRequest $request)
    {
        $inputs = $request->inputs();
        $data = [
            'new_password' => $inputs['new_password'],
            'new_password_confirmation' => $inputs['new_password_confirmation']
                ];
        $change = $this->userRepo->updateById($id,['password' => $inputs['new_password']]);
        if($change){
            $user = $this->userRepo->getUser($id);
            $this->userRepo->updateById($id, ['activation_token' => str_random(30)]);
            Auth::login($user);
            return redirect()->action('UserController@getMyAccount')->with('passwordMessage','Your password was successfully changed!');
        }else{
            return redirect()->back();
        }
    }

    /**
     * get Facebook login page.
     * 
     * @return redirect
     */
    public function getFacebookLogin()
    {
       return Socialite::driver('facebook')->redirect();
    }

    /**
     * get Facebook callback
     * GET user/facebook-callback
     *
     * @return redirect
     */
    public function getFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $id = $user->id;
        $facebook_user = $this->userRepo->getOneByCoshialId($id,'facebook_id');
        if($facebook_user){
            $new_user = $facebook_user;
        }else{
            $fullName = $user->name;
            $email = $user->email;
            if($email == null)
            {
                $email = "";
            }
            $exp = explode(' ', $fullName);
            $first_name = $exp['0'];
            $last_name = $exp['1'];
            $facebook_id = $id;
            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'is_active' => true,
                'registered_with' => 'facebook',
                'facebook_id' => $facebook_id,
            ];
            $facebook_user = $this->userRepo->createOne($data);
            $new_user = $facebook_user;
        }

        Auth::login($new_user);
        return redirect()->action('UserController@getIndex');
    }

    /**
     * get Google login page.
     * GET user/google-login
     *
     * @return redirect
     */
    public function getGoogleLogin()
    {
       return Socialite::driver('google')->redirect();
    }

    /**
     * get Google callback
     * GET user/google-callback
     *
     * @return redirect
     */
    public function getGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $id = $user->id;
        $google_user = $this->userRepo->getOneByCoshialId($id,'google_id');
        if($google_user){
            $new_user = $google_user;
        }else{
            $email = $user->email;
            if($email == null)
            {
                $email = "";
            }
            $first_name = $user->user['name']['givenName'];
            $last_name = $user->user['name']['familyName'];
            $google_id = $id;
            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'is_active' => true,
                'registered_with' => 'google',
                'google_id' => $google_id,
            ];
            $google_user = $this->userRepo->createOne($data);
            $new_user = $google_user;
        }

        Auth::login($new_user);
        return redirect()->action('UserController@getIndex');
    }

    /**
     * get Twitter login page.
     * 
     *
     * @return redirect
     */
    public function getTwitterLogin()
    {
       return Socialite::driver('twitter')->redirect();
    }

    /**
     * get Twitter callback
     * GET user/twitter-callback
     *
     * @return redirect
     */
    public function getTwitterCallback()
    {
        $user = Socialite::driver('twitter')->user();
        $id = $user->id;
        $twitter_user = $this->userRepo->getOneByCoshialId($id,'twitter_id');
        if($twitter_user){
            $new_user = $twitter_user;
        }else{
            $fullName = $user->name;
            $email = $user->email;
            $exp = explode(' ', $fullName);
            $first_name = $exp['0'];
            if(count($exp)>2){
                $last_name = $exp['1'];
            }else{
                $last_name = '';
            }
            $email = $user->email;
            if($email == null)
            {
                $email = "";
            }
            $twitter_id = $id;
            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'is_active' => true,
                'registered_with' => 'twitter',
                'twitter_id' => $twitter_id,
            ];
            $twitter_user = $this->userRepo->createOne($data);
            $new_user = $twitter_user;
        }

        Auth::login($new_user);
        return redirect()->action('UserController@getIndex');
    }

    /**
     * get user's account.
     * GET user/my-account
     *
     * @return view
     */
    public function getMyAccount()
    {
        $user = Auth::user();
        $data = [
            'user' => $user,
            'meta_description' => '',
            'meta_keywords' => 'Account Information',
            'title' => 'Account Information'
        ];
        return view('users.my_account',$data);        
    }

    /**
     * Edit user's account
     * POST user/edit-account
     *
     * @param EditAccountRequest $request
     * @param int $id
     * @return redirect
     */
    public function postEditAccount($id,EditAccountRequest $request)
    {
        $data = $request->all();
        $file = $request['image']; 
        $dataUpdate = [
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
        ];
        // dd($file);
        $user = $this->userRepo->getUserByEmail($data['Email']); 
        if($user && $user->id != $id)
        {
            return redirect()->back()->with('account_error', 'The email has already been taken.');
        }else{
            $dataUpdate['email'] = $data['Email']; 
        } 
        if($file)
        {
            $destinationPath = public_path().'/uploads';
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension;
            $file->move($destinationPath, $fileName);
            $dataUpdate['image'] = $fileName;
        }
        $this->userRepo->updateById($id,$dataUpdate);
        return redirect()->back()->with('account_message','Your account was successfully updated!');
    }

    /**
     * get contact
     * 
     * @return view
     */
    public function getContact()
    {
        $admin = $this->userRepo->getAdmin();
        $user = Auth::user();
        if($user){
            $name = $user->first_name;
            $email = $user->email;
            $data = [
                'admin' => $admin ,
                'name' => $name,
                'email' => $email,
                'status' => 'contact',
                'title' => 'Contact Jewelry',
                'meta_description' => '',
                'meta_keywords' => 'Contact Jewelry'
            ];
        }else
        {
            $data = [
                'admin' => $admin,
                'name' => '', 
                'email' => '',
                'status' => 'contact',
                'title' => 'Contact Jewelry',
                'meta_description' => '',
                'meta_keywords' => 'Contact Jewelry'
            ];
        }
        return view('users.contact', $data);
    }

    /**
     * View contact info and shipping address
     */
    public function getEditAddressBook()
    {
        $user = Auth::user();
        if($user->role == 'user' && isset($user->shipping))
        {
            $shipping = $user->shipping;
        }else{
            $shipping = $user;
        }
        // dd($shipping, $user);
        $data = [
            'user' => $user,
            'shipping' => $shipping,
            'title' => 'Address Book',

        ];
        return view('users.address_book', $data);
    }

    /**
     * Get user's address book
     */
    public function getAddressBook()
    {
        $user = Auth::user();
        if(isset($user->shipping))
        {
            $shipping = $user->shipping;
        }else{
            $shipping = $user;
        }
        $data = [
            'user' => $user,
            'shipping' => $shipping,
            'title' => 'Edit Address Book',
            'meta_keywords' => 'Edit Address Book',
            'meta_description' => '',
        ];
        return view('users.edit_address_book', $data);
    }

    /**
     * Edit address
     */
    public function postEditContactInformation(EditContactInformation $editContactRequest, $id)
    {
        $request = $editContactRequest->all();
        $data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'city' => $request['city'],
            'country' => $request['country'],
            'postal_code' => $request['postal_code'],
            'address' => $request['address'],
            'state' => $request['state']
                ];
        $user = Auth::user();
        $userId = $user->id;
        $this->userRepo->updateById($userId,$data); 
        return redirect()->back()->with('message','Your contact information was successfully changed!');
    }

    /**
     * edit shipping address
     */
    public function postEditShippingAddress(EditShippingAddress $shippingRequest, $id)
    {
        $request = $shippingRequest->all();
        $data = [
            'city' => $request['city'],
            'country' => $request['country'],
            'postal_code' => $request['postal_code'],
            'address' => $request['address'],
            'state' => $request['state']
                ];
        $user = Auth::user();
        $userId = $user->id;
        if($user->shipping)
        {
            $this->addressRepo->updateAddressByUserId($userId, $data);
        }else{
            $data['user_id'] = $userId;
            $add = $this->addressRepo->createAddress($data);
        }
        return redirect()->back()->with('message','Your shipping address was successfully changed!');
    }

    /**
     * Get account dashboard
     */
    public function getAccountDashboard()
    {
        $user = Auth::user();
        $data = [
            'user' => $user,
            'meta_keywords' => 'Dashboard Jewelry',
            'meta_description' => '',
            'title' => 'Dashboard'
        ];
        return view('users.account_dashboard', $data);
    }

    /**
     * Send contact
     *
     * @param Request $request
     * @return view
     */
    public function postSendContact(Request $request)
    {
        $subject = $request->get('subject');
        $email = $request->get('email');
        $mailTemplate = "contact"; 
        $maildata = ['message' => $request->get('message')]; 
        $rules = ['email' => 'required|email'];
        $data = ['email' => $email];
        if(Auth::check() && Auth::user()->email != $email)
        {
            return redirect()->back()->with('contact_error', 'Please, enter your email address.');
        }
        $validator = Validator::make($data, $rules);
        if($validator->fails())
        {
            return redirect()->back()->with('contact_error', 'Please, enter a valid email address.');
        }else{
            $this->mailRepo->send_email_contact($email, $maildata, $mailTemplate, $subject );
            return redirect()->back()->with('contact_message', 'Your message was sent successfully.');
        }
    }

    /**
     * Get info about shop
     * 
     * @return  
     */
    public function getAboutShop()
    {
        $data = [
            'title' => 'About Jewelry',
            'meta_keywords' => 'Jewelry About,About OhScarlett Jewelry',
            'meta_description' => ''
        ];
        return view('users.about_shop',$data);
    }

    /**
     * Subscribe user
     * 
     * @param Request $request
     */
    public function getNewsLetter(Request $request)
    {
        $user_email = $request->user_email;
        $subscriber = $this->newsLetterRepo->getSubscriptionByEmail($user_email);
        $data_subscribed = 'You are already subscribed to our news.';
        $data_login = 'Please , log in to subscribe with this email.';
        $data_thanks = 'Thank You for subscribing to our Newsletter!';
        $data_invalid = 'Please, enter a valid email address.';
        $data_enter = 'Please , enter your email address.';

        if($subscriber)
        {
            if($request->footer)
                {
                    $array = [
                        'success' => false,
                        'failed' => true,
                        'error'   => $data_subscribed
                    ];
                    return new Response(json_encode($array), 200);

                }else{

                    $array = [
                        'success' => false,
                        'failed' => true,
                        'error'   => $data_subscribed
                    ];
                    return new Response(json_encode($array), 200);
                }
        }
        $valData = ['user_email' => $user_email];
        $rules = ['user_email' => 'required|email'];
        $validator = Validator::make($valData, $rules);
        if($validator->fails())
        {
            if($request->footer)
            {
                $array = [
                    'success' => false,
                    'fail' => true,
                    'error'   => $data_invalid
                ];
                return new Response(json_encode($array), 200);
            }else{

                $array = [
                    'success' => false,
                    'fail' => true,
                    'error'   => $data_invalid
                ];
                return new Response(json_encode($array), 200);
            }
        }
            if(Auth::check())
            {
                $user_id = Auth::user()->id;
                $authUserEmail = Auth::user()->email;
                $user = $this->newsLetterRepo->getSubscriptionByUserId($user_id);
                $userEmail = $this->userRepo->getUserByEmail($user_email);
                if(($userEmail && $userEmail->id != $user_id) || ($user == null &&  $authUserEmail != $user_email))
                {
                    $array = [
                        'success' => false,
                        'fail' => true,
                        'error'   => $data_enter
                    ];
                    return new Response(json_encode($array), 200);
                }else{
                    $data = ['user_email' => $user_email, 'user_id' => $user_id, 'status' => 'unsent'];
                }
                if($user)
                {
                    $array = [
                        'success' => false,
                        'fail' => true,
                        'error'   => $data_subscribed
                    ];
                    return new Response(json_encode($array), 200);
                }
            }else{
                $user = $this->userRepo->getUserByEmail($user_email);
                $user_ip = $request->ip();
                if($user){
                    $array = [
                        'success' => false,
                        'fail' => true,
                        'error'   => $data_login
                    ];
                    return new Response(json_encode($array), 200);
                }else{
                    $data = ['user_email' => $user_email, 'user_ip' => $user_ip, 'status' => 'unsent'];
                }
            }
                $this->newsLetterRepo->addNewsLetter($data);
                $array = [
                    'success' => true,
                    'fail' => false,
                    'message'   => $data_thanks
                ];
                return new Response(json_encode($array), 200);
    }

    /**
     * Get FAQ
     */
    public function getFaq()
    {
        $data = [
            'title' => 'faq Jewelry',
            'meta_keywords' => 'Jewelry faq',
            'meta_description' => ''
        ];
        return view('users.faq', $data);
    }

    /**
     * Get Customer Service
     */
    public function getCustomerService()
    {
        $data = [
            'title' => 'Customer Service',
            'meta_keywords' => 'Customer Service Ohscarlett,Service Customer',
            'meta_description' => ''
        ];
        return view('users.customer_service', $data);
    }

    /**
     * Unsubscribe user
     * 
     * @param Request $request
     */
    public function getUnsubscribe(Request $request)
    {
        if(Auth::check())
        {
            $user_id = $request->id;
            $this->newsLetterRepo->deleteSubscriptionByUserId($user_id);
        }else
        {
            $user_ip = $request->ip();
            $this->newsLetterRepo->deleteSubscriptionByUserIp($user_ip);
        }

        return redirect()->action('UserController@getIndex');
        
    }

    /**
     * 
     */
    public function getCleanPieaces()
    {
        $data = [
            'title' => 'How To Clean The Pieces',
            'meta_keywords' => 'How To Clean The Pieces',
            'meta_description' => ''
        ];
        return view('users.how_to_clean_the_pieces', $data);
    }

    /**
     * Registration image upload
     */
    public function postFileUploadReg(Request $request)
    {
        $file = $request->file('file');
        $destinationPath = public_path().'/uploads';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(8).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $data=[
            'name' => $fileName
        ];
        return response()->json($data);
    }

    /**
     * Get site map
     */
    public function getSiteMap()
    {
        
        $data = [
            'title' => 'Site Map',
            'meta_keywords' => 'Ohscarlett site map',
            'meta_description' => '', 
        ];
        return view('users.site_map', $data);
    }
    
    // /**
    //  * Search
    //  * 
    //  * @return resposne
    //  */
    // public function getSearch(Request $request)
    // {
    //     $data = $request->all();
    //     $items = $this->itemRepo->itemsSearch($data);
    //     $collections = $this->collectionRepo->collections()->all();
    //     $categories = $this->categoryRepo->getAll()->all();
    //     $metals = $this->metalRepo->getAll()->all();
    //     $gemstones = $this->gemstoneRepo->getGemstones()->all();
       
    //     $images = [];
    //     foreach ($items as $item) {
    //         array_push($images, $item->main_image_id);
    //     }
    //     // $mainImages = [];
    //     // foreach ($images as $key => $value) {
    //     //     $img = $this->imageRepo->showImage($value);
    //     //     array_push($mainImages, $img);
    //     // }
    //     $searchData = $request->all();       
        
    //     $data = [
    //         'collections' => $collections,
    //         'categories'  => $categories,
    //         'metals' => $metals,
    //         'gemstones' => $gemstones,
    //         //'mainImages' => $mainImages,
    //         'searchData' => $searchData           
    //     ];
    //     foreach ($items as $item){
    //         $reviews = $this->reviewRepo->getReviewByItemId($item->id);
    //         $item['review'] = count($reviews);
    //     }

    //     $data['items'] = $items->appends(Input::except('page'));
    //     return view('users.search_items', $data);
    // }


    // /**
    //  * get shopping cart.
    //  * GET user/shopping-card
    //  *
    //  * @return response
    //  */
    // public function getShoppingCart(Request $request)
    // {
    //     $ip = $request->ip();
    //     if(Auth::check())
    //     {
    //         $user = Auth::user();
    //         $user_id = $user->id;
    //         $items = $user->items;
    //         $count = $items->count();
    //         $data['user'] = $user;
    //     }else{

    //         $carts = $this->cartRepo->getAllCartsByIp($ip);
    //         $items = [];
    //         foreach($carts as $cart)
    //         {
    //             array_push($items, $this->itemRepo->getItem($cart->item_id));
    //         }
    //         $count = count($items);
            
    //     }

    //     $userItems = [];
    //     $itemsArr = [];
    //     foreach($items as $item)
    //     {
    //         $image_id = $item->main_image_id;
    //         if(!$image_id)
    //         {
    //             $item_images = $this->imageRepo->itemImages($item->id);
    //             if($item_images)
    //             {
    //                 $image = $this->imageRepo->showImage($item->id);
    //                 $image_id = $image['id'];

    //             }
    //         }
    //             if(!Auth::check()){
    //                 $cart = $this->cartRepo->getCartByIp($ip, $item->id);
    //                 $quantity = $cart->quantity;
    //             }else{
    //                 $quantity = 0;
    //             }
    //         $main_image = $this->imageRepo->oneImage($image_id);
    //         $itemMainImage = $this->imageRepo->oneImage($image_id);
    //         $userItems = [
    //         'main_image' => $itemMainImage,
    //         'item' => $item,
    //         'quantity' => $quantity ];
    //         $itemsArr[] = $userItems;
    //     }
        
    //     $data = [
    //         'itemsArr' => $itemsArr,
    //         'count' => $count
    //     ];
        
            

        

    //     return view('users.shopping_cart', $data);
    // }

    // /**
    //  * add shoopping cart
    //  * POST user/add-to-shopping-cart
    //  *
    //  * @param Request $request
    //  * @return response
    //  */
    // public function getAddToShoppingCart($id,Request $request)
    // {
    //     if (Auth::check()) 
    //     {
    //         $cart = $this->cartRepo->getOne(Auth::user()->id, $id);
    //         if (!$cart) {
    //             $data = [
    //                 'user_id' => Auth::user()->id,
    //                 'item_id' =>$id,
    //                 'quantity' => $request->get('quantity'),
    //                 'user_ip' => $request->ip()
    //             ];
    //             $cart = $this->cartRepo->createOne($data);    
    //         }else{
    //             $quantity = $cart->quantity;
    //             $quantity +=$request->get('quantity');
    //             $data = ['quantity' => $quantity];
    //             $cart = $this->cartRepo->update($cart, $data);
    //         }
    //         $user = $this->userRepo->increment(Auth::user(), $request->get('quantity'));
    //     } else
    //     {
    //         $ip = $request->ip();
    //         $cart = $this->cartRepo->getCartByIp($ip,$id);
    //         if(!$cart){
    //             $data = [
    //                 'user_id' => "",
    //                 'item_id' =>$id,
    //                 'quantity' => $request->get('quantity'),
    //                 'user_ip' => $ip
    //             ];
    //             $cart = $this->cartRepo->createOne($data); 
    //         }else{
    //             $quantity = $cart->quantity;
    //             $quantity +=$request->get('quantity');
    //             $data = ['quantity' => $quantity];
    //             $cart = $this->cartRepo->update($cart, $data);
    //         }
    //     } 

    //     return response()->json($data);
    // }

    // /**
    //  * update cart.
    //  * POST user/update-cart
    //  *
    //  * @param Request $request
    //  * @return response
    //  */
    // public function getUpdateCart(Request $request, $item_id)
    // {
    //     $user_id = Auth::user()->id;
    //     $cart = $this->cartRepo->getOne($user_id, $item_id);
    //     $quantity = $request['new_quantity'];
    //     $data['quantity'] = $quantity;
    //     $this->cartRepo->update($cart, $data);
    //     return response()->json([$data]);
    // } 

    // /**
    //  * 
    //  */
    // public function getDeleteCart(Request $request,$item_id)
    // {
    //     if(Auth::check()){
    //         $user_id = Auth::user()->id;
    //         $object = $this->cartRepo->getOne($user_id, $item_id);
    //     }else{
    //         $ip = $request->ip();
    //         $object = $this->cartRepo->getCartByIp($ip, $item_id);
    //     }
    //     $this->cartRepo->deleteOne($object);
    //     return response()->json($object);
    // }
// <<<
//     // /**
//     //  * get all items sidebar
//     //  * GET user/all-items-sidebar
//     //  *
//     //  * @return response
//     //  */
//     // public function getAllItemsSidebar()
//     // {
//     //     $items = $this->itemRepo->allItems();
//     //     $categories = $this->categoryRepo->getAll();
//     //     $collections = $this->collectionRepo->collections();
//     //     $user = Auth::user();
//     //     $data = [
//     //         'items' => $items,
//     //         'categories' => $categories,
//     //         'collections' => $collections,
//     //         'user' => $user
//     //     ];
//     //     return view('users.all_items_sidebar', $data);
//     // }

//     // /**
//     //  * get all items list sidebar
//     //  * GET user/all-items-list-sidebar
//     //  *
//     //  * @return view
//     //  */
//     // public function getAllItemsListSidebar()
//     // {
//     //     $items = $this->itemRepo->allItems();
//     //     $categories = $this->categoryRepo->getAll();
//     //     $collections = $this->collectionRepo->collections();
//     //     $user = Auth::user();
//     //     $data = [
//     //         'items' => $items,
//     //         'categories' => $categories,
//     //         'collections' => $collections,
//     //         'user' => $user
//     //     ];
//     //     return view('users.all_items_list_sidebar',$data);
//     // }
// >>>

    // /**
    //  * get item details
    //  * GET user/item
    //  *
    //  * @param integer $id
    //  * @return view
    //  */
    // public function getItem($col, $cat, $slug, Request $request)
    // {
    //     $user = Auth::user();
    //     $item = $this->itemRepo->showItem($slug);
    //     if(Auth::check())
    //     {
    //         $cart = $this->cartRepo->getUserCart($user->id, $item->id);
    //         $user_id = Auth::user()->id;
    //         $favorite = $this->favoritesRepo->getFavorites($user_id, $item->id);
    //         if($favorite)
    //         {
    //             $status = 1;
    //         }else{
    //             $status = 0;
    //         }
    //     }else{
    //         $cart =  $this->cartRepo->getCart($item->id, $request->ip());
    //         $status = 0;
    //     }
    //     $main_image_id = $item->main_image_id;
    //     if($main_image_id)
    //     {
    //         $main_image = $this->imageRepo->oneImage($main_image_id);
    //     }else{
    //         $main_image = "";
    //     }
    //     $metal_id = $item->metal_id;
    //     $metal = $this->metalRepo->getMetalById($metal_id);       
    //     $count = count($this->reviewRepo->getReviewByItemId($item->id));
    //     $reviews = [];
    //     $reviews = $this->reviewRepo->getReviewOrder($item->id);
    //     foreach ($reviews as $review){
    //         $date = $review->created_at;
    //         $date = date_format($date, 'F j Y');
    //         $review['date'] = $date;
    //     }
    //     $data = [
    //         'item' => $item,
    //         'metal' => $metal,
    //         'count' => $count,
    //         'reviews' => $reviews,
    //         'status' => $status,
    //         'cart' => $cart,
    //         'main_image' => $main_image
    //     ];
    //     return view('users.item_details', $data);
    // }

    // /**
    //  * Get item details
    //  * GET user/item
    //  *
    //  * @param string $type
    //  * @param integer $id
    //  * @return view
    //  */
    // public function getItems($type, $name)
    // {

    //     $collections = $this->collectionRepo->collections()->all();
    //     $categories = $this->categoryRepo->getAll()->all();
    //     $metals = $this->metalRepo->getAll()->all();
    //     $gemstones = $this->gemstoneRepo->getGemstones()->all();
    //     $items = $this->itemRepo->showItemList()->all();
    //     $images = [];
    //     $status = [];
    //     foreach ($items as $item) {
    //             if(Auth::check())
    //             {
    //                 $user_id = Auth::user()->id;
    //                 $favorite = $this->favoritesRepo->getFavorites($user_id, $item->id);
    //                 if($favorite)
    //                 {
    //                     $status[] = 1;
    //                 }else{
    //                     $status[] = 0;
    //                 }
    //             }else{
    //                 $status[] = 0;
    //             }
    //             array_push($images, $item->main_image_id);
    //     }
    //     // $mainImages = [];
    //     // foreach ($images as $key => $value) {
    //     //     $img = $this->imageRepo->showImage($value);
    //     //     array_push($mainImages, $img);
    //     // }
    //     $data = [
    //         'collections' => $collections,
    //         'categories'  => $categories,
    //         'metals' => $metals,
    //         'gemstones' => $gemstones,
    //         //'mainImages' => $mainImages
    //         'status' => $status
    //     ];

    //     if ($type == 'category') {
    //         $itemsCategory = $this->itemRepo->getItemsByCategory($name);
    //         $items = $itemsCategory;
    //     } elseif ($type == 'collection') {
    //         $itemsCollections = $this->itemRepo->getItemsByColl($name);
    //         $items = $itemsCollections; 
    //     }
    //     foreach ($items as $item){
    //         $reviews = $this->reviewRepo->getReviewByItemId($item->id);
    //         $item['review'] = count($reviews);
    //     }
    //     $data['items'] = $items;
    //     return view('users.items_list', $data);
    // }



    // /**
    //  * Blog view
    //  * 
    //  * @return view
    //  */
    // public function getBlog()
    // {   
    //     $videoArray = [];
    //     $titleArray = [];
    //     $videos = $this->videoRepo->getVideos();
    //     foreach($videos as $video)
    //     {
    //         $url = $video->name;
    //         if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
    //         $name = $match[1];
    //         $video['video'] = $name;
    //         $item = $video->items;
    //         $date = $item->created_at;
    //         $date = date_format($date, 'F j Y');
    //         $video->items['date'] = $date;
    //     }
    //     return view('users.blog', ['videoArray' => $videos]);

    // }

    // /**
    //  * Add to favorites
    //  * 
    //  * @param Request $request
    //  * @return responce
    //  */ 
    // public function getAddToFavorites(Request $request)
    // {
    //     $user_id = Auth::user()->id;
    //     $item_id = $request->item_id;
    //     $favorites = $this->favoritesRepo->getFavorites($user_id, $item_id);
    //     $data = ['user_id' => $user_id, 'item_id' =>$item_id];
    //     if($favorites)
    //     {
    //         $this->favoritesRepo->deleteFromFavorites($user_id, $item_id);
    //     }
    //     else
    //     {
    //         $this->favoritesRepo->addToFavorites($data);
    //     }

    //     return response()->json(["status" => 1]);
    // }

    // /**
    //  * Remove from favorites
    //  *
    //  * @param Request $request
    //  * @return responce
    //  */
    // public function getDeleteFromFavorites(Request $request)
    // {
    //     $user_id = Auth::user()->id;
    //     $item_id = $request->item_id;
    //     $this->favoritesRepo->deleteFromFavorites($user_id, $item_id);
    //     return responce()->json(["status" => 1]);
    // }

    // /**
    //  * Post add review
    //  * POST /user/add-review/{id}
    //  * 
    //  * @param integer $id
    //  * @param Request $request
    //  *
    //  * @return redirect 
    //  */
    // public function postAddReview($id,Request $request)
    // {
    //     $data = $request->all();
    //     $validator = Validator::make($data, [
    //         'review' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         $errors = $validator->messages();
    //         return redirect()->back()->with(['errors'=>$errors]);
    //     }
    //     $dataReview = [
    //         'review' => $data['review'],
    //         'user_id' => Auth::user()->id,
    //         'item_id' => $id,
    //         'status' => 'unapproved'
    //     ];
    //     $review = $this->reviewRepo->getAddReview($dataReview);
    //     return redirect()->back();
    // }
   

    // /**
    //  * get add item-rate
    //  * GET /user/item-rate
    //  * 
    //  * @param Request $request
    //  * @return json 
    //  */
    // public function getItemRate(Request $request)
    // {
    //     $data = $request->all();
    //     $id = $data['item_id'];
    //     $rating = $data['rating'];
    //     $data['user_id'] = Auth::user()->id;
    //     $rating = $this->ratingRepo->getRatingByIds($id,Auth::user()->id);
    //     if($rating){
    //         $rating->update($data);
    //     }else{
    //         $this->ratingRepo->getAddRating($data);   
    //     }
    //     $ratings = $this->ratingRepo->getRatingByItemId($id);
    //     $count = count($ratings);
    //     $rate = 0;
    //     foreach($ratings as $rating){
    //         $rate += $rating->rating;
    //     }
    //     $rating = round($rate/$count);
    //     $userStatus = $this->itemRepo->updateItem($id,['rating'=>$rating]);
    //     $data = [
    //         'rating' => (int)$rating,
    //     ];
    //     return response()->json($data);
    // }


    // /**
    //  * Get favorites page
    //  *
    //  * @return view users.favorites
    //  */

    // public function getFavorites()
    // {
    //     $user_id = Auth::user()->id;
    //     $user = Auth::user();
    //     $favorites = $user->favorites;
    //     $main_images = [];
    //     foreach($favorites as $key => $favorite)
    //     {   
    //         $main_images[$key] = $this->imageRepo->showImage($favorite->main_image_id);
    //         if(!$main_images[$key])
    //         {
    //             $images = $favorite->images;
    //             if($images)
    //             {
    //                 $image = $this->imageRepo->showImage($favorite->id);
    //                 $image_id = $image['id'];
    //                 $main_images[$key] = $this->imageRepo->oneImage($image_id);
    //             }
    //         }

    //     }
    //     $data = ['favorites' => $favorites, 'main_images' => $main_images];
    //     return view('users.favorites', $data);
    // }

    // /**
    //  * Open item's view modal
    //  * 
    //  * @param int $id
    //  * @return modal
    //  */
    // public function getItemData($slug, Request $request)
    // {
    //     $user = Auth::user();
    //     $item = $this->itemRepo->showItem($slug);
    //     $imageCount = $item->images()->count();
    //     if(Auth::user())
    //     {
    //         $cart = $this->cartRepo->getUserCart($user->id, $item->id); 
    //     }else{
    //          $cart =  $this->cartRepo->getCart($item->id, $request->ip());
    //     }
    //     $image_id = $item->main_image_id;
    //         if(!$image_id)
    //         {
    //             $item_images = $this->imageRepo->itemImages($item->id);
    //             if($item_images)
    //             {
    //                 $image = $this->imageRepo->showImage($item->id);
    //                 $image_id = $image['id'];

    //             }
    //         }
    //     $main_image = $this->imageRepo->oneImage($image_id);
    //     $reviews = [];
    //     $reviews = $this->reviewRepo->getReviewOrder($item->id);
    //     foreach ($reviews as $review){
    //         $date = $review->created_at;
    //         $date = date_format($date, 'F d Y');
    //         $review['date'] = $date;
    //     }
    //     $count = count($this->reviewRepo->getReviewByItemId($item->id));
    //     $data =[
    //         'cart' => $cart,
    //         'item' => $item,
    //         'main_image' => $main_image['name'],
    //         'reviews' => $reviews,
    //         'count' => $count,
    //         'imageCount' => $imageCount
    //     ];
    //     $showView = view('users.modal_view', $data)->render();
    //     return response()->json(["resource"=>$showView]);
    // }

    // /**
    //  * Order item
    //  * 
    //  * @param
    //  * @return view users.proceed_to_checkout
    //  */
    // public function getOrderItems()
    // {
        
    //     $user = Auth::user();
    //     $user_id = $user->id;
    //     $items = $user->items;
    //     $userItems = [];
    //     $itemsArr = [];
    //     foreach($items as $item)
    //     {
    //         $image_id = $item->main_image_id;
    //         if(!$image_id)
    //         {
    //             $item_images = $this->imageRepo->itemImages($item->id);
    //             if($item_images)
    //             {
    //                 $image = $this->imageRepo->showImage($item->id);
    //                 $image_id = $image['id'];

    //             }
    //         }
    //         $main_image = $this->imageRepo->oneImage($image_id);
    //         $itemMainImage = $this->imageRepo->oneImage($image_id);
    //         $userItems = [
    //         'main_image' => $itemMainImage,
    //         'item' => $item ];
    //         $itemsArr[] = $userItems;
    //     }
    //     $carts = $this->cartRepo->getCartsForOrder($user_id);
    //     $count = $carts->count();
    //     $total = 0;
    //     $carts = $this->cartRepo->getCartsForOrder($user_id);
    //     foreach($carts as $cart)
    //     {
    //         $item = $this->itemRepo->getItem($cart->item_id);
    //         $quantity = $cart->quantity;
    //         $total += $item->new_price * $quantity; 
    //     }

    //     $data = [
    //         'itemsArr' => $itemsArr,
    //         'count' => $count,
    //         'user' =>$user,
    //         'total' => $total
    //     ];
    //     return view('users.proceed_to_checkout', $data);
    // }

    // /**
    //  * Confirm order
    //  * 
    //  * @param
    //  * @return users.order
    //  */
    // public function getOrderPage()
    // {        
    //     return view('users.order');

    // }

    // /**
    //  * Order
    //  * 
    //  * @param
    //  * @return view users.shopping_cart
    //  */
    // public function getOrder()
    // {
    //     if(Auth::check()){
    //         $user = Auth::user();
    //         $carts = $this->cartRepo->getCartsForOrder($user->id);
    //         foreach($carts as $cart)
    //         {
    //             $item = $this->itemRepo->getItem($cart->item_id);
    //             $data = ['status' => 'ordered'];
    //             $this->cartRepo->update($cart, $data);
    //             $orderData = ['item_id' => $cart->item_id,
    //                           'user_id' => $cart->user_id,
    //                           'quantity' => $cart->quantity
    //             ];
    //             $order = $this->orderRepo->getOrder($user->id, $item->id);
    //             if(!$order){
    //                 $this->orderRepo->createOrder($orderData);
    //             }else{
    //                 $quantity = $cart->quantity + $order->quantity;
    //                 $this->orderRepo->updateOrder($order, ['quantity' => $quantity]);
    //             }
                
    //             $this->cartRepo->deleteOne($cart);
    //         }
    //         return redirect()->action('UserController@getShoppingCart');
    //     }else{
    //         return redirect()->action('UserController@getLogin');
    //     }
    // }
    // /**
    //  * Remove from order list
    //  * 
    //  * @param int $item_id
    //  * @param bool $order_status
    //  * @return response
    //  */
    // public function getEditOrderStatus($item_id,$order_status)
    // {
    //     $user = Auth::user();
    //     $user_id = Auth::user()->id;
    //     $cart = $this->cartRepo->getOne($user_id, $item_id);
    //     $this->cartRepo->updateOrderStatus($cart, $order_status);
    //     $count = $this->cartRepo->getCartsForOrder($user_id);
    //     $data['count'] = $count;
    //     $items = $user->items;
    //     $subtotal=0;
    //     foreach($items as $item)
    //     {
    //         $cart = $this->cartRepo->getOne($user_id, $item_id);
    //         $quantity = $cart->quantity;
    //         $subtotal+=$item->new_price * $quantity; 
    //     }
    //     $data['subtotal'] = $subtotal;
    //     return response()->json($data);
    // }

    // /**
    //  * Get ordered items
    //  * 
    //  * @param
    //  * @return view users.order_list
    //  */
    // public function getOrderedItems()
    // {

    //     $user = Auth::user();
    //     $user_id = $user->id;
    //     $orderedItems = $user->orders;
    //     $data['user'] = $user;
    //     $userItems = [];
    //     $itemsArr = [];
    //     foreach($orderedItems as $item)
    //     {
    //         $image_id = $item->main_image_id;
    //         if(!$image_id)
    //         {
    //             $item_images = $this->imageRepo->itemImages($item->id);
    //             if($item_images)
    //             {
    //                 $image = $this->imageRepo->showImage($item->id);
    //                 $image_id = $image['id'];

    //             }
    //         }
    //         $order = $this->orderRepo->getOrder($user->id, $item->id);
    //         $quantity = $order->quantity;
    //         $main_image = $this->imageRepo->oneImage($image_id);
    //         $itemMainImage = $this->imageRepo->oneImage($image_id);
    //         $order = $this->orderRepo->getOrder($user->id, $item->id);
    //         $date = $order->created_at;
    //         $date = date_format($date, 'F d Y');
    //         $item['date'] = $date;
    //         $userOrders = [
    //         'main_image' => $itemMainImage,
    //         'item' => $item,
    //         'quantity' => $quantity ];
    //         $itemsArr[] = $userOrders;
    //     }
    //     $count = $orderedItems->count();
    //     $data = [
    //         'itemsArr' => $itemsArr,
    //         'count' => $count
    //     ];
    //     return view('users.order_list', $data);
    // }

    // /**
    //  * Get last item from shopping bag
    //  * 
    //  * @param $request
    //  * @return response
    //  */
    // public function getLastItem(Request $request)
    // {
    //     if(Auth::check())
    //     {
    //         $user = Auth::user();
    //         $user_id = Auth::user()->id;
    //         $items = $user->items;
    //         if($items->all()){
    //             $lastItem = $items->last();
    //             $image_id = $lastItem->main_image_id;
    //             if(!$image_id)
    //             {
    //                 $item_images = $lastItem->images;
    //                 if($item_images)
    //                 {
    //                     $image = $this->imageRepo->showImage($lastItem->id);
    //                     $image_id = $image['id'];
    //                     $main_image = $this->imageRepo->oneImage($image_id);
    //                 }
    //             }else
    //             {
    //                 $main_image = $this->imageRepo->oneImage($image_id);
                    
    //             }
                
    //         }else{
    //             $lastItem = "";
    //             $main_image = "";
    //         }
    //         $data['last_item'] = $lastItem;
    //         $data['main_image'] = $main_image;
    //     }else{
    //         $ip = $request->ip();
    //         $carts = $this->cartRepo->getAllCartsByIp($ip);
    //         $items = [];
    //         foreach($carts as $cart)
    //         {
    //             array_push($items, $this->itemRepo->getItem($cart->item_id));
    //         }
    //         if($items){
    //             $lastItem = array_last($items);
    //             $image_id = $lastItem->main_image_id;
    //             if(!$image_id)
    //             {
    //                 $item_images = $this->imageRepo->itemImages($lastItem->id);
    //                 if($item_images)
    //                 {
    //                     $image = $this->imageRepo->showImage($lastItem->id);
    //                     $image_id = $image['id'];
    //                     $main_image = $this->imageRepo->oneImage($image_id);
    //                 }
    //             }
    //         }else{
    //             $lastItem = "";
    //             $main_image = "";
    //         }
    //         $data['last_item'] = $lastItem;
    //         $data['main_image'] = $main_image;
    //     }
        
    //     $showView = view('users.last_item', $data)->render();
    //     return response()->json(["resource"=>$showView]);
    // }
}
