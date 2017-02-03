<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Contracts\ItemInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\CollectionInterface;
use App\Contracts\ImageInterface;
use App\Contracts\FavoritesInterface;
use App\Contracts\CartInterface;
use App\Contracts\ReviewInterface;
use Auth;
use Session, Input , Config;
use Carbon\Carbon; 
use Validator;

class FavoritesController extends BaseController 
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
     * the favorites service.
     *
     * @var string
     */
    public $favoritesRepo;

    /**
     * the cart service.
     *
     * @var string
     */
    public $cartRepo;

    /**
     * the review service.
     *
     * @var string
     */
    public $reviewRepo; 

    /**
     * Create a new instance of UsersController class.
     *
     * @return void
     */
    public function __construct(
                                ItemInterface $itemRepo,
                                ImageInterface $imageRepo,
                                CategoryInterface $categoryRepo,
                                CollectionInterface $collectionRepo,
                                FavoritesInterface $favoritesRepo,
                                CartInterface $cartRepo, 
                                ReviewInterface $reviewRepo, 
                                Request $request
                                )
    {

        $this->itemRepo = $itemRepo;
        $this->categoryRepo = $categoryRepo;
        $this->collectionRepo = $collectionRepo;
        $this->imageRepo = $imageRepo;
        $this->favoritesRepo = $favoritesRepo;
        $this->cartRepo = $cartRepo;
        $this->reviewRepo = $reviewRepo;
        $this->middleware('auth');
        $ip = $request->ip();
        parent::__construct($categoryRepo, $collectionRepo, $imageRepo, $ip);
    }

    /**
     * Add to favorites
     * 
     * @param Request $request
     * @return responce
     */ 
    public function getAddToFavorites(Request $request)
    {
        $user_id = Auth::user()->id;
        $item_id = $request->item_id;
        $favorites = $this->favoritesRepo->getFavorites($user_id, $item_id);
        $data = ['user_id' => $user_id, 'item_id' =>$item_id];
        if($favorites)
        {
            $this->favoritesRepo->deleteFromFavorites($user_id, $item_id);
        }
        else
        {
            $this->favoritesRepo->addToFavorites($data);
        }

        return response()->json(["status" => 1]);
    }

    /** 
     * Remove from favorites
     *
     * @param Request $request
     * @return responce
     */
    public function getDeleteFromFavorites(Request $request)
    {
        $user_id = Auth::user()->id;
        $item_id = $request->item_id;
        $this->favoritesRepo->deleteFromFavorites($user_id, $item_id);
        return response()->json(["status" => 1]);
    }


    /**
     * Get favorites page
     *
     * @return view users.favorites
     */

    public function getFavorites(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $favorites = $user->favorites;
        $main_images = [];
        $cart = [];
        $count = [];
        foreach($favorites as $key => $favorite)
        { 
            $favorite->discount =  (int)$favorite->discount; 
            $count[$key] = count($this->reviewRepo->getReviewByItemId($favorite->id));
            if(Auth::check())
            {
                $cart[$key] = $this->cartRepo->getUserCart($user->id, $favorite->id);
            }else{
                $cart[$key] =  $this->cartRepo->getCart($favorite->id, $request->ip());
            }
            $main_images[$key] = $this->imageRepo->showImage($favorite->main_image_id);
            if($favorite->main_image_id)
            {
                $favorite->image =$this->imageRepo->oneImage($favorite->main_image_id)->name;
            }else{
                $favorite->image = $favorite->images->first()->name;
            }
        }
        $data = [
            'title' => 'Favorites Jewelry',
            'cart' => $cart,
            'count' =>$count,
            'favorites' => $favorites, 
            'main_images' => $main_images,
            'meta_keywords' => 'jewelry favorites,pricing jewelry',
            'meta_description' => ''
        ];
        return view('users.favorites', $data);
    }

}
