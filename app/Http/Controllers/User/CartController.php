<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Contracts\UserInterface; 
use App\Contracts\ItemInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\CollectionInterface;
use App\Contracts\CartInterface;
use App\Contracts\ImageInterface;
use App\Services\UserService;
use Auth;
use Session, Input , Config;
use Carbon\Carbon;
use Validator;

class CartController extends BaseController
{
    /**
     * the user service.
     *
     * @var string
     */
    public $userRepo;

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

    /**
     * Create a new instance of UsersController class.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepo,
                                ItemInterface $itemRepo,
                                CategoryInterface $categoryRepo,
                                CollectionInterface $collectionRepo,
                                CartInterface $cartRepo,
                                ImageInterface $imageRepo,
                                Request $request
                                )
    {

        $this->userRepo = $userRepo;
        $this->itemRepo = $itemRepo;
        $this->categoryRepo = $categoryRepo;
        $this->cartRepo = $cartRepo;
        $this->collectionRepo = $collectionRepo;
        $this->imageRepo = $imageRepo;
        $this->middleware('auth', ['except' =>[
                                               'getAddToShoppingCart',
                                               'getShoppingCart',
                                               'getLastItem',
                                               'getDeleteCart',
                                               'getUpdateCart',
                                               'postAddToShoppingCart'
                                            ]]);
        $ip = $request->ip();
        parent::__construct($categoryRepo, $collectionRepo, $imageRepo, $ip);
    }

    /**
     * get shopping cart.
     * GET user/shopping-card
     *
     * @return response
     */
    public function getShoppingCart(Request $request)
    {
        $curr = session()->get('currency');
        if($curr)
        {
            $cur = $this->itemRepo->getCurrencyByCode($curr)->symbol_left;
        }else{
            $cur = $this->itemRepo->getCurrencyByCode('USD')->symbol_left;
        }
        $ip = $request->ip();
        if(Auth::check())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $items = $user->items;
        }else{
            $carts = $this->cartRepo->getAllCartsByIp($ip);
            $items = [];
            foreach($carts as $cart)
            {
                array_push($items, $this->itemRepo->getItem($cart->item_id));
            }            
        }
        $count = count($items);
        foreach($items as $item)
        {
            $image_id = $item->main_image_id;
            if(!$image_id)
            {
                $item_image = $item->images->first();
                if($item_image)
                {
                    $image_id = $item_image->id;
                }
            }
            $item->main_image = $this->imageRepo->oneImage($image_id)->name;
            if(Auth::check())
            {
                $item->qty = $item->pivot->quantity;
                $item->cartSize = $item->pivot->size;
            }else{
                $cart = $this->cartRepo->getCartByIp($ip, $item->id);
                $item->qty = $cart->quantity;
                $item->cartSize = $cart->size;
            }
            $maxquantity = $item->qty + $item->quantity;
            $item->maxquantity = $maxquantity;
        }       
        $data = [
            'items' => $items,
            'count' => $count,
            'title' => 'Shopping Cart',
            'currency_symbol' => $cur,
            'meta_keywords' => 'ohscarlett jewelry blog,online jewelry shopping,fashion jewelry,jewelry sets,buy fashion jewelry online',
            'meta_description' => '', 
        ];   
        return view('users.shopping_cart', $data);
    }

    /**
     * add shopping cart
     * POST user/add-to-shopping-cart
     *
     * @param Request $request
     * @return response
     */
    public function postAddToShoppingCart( Request $request)
    {
        $id = $request['id'];
        $token = $request['_token'];
        $item = $this->itemRepo->getItem($id);
        $ip = $request->ip();
        if(Auth::check())
        {
            $user = Auth::user();
            $userId = $user->id;
            $cart = $this->cartRepo->getOne($user->id, $id);
        }else{
            $cart = $this->cartRepo->getCartByIp($ip,$id);
            $userId = "";
        }
        if (!$cart) 
        {
            $data = [
                'user_id' => $userId,
                'item_id' =>$id,
                'quantity' => $request->get('quantity'),
                'user_ip' => $ip,
                'size' => $request->get('size')
            ];
            $itemCount = $item->quantity-$request->get('quantity');
            if($itemCount >= 0){
                $cart = $this->cartRepo->createOne($data);
                $this->itemRepo->updateItem($id, ['quantity' =>  $itemCount]);
                
            }else{
                return  redirect()->back();
            }
        }else{
            $quantity = $cart->quantity;
            $quantity +=$request->get('quantity');
            $data = ['quantity' => $quantity];
            $itemCount = $item->quantity-$request->get('quantity');
            if($itemCount >= 0)
            {
                $cart = $this->cartRepo->update($cart, $data);
                $this->itemRepo->updateItem($id, ['quantity' =>  $itemCount]);
            }else{
                return  redirect()->back();
            }
        }
        if($itemCount == 0)
        {
            $this->itemRepo->updateItem($id, ['status' =>  'Out of the store']);
        }
        return response()->json($data);
    }

    /**
     * update cart.
     * POST user/update-cart
     *
     * @param Request $request
     * @return response
     */
    public function getUpdateCart(Request $request, $itemId) 
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $cart = $this->cartRepo->getOne($user_id, $itemId); 
        }else{
            $ip = $request->ip();
            $cart = $this->cartRepo->getCartByIp($ip,$itemId);
        }
        $item = $this->itemRepo->getItem($itemId);
        $quantity = $request['new_quantity'];
        $data['quantity'] = $quantity;
        $count = $quantity - $cart->quantity;
        $itemCount = $item->quantity - $count;
        if($itemCount >= 0){

            $this->cartRepo->update($cart, $data);
            $this->itemRepo->updateItem($itemId, ['quantity' =>  $itemCount]);
            if($itemCount == 0)
            {
                $this->itemRepo->updateItem($itemId, ['status' =>  'Out of the store']);
            }
        }else{
            return  redirect()->back();
        }

        return response()->json([$data]);
    } 

    /**
     * Delete cart
     * 
     * @param Request $request
     * @param int $itemId
     */
    public function getDeleteCart(Request $request,$itemId) 
    {
        if(Auth::check()){
            $userId = Auth::user()->id;
            $cart = $this->cartRepo->getOne($userId, $itemId);
        }else{
            $ip = $request->ip();
            $cart = $this->cartRepo->getCartByIp($ip, $itemId);
        }
        $item = $this->itemRepo->getItem($itemId);
        $quantity = $item->quantity;
        if($quantity == 0 && $item->status == 'Out of the store')
        {
            $data['status'] = 'Available';
        }
        $quantity += $cart->quantity;
        $data['quantity'] = $quantity;
        $this->itemRepo->updateItem($itemId, $data);
        $this->cartRepo->deleteOne($cart);
        return response()->json($cart);
    }

    /**
     * Get last item from shopping bag
     * 
     * @param $request
     * @return response
     */
    public function getLastItem(Request $request)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $items = $user->items;
            if(count($items)>0)
            {
                $lastItem = $items->last();
            }
        }else{
            $ip = $request->ip();
            $cart = $this->cartRepo->getAllCartsByIp($ip)->last();
            if($cart)
            {
                $lastItem = $cart->items;
            }
        }
        if(isset($lastItem))
        {
            $imageId = $lastItem->main_image_id;
            if($imageId)
            {
                $mainImage = $this->imageRepo->oneImage($imageId);
            }else{
                $itemImage = $lastItem->images()->first();
                if($itemImage)
                {
                    $mainImage = $this->imageRepo->oneImage($itemImage->id);
                }
            }
        }else{
            $lastItem = "";
            $mainImage = "";
        }
        $data = [
            'last_item' => $lastItem,
            'main_image' => $mainImage
                ];       
        $showView = view('users.last_item', $data)->render();
        return response()->json(["resource"=>$showView]);
    }
}
