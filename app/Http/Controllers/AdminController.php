<?php

namespace App\Http\Controllers;

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
use App\Contracts\NewsLetterInterface;
use App\Contracts\MailInterface;
use App\Contracts\OrderInterface;
use App\Http\Requests\Items\CreateItemRequest;
use App\Http\Requests\Items\EditItemRequest;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Collections\CreateSliderRequest;
use Validator;
use File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;


class AdminController extends BaseAdminController
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
     * the newsLetter service.
     *
     * @var string
     */
    public $newsLetterRepo;

    /**
     * the mail service.
     *
     * @var string
     */
    public $mailRepo;

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
                                NewsLetterInterface $newsLetterRepo,
                                MailInterface $mailRepo,
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
        $this->newsLetterRepo = $newsLetterRepo; 
        $this->orderRepoc = $orderRepo;
        $this->mailRepo = $mailRepo;       
        $this->middleware("admin", ['except' => [
                                        'getLogin', 
                                        'postLogin'
                                    ]]);

        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

	/**
     * admin login page.
     * GET admin/login
     *
     * @return response
	 */
    public function getLogin()
    {
        if(Auth::check() && Auth::user()->role == 'admin')
        {
            return redirect()->action("AdminController@getDashboard");
        }else{
            return view('admin.admin_login');
        }    
    }
     
	/**
	 * Check admin status.
     * POST admin/login
	 *
	 * @param Request $request
	 * @return responses
	 */
    public function postLogin(Request $request)
    {
        $email = $request->get('email');
        $pass = $request->get('password');
    	if (Auth::attempt(['email' => $email, 'password' => $pass, 'role' => 'admin'])) {
    		return redirect()->action("AdminController@getDashboard");
    	} else {
    		return redirect()->back();
    	}
    }
        
    /**
     * Show admin page
     *
     * @return admin view
     */
    public function getDashboard()
    {
        $users = $this->userRepo->getAllUsers()->count();
        $items = $this->itemRepo->showItemList()->count();
        $collections = $this->collectionRepo->collections()->count();
        $categories = $this->categoryRepo->getAll()->count();
        $data = [
            'userCount' => $users,
            'itemCount' => $items,
            'collectionCount' => $collections,
            'categoryCount' => $categories,
            'dashboardActive' => true,
        ];   
     
    	return view('admin.home', $data);
    }

    /**
     * Get logout
     * GET admin/logout
     * 
     * @return admin login page
     */
    public function getLogout()
    {
      Auth::logout();
      return redirect()->action("AdminController@getLogin");
    }

    /**
     * get items reviews
     *
     * @return redirect
     */
    public function getReviews($page)
    {
        $reviewsGroup = $this->reviewRepo->getReviews();
        $itemsArr = [];
        foreach($reviewsGroup as $reviews)
        {
            $review = $reviews[0];
            $item = $this->itemRepo->getItem($review['item_id']);
            if($item && $item->main_image_id)
            {
                $item->image = $this->imageRepo->oneImage($item->main_image_id)->name;
            }else{
                $image = $item->images->first();
                if($image)
                {
                    $item->image = $image->name;
                }else{
                    $item->image = '';
                }
            }
            $item->unseenReviews = $this->reviewRepo->unseenReviews($item->id);
            $itemsArr[] = $item;
           
        }
        if(count($itemsArr)/20 > 1 && count($itemsArr)%20 > 0 && count($itemsArr)%20 < 0.5) 
        {
            $maxPage = count($itemsArr)/20+1;
        }else{
            $maxPage = count($itemsArr)/20 ;
        }
        $slicedReviews = [];
        for($i = 0; $i < count($itemsArr); $i+=20)
        {
            $slicedReviews[] = array_slice($itemsArr, $i, 20);
        }
        $data = [
            'reviews' => $reviewsGroup,
            'maxPage' => $maxPage,
            'itemsArr' => $slicedReviews,
            'page' => $page,
            'reviewActive' => true,
            'reviewsList' => true,
        ];
        return view('admin.reviews.reviews', $data);
    }

    /**
     * Get item's reviews
     * 
     * @param int $itemId
     */
    public function getItemReviews($itemId)
    {
        $item = $this->itemRepo->getItem($itemId);
        if($item->main_image_id)
        {
            $item->image = $this->imageRepo->oneImage($item->main_image_id)->name;
        }else{
            $image = $item->images->first();
            if($image)
                {
                    $item->image = $image->name;
                }else{
                    $item->image = '';
                }
        }
        $data = [
            'item' => $item,
            'reviewActive' => true,
            'reviewsList' => true,
                ];
        return view('admin.reviews.item_reviews', $data);
    }

    /**
     * get edit review
     *
     * @param int $id
     * @param string $status
     * @return redirect
     */
    public function getEditReview($id, $status)
    {
        $this->reviewRepo->editReviewStatus($id, $status);
    }

    /**
     * Delete review
     *
     * @param int $id
     * @return redirect
     */
    public function getDeleteReview($id)
    {
        $this->reviewRepo->deleteReview($id);
        return redirect()->back();
    }

    /**
     * Get subscribers
     */
    public function getNewsLetter()
    {
        $subscriptions = $this->newsLetterRepo->getAllSubscribers();
        $users = [];
        $emails = [];
        $subscribers = [];
        foreach($subscriptions as $key => $subscription) 
        {
            if($subscriptions[$key]->user_id)
            {
                $users[$key] = $this->userRepo->getOneById($subscriptions[$key]->user_id);
                $emails[$key] = $subscriptions[$key]->user_email;
                $subscribers_user = ['first_name' => $users[$key]->first_name, 'last_name' => $users[$key]->last_name, 'email' => $subscriptions[$key]->user_email, 'id' =>$users[$key]->id, 'status' => $subscriptions[$key]->status];
                $subscribers[] = $subscribers_user;
            }else{
                $users[$key] = "Unregistered user";
                $emails[$key] = $subscriptions[$key]->user_email;
                $subscribers_user = ['first_name' => "Unknown", 'last_name' => "Unknown", 'email' => 
                $subscriptions[$key]->user_email, 'id' =>"", 'ip' => $subscriptions[$key]->user_ip, 'status' => $subscriptions[$key]->status];
                $subscribers[] = $subscribers_user;
            }
            
        }
        $data = [
            'newsLetter' => true,
            'subscribers' => $subscribers
            ];

            return view('admin.newsLetter.newsLetter', $data);
    }

    /**
     * Send mail to subscribers
     * 
     * @param Request $request
     */
    public function postWriteNewsLetter(Request $request)
    {
        $array = $request->subscriber_check; 
        $user_status = $request->registered;
        $subsctiptions = [];
        if($array)
        {
            foreach($array as $key => $val)
            {
                // if($user_status[$key] == "registered")
                // {
                //     $subscriptions[] = $this->newsLetterRepo->getSubscriptionByUserId($val);
                // }else
                // {
                //     $subscriptions[] = $this->newsLetterRepo->getSubscriptionByUserIp($val);
                // }
                $subscriptions[] = $this->newsLetterRepo->getSubscriptionByEmail($val);
            }
            $emails = [];
            if($request->content == "")
            {
                return redirect()->back()->with('error', "Newsletter field is required");
            }else{
                foreach($subscriptions as $key => $subscription)
                {
                    $email = $subscription->user_email;
                    $content = $request->content;
                    $subject = "News Letter";
                    $mailTemplate = "news_letter";
                    if($user_status[$key] == "registered")
                    {
                        $mailData = ['user_id' => $subscription->user_id, 'content' => $content];
                    }else{
                        $mailData = ['user_ip' => $subscription->user_ip, 'content' => $content];
                    }
                    
                    $this->mailRepo->send_email($email, $mailData, $mailTemplate, $subject);
                    $this->newsLetterRepo->updateSubscriber($subscription->id, ['status' => 'sent']);
                }
                return redirect()->back();
            }
        }else{
            return redirect()->back()->with('error', "You didn't choose any subscriber.");
        }
    }

}
