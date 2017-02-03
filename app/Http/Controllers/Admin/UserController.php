<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contracts\UserInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\OrderInterface;
use App\Contracts\ShippingAddressInterface;
use File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;
use Validator;

class UserController extends BaseAdminController 
{
    /**
     * the admin service.
     *
     * @var string
     */
    public $userRepo;

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

    /**
     * the shipping address service.
     *
     * @var string
     */
    public $ddressRepo;


    public function __construct(
                                UserInterface $userRepo,
                                ReviewInterface $reviewRepo,
                                NewsLetterInterface $newsLetterRepo,
                                OrderInterface $orderRepo,
                                ShippingAddressInterface $addressRepo
                                )
                                
    {       
        $this->userRepo = $userRepo;
        $this->reviewRepo = $reviewRepo; 
        $this->newsLetterRepo = $newsLetterRepo;
        $this->orderRepo = $orderRepo;
        $this->addressRepo = $addressRepo; 
        $this->middleware("admin");
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * Show all users with their parameters
     *
     * @return users_list view
     */ 
    public function getShowUser()
    {
        $users = $this->userRepo->getAllUsers();
        $data = [
            'users' => $users,
            'userActive' => true,
            'usersList' => true
        ];
        return view('admin.users.users', $data);
    }

    /**
     * edit user
     * GET admin/user/edit-user
     * 
     * @return response
     */ 
    public function getEditUser($id)
    {
        $userData = $this->userRepo->getUser($id);
        $data = [
            'user' => $userData,
            'userActive' => true,
            'usersList' => true
        ];
        return view('admin.users.edit_user', $data);
    }

    /**
     * edit user
     * POST admin/user/edit-user
     * 
     * @param $request 
     * @return response
     */
    public function postEditUser(Request $request)
    {
        $dataUser = $request->all();
        $userID = $dataUser['id'];
        unset($dataUser['id']);
        unset($dataUser['_token']);
        $rules = [
            'first_name' => 'required|max:255|alpha',
            'last_name' => 'required|max:255|alpha',
            'email' => 'required|email|max:255',
            'country' => 'required',
            'city' => 'required|alpha',
            'address' => 'required',
            'postal_code' => 'required',
            'phone_number' => 'numeric',
        ];
        $validator = Validator::make($dataUser, $rules);
        if($validator->fails())
        {
            $errorArray = [];
            foreach ($validator->getMessageBag()->getMessages() as $key => $value) {
               $errorArray[$key] = $value;
            }
            return redirect()->back()->with('errorMessages', $errorArray);
        }else{
           $this->userRepo->updateById($userID, $dataUser);
           return redirect()->action('Admin\UserController@getShowUser');
        }            
    }

    /**
     * delete user
     * GET admin/user/delete-user
     * 
     * @param integer $id
     * @return response
     */
    public function getDeleteUser($id)
    {
        $user = $this->userRepo->getUser($id);
        $reviews = $user->reviews;
        $newsletter = $user->newsletter;
        $orders = $this->orderRepo->userOrders($id);
        foreach($reviews as $review)
        {
            $this->reviewRepo->deleteReview($review->id);
        }
        foreach($orders as $order)
        {
            $this->orderRepo->deleteOrder($order->id);
        }
        $this->newsLetterRepo->deleteSubscriptionByUserId($id);
        $this->userRepo->getDeleteUser($id);
        $this->addressRepo->deleteShippingAddress($id);
        return redirect()->back(); 
    }

    /**
     * Get user's orders
     */
    public function getUsersOrders($id){
        $orders = $this->orderRepo->userOrders($id);
        foreach($orders as $order)
        {
            $date = $order->created_at;
            $date = date_format($date, 'F d Y');
            $order->date = $date;
        }
        $data = [
            'orders' => $orders
            ];
        return view('admin.users.users_orders', $data);
    }

}
