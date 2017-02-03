<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class BaseController extends Controller
{
    /**
     * Create a new instance of BaseController class.
     *
     * @param $notificationRepo
     * @param $messageRepo
     * @return void
     */
    public function __construct($categoryRepo, $collectionRepo, $imageRepo, $ip)
    {
        session_start();
        if(session()->get('currency'))
        {
            $currency = session()->get('currency');
        }else{ 
            $currency = 'USD';
        }
        $currencySymbol = $this->itemRepo->getCurrencyByCode($currency)->symbol_left;
        $category = $categoryRepo->getAll();
    	$collections = $collectionRepo->collections();
        foreach($collections as $collection)
        {
            $id = $collection->id;
            $collection->categories = $categoryRepo->getCollCategories($id);
        }
    	$data = [
    		'categories' => $category,
    		'collections' => $collections,
            'currencySymbol' => $currencySymbol,
            'currency' => $currency
    	];
    	if(Auth::check()){
            $user = Auth::user();
            if(isset($user->shipping))
            {
                $country = $user->shipping->country;
            }elseif($user->country){
                $country = $user->country;
            }else{
                $country = "";
            }
            if($country == 'USA')
            {
                $shippingAmount = '6.5';
            }elseif($country == ""){
                $shippingAmount = '0';
            }else{
                $shippingAmount ="45";
            }
            $items = $user->items;
            $subtotal = 0;
            $quantity = 0;
            foreach($items as $item)
            {
                $subtotal+=$item->new_price * $item->pivot->quantity;
                $quantity += $item->pivot->quantity;
            }
            $data['subtotal'] = $subtotal;
            $data['quantity'] = $quantity;
            $data['shippingAmount'] = $shippingAmount;
        } else {
            $carts = $this->cartRepo->getAllCartsByIp($ip);
            $items = [];
            foreach($carts as $cart)
            {
                array_push($items, $this->itemRepo->getItem($cart->item_id));
            }
            $subtotal = 0;
            $quantity = 0;
            foreach($items as $item)
            {
                $item_quantity = $this->cartRepo->getCartByIp($ip, $item->id)->quantity;
                $subtotal+=$item->new_price * $item_quantity;
                $quantity += $item_quantity;

            }
            $data['subtotal'] = $subtotal;
            $data['quantity'] = $quantity;
            $data['shippingAmount'] = "0";
        }
            $user = Auth::user();
            $data['user'] = $user; 
    	view()->share($data);
    }
}
