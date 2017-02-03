<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contracts\OrderInterface;
use App\Contracts\ReviewInterface;
use App\Contracts\NewsLetterInterface;
use App\Contracts\UserInterface;
use App\Contracts\ItemInterface;
use App\Contracts\ImageInterface;
use App\Http\Controllers\Admin\BaseController as BaseAdminController;
use Auth;

class OrderController extends BaseAdminController
{
    /** the rating service.
     *
     * @var string
     */
    public $orderRepo;

    /** the rating service.
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
     * the newsLetter service.
     *
     * @var string
     */
    public $itemRepo;

    /**
     * the newsLetter service.
     *
     * @var string
     */
    public $imageRepo;

    public function __construct(
                                OrderInterface $orderRepo,
                                UserInterface $userRepo,
                                ReviewInterface $reviewRepo,
                                NewsLetterInterface $newsLetterRepo,
                                ItemInterface $itemRepo,
                                ImageInterface $imageRepo
                                                                )
                                
    {       
        $this->orderRepo = $orderRepo;
        $this->userRepo = $userRepo;
        $this->newsLetterRepo = $newsLetterRepo;
        $this->reviewRepo = $reviewRepo;
        $this->itemRepo = $itemRepo;
        $this->imageRepo = $imageRepo;
        $this->middleware("admin");
        parent::__construct($reviewRepo, $newsLetterRepo, $orderRepo);
    }

    /**
     * Get orders' list
     */
    public function getOrders()
    {
        $groupedOrders = [];
        $orders = $this->orderRepo->getGroupedOrders();
        $total = 0;
        foreach($orders as $order)
        {
            $order->user = $order->first()->user;
            $item = $order->first()->item;
            $total = 0;
            foreach($order as $ord)
            {
                $amount = $ord->quantity*$ord->item->new_price;
                $total += $amount;
            } 
            $order->total = $total;
            $date = $order->first()->created_at;
            $date = date_format($date, 'F d Y');
            $order->date = $date;
            $groupedOrders[] = $order;
        }
    	$data = [
    		'orders' => $groupedOrders,
            'total' => $total,
            'orderActive' => true,
            'order' => true,
            'title' => 'as'
    			];
    	return view('admin.order.orders', $data);
    }

    /**
     * Edit order status
     * 
     * @param Request $request
     */
    public function postEditOrderStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $this->orderRepo->editOrder($id, ['status' => $status]);
        $user = Auth::user();
        $orders = $user->orders;
        return $orders;
    }

    /**
     * View selected order
     * 
     * @param int $userId
     * @param int $itemId
     */
    public function getViewOrder($userId, $code)
    {
        $orders = $this->orderRepo->getUsersOrder($code, $userId);
        if($orders->first()->country == 'USA')
        {
            $shipping = '6.5';
        }else{
            $shipping = '45';
        }
        $total = 0;
        foreach($orders as $order)
        {
            $amount = $order->item->new_price*$order->quantity;
            $total += $amount;
            $this->orderRepo->editOrder($order->id, ['seen' => 1]);
            $date = $order->created_at;
            $date = date_format($date, 'F d Y');
            $order->date = $date;
        }
        $statuses = ['Pending', 'Approved', 'In route', 'Delivered'];

        $data = [
            'orders' => $orders,
            'total' => $total,
            'shipping' => $shipping,
            'statuses' => $statuses,
            'orderActive' => true,
            'orderView' => true,
                ];
        return view('admin.order.order_view', $data); 
    }
}
