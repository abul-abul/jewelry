<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Contracts\ItemInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\CollectionInterface;
use App\Contracts\CartInterface;
use App\Contracts\ImageInterface;
use App\Contracts\OrderInterface;
use App\Contracts\ShippingAddressInterface;
use Auth;
use Session, Input , Config;
use Carbon\Carbon;
use Validator;
 
class OrderController extends BaseController
{
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
     * the image service.
     *
     * @var string
     */
    public $imageRepo;

    /** the rating service.
     *
     * @var string
     */
    public $orderRepo;

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
    public function __construct(
                                ItemInterface $itemRepo,
                                CategoryInterface $categoryRepo,
                                CollectionInterface $collectionRepo,
                                CartInterface $cartRepo,
                                ImageInterface $imageRepo,
                                OrderInterface $orderRepo,
                                ShippingAddressInterface $addressRepo,
                                Request $request
                                )
    {

        $this->itemRepo = $itemRepo;
        $this->cartRepo = $cartRepo;
        $this->imageRepo = $imageRepo;
        $this->orderRepo = $orderRepo;
        $this->addressRepo = $addressRepo;
        $this->middleware('auth');
        $ip = $request->ip();
        parent::__construct($categoryRepo, $collectionRepo, $imageRepo, $ip);
    }

    /**
     * Order item(select carts for order)
     * 
     * @return view users.proceed_to_checkout
     */
    public function getOrderItems()
    {
        $curr = session()->get('currency');
        if($curr)
        {
            $curSymb = $this->itemRepo->getCurrencyByCode($curr)->symbol_left;
        }else{
            $curSymb = $this->itemRepo->getCurrencyByCode('USD')->symbol_left;
        }
        $user = Auth::user();
        $user_id = $user->id;
        $items = $user->items;
        $orderSubtotal = 0;
        $orderCount = 0;
        $availableCount = count($items);
        foreach($items as $item)
        {
            $image_id = $item->main_image_id;
            if(!$image_id)
            {
                $item_images = $item->images;
                if($item_images)
                {
                    $image = $this->imageRepo->showImage($item->id);
                    $image_id = $image['id'];
                }
            }
            $main_image = $this->imageRepo->oneImage($image_id);
            $item->main_image = $main_image->name;
            $orderSubtotal+= $item->new_price * $item->pivot->quantity;
            $orderCount += $item->pivot->quantity;
        }
        // $shipping = $this->addressRepo->getAddress($user->id);
        if(isset($user->shipping))
        {
            $shipping = $user->shipping;
        }else{
            $shipping = $user;
        }
        $data = [
            'items' => $items,
            'user' =>$user,
            'shipping' => $shipping,
            'currency_symbol' => $curSymb,
            'title' => 'Orders Checkout',
            'availableCount' => $availableCount,
            'orderSubtotal' => $orderSubtotal,
            'orderCount' => $orderCount,
            'meta_keywords' => 'Orders Checkout',
            'meta_description' => '', 
        ];
        return view('users.proceed_to_checkout', $data);
    }

    /**
     * Confirm order
     * 
     * @param
     * @return users.order
     */
    public function getOrderPage()
    {
        $data = [
            'title' => 'Confirm Order'
                ] ;     
        return view('users.order', $data);

    }

    /**
     * Order
     * 
     * @param
     * @return view users.shopping_cart
     */
    public function getOrder()
    {   
        // if(Auth::check()){
        //     $user = Auth::user();
        //     $carts = $this->cartRepo->getCartsForOrder($user->id);
        //     foreach($carts as $cart)
        //     {
        //         $item = $this->itemRepo->getItem($cart->item_id);
        //         $data = ['status' => 'ordered'];
        //         $this->cartRepo->update($cart, $data);
        //         $orderData = ['item_id' => $cart->item_id,
        //                       'user_id' => $cart->user_id,
        //                       'quantity' => $cart->quantity
        //         ];
        //         $order = $this->orderRepo->getOrder($user->id, $item->id);
        //         dd($order);
        //         if(!$order){
        //             $this->orderRepo->createOrder($orderData);
        //         }else{
        //             $quantity = $cart->quantity + $order->quantity;
        //             $this->orderRepo->updateOrder($order, ['quantity' => $quantity]);
        //         }
                
        //         $this->cartRepo->deleteOne($cart);
        //     }
        //     return redirect()->action('User\CartController@getShoppingCart');
        // }else{
        //     return redirect()->action('UserController@getLogin');
        // }
    }
    /**
     * Remove from order list
     * 
     * @param int $item_id
     * @param bool $order_status
     * @return response
     */
    public function getEditOrderStatus($item_id,$order_status)
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $cart = $this->cartRepo->getOne($user_id, $item_id);
        $this->cartRepo->updateOrderStatus($cart, $order_status);
        $count = $this->cartRepo->getCartsForOrder($user_id);
        $data['count'] = $count;
        $items = $user->items;
        $subtotal=0;
        foreach($items as $item)
        {
            if(!$item->collection)
                {
                    $item->coll = 'NoCollection';
                }else{
                    $item->coll = $item->collection->name;
                }
            $cart = $this->cartRepo->getOne($user_id, $item_id);
            $quantity = $cart->quantity;
            $subtotal+=$item->new_price * $quantity; 
        }
        $data['subtotal'] = $subtotal;
        return response()->json($data); 
    }

    /**
     * Get user's ordered items
     * 
     * @return view users.order_list
     */
    public function getOrderedItems() 
    {
        $user = Auth::user();
        $orders = $this->orderRepo->userOrders($user->id);
        foreach($orders as $order)
        {
            $item = $order->item;
            $image_id = $item->main_image_id;
            if(!$image_id)
            {
                $item_images = $this->imageRepo->itemImages($item->id);
                if($item_images)
                {
                    $image = $this->imageRepo->showImage($item->id);
                    $image_id = $image['id'];
 
                }
            }
            $item->main_image = $this->imageRepo->oneImage($image_id)->name;
            $date = $order->created_at;
            $date = date_format($date, 'F d Y');
            $order->date = $date;
        }
        $data = [
            'orders' => $orders,
            'count' => $orders->count(),
            'title' => 'Your Orders',
            'meta_keywords' => 'Your Orders',
            'meta_description' => '',       
        ];
        return view('users.order_list', $data);
    }

    /**
     * Edit shippng address
     */
    public function postEditAddress(Request $request) 
    {
        $user = Auth::user();
        $country = $request['country'];
        $city = $request['city'];
        $address = $request['address'];
        $postal_code = $request['postal_code'];
        $data = [
            'country' => $country,
            'city' => $city,
            'address' => $address,
            'postal_code' => $postal_code
                ];
        $shippingAddress = $this->addressRepo->getAddress($user->id);
        $rules = [
            'country' => 'required',
            'city' => 'required|not_in:numeric|regex:/^[\pL\s\-]+$/u',
            'address' => 'required',
            'postal_code' => 'required' 
                ];
        Validator::make($data, $rules);
        $data['state'] = $request['state'];
        if($shippingAddress)
        {
           $this->addressRepo->updateAddressByUserId($user->id, $data); 
        }else{
            $data['user_id'] = $user->id;
            $this->addressRepo->createAddress($data);
        }
        
        return redirect()->back()->with('message', '1');
    }

}
