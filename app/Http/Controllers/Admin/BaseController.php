<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct($reviewRepo, $newsLetterRepo, $orderRepo)
    {
    	$unseenReviews = $reviewRepo->getUnseenReviews();
        $unseenReviewsCount = $unseenReviews->count();
        $subscriptions = $newsLetterRepo->getUnsentSubscribers();
        $subscriptionsCount = $subscriptions->count();
        $newOrders = $orderRepo->getUnseenOrders();
        $newOrdersCount = $newOrders->count();
        $data = ['unseenReviewsCount' => $unseenReviewsCount, 'subscriptionsCount' => $subscriptionsCount, 'newOrdersCount' => $newOrdersCount];
        view()->share($data);
    }
}
