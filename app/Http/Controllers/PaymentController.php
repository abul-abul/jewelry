<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PayPal\Api\Plan;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

use PayPal\Api\Sale;
use PayPal\Api\Refund;

use Auth;

use App\Contracts\CartInterface;
use App\Contracts\ItemInterface;
use App\Contracts\OrderInterface;
use App\Contracts\ShippingAddressInterface;
use App\Contracts\MailInterface;

use App\Http\Requests;

class PaymentController extends Controller
{
    /**
     * the intem service.
     *
     * @var string
     */
    public $itemRepo;

    /**
     * the cart service.
     *
     * @var string
     */
    public $cartRepo;

    /** the prder service.
     *
     * @var string
     */
    public $orderRepo;

    /** the address service.
     *
     * @var string
     */
    public $addressRepo;

    /** the address service.
     *
     * @var string
     */
    public $mailRepo;  

    /**
     * Create a new instance of UsersController class.
     *
     * @return void
     */
    public function __construct(
    							ItemInterface $itemRepo,
    							CartInterface $cartRepo,
                                OrderInterface $orderRepo,
                                ShippingAddressInterface $addressRepo,
                                MailInterface $mailRepo
                                )
    {
    	$this->itemRepo = $itemRepo;
        $this->cartRepo = $cartRepo;
        $this->orderRepo = $orderRepo;
        $this->addressRepo = $addressRepo;
        $this->mailRepo = $mailRepo;
    }

    /**
     * create paypal request for subscription
     *
     * @param TblPaymentPlanInterface $paymentPlanRepo
     * @param Int $plan_id
     * @return redirect
     */
    public function getPayPal()
    {
        if(Auth::check()){
            $user = Auth::user();
            $shippingAddress = $this->addressRepo->getAddress($user->id);
            if(!$shippingAddress)
            {
                return redirect()->back()->with('error', 'Please, enter your shipping address to be able to make purchase.');
            }
            $carts = $this->cartRepo->getCartsForOrder($user->id);
            $maxPrice = 0;
            foreach($carts as $cart)
            {
                $maxPrice += $cart->items->new_price*$cart->quantity;
            }
            if($user->role == "user")
            {
                if($user->shipping->country == 'USA')
                {
                    $shippingAmount = '6.5';
                }else{
                    $shippingAmount = '45';
                }
            }else{
                $shippingAmount = '0';
            }
            if($maxPrice <= 0){

            	return redirect()->back()->with('error', 'You have to choose items to be able to make purchase.');

            }
            $maxPrice += $shippingAmount;
	        $sdkConfig = array(
	            "mode" => "sandbox"
	        );
	        $apiContext = new ApiContext(new OAuthTokenCredential(config("app.paypal_client_id"), config("app.paypal_client_secret")));
	        $apiContext->setConfig($sdkConfig);
	        
	        $payer = new Payer();
	        $payer->setPaymentMethod('paypal');

	        $transactionArr = [];

	        $amount = new Amount();
	        $amount->setCurrency('USD');
	        $amount->setTotal($maxPrice); 
	        $transaction = new Transaction();
	        $transaction->setAmount($amount);
	       
	        $redirectUrls = new RedirectUrls();
	        $redirectUrls->setReturnUrl(action('PaymentController@getPaypalReturnResponse' ));
	        $redirectUrls->setCancelUrl(action('PaymentController@getPaypalCancelResponse'));
	        
	        $payment = new Payment();
	        $payment->setIntent('sale');
	        $payment->setPayer($payer);
	        $payment->setRedirectUrls($redirectUrls);
	        $payment->setTransactions(array($transaction));
	        $response = $payment->create($apiContext);
	        $redirectUrl = $payment->getApprovalLink();


	        return redirect()->to($redirectUrl);
	    }else{
            return redirect()->action('UserController@getIndex');
        }
    }

    /**
     * paypal send to this function response
     *
     * @param Request $request
     * @param TblPaymentPlanInterface $paymentPlanRepo
     * @return response
     */
    public function getPaypalReturnResponse(Request $request)
    {
    	if(Auth::check()){
	        $token = $request->get('token');
	        $paymentId = $request->get('paymentId');
	        $payerId = $request->get('PayerID');

	        $sdkConfig = array(
	            "mode" => "sandbox"
	        );
	        $apiContext = new ApiContext(new OAuthTokenCredential(config("app.paypal_client_id"), config("app.paypal_client_secret")));
	        $apiContext->setConfig($sdkConfig);

	        $payment = new Payment();
	        $payment->setId($paymentId);
	        
	        $paymentExec = new PaymentExecution;
	        $paymentExec->setPayerId($payerId);
	        $x = $payment->execute($paymentExec, $apiContext);
	       	if($x->getState() == 'approved'){
		        $user = Auth::user();
		        $carts = $this->cartRepo->getCartsForOrder($user->id);
                $code = $carts->last()->id;
				foreach($carts as $cart)
		        {
		            $item = $this->itemRepo->getItem($cart->item_id);
		            // $data = ['status' => 'ordered'];
		            // $this->cartRepo->update($cart, $data);
                    $orderData = [
                        'item_id' => $cart->item_id,
                        'user_id' => $cart->user_id,
                        'quantity' => $cart->quantity,
                        'country' => $user->shipping->country,
                        'city' => $user->shipping->city,
                        'state' => $user->shipping->state,
                        'address' => $user->shipping->address,
                        'postal_code' => $user->shipping->postal_code,
                        'size' => $cart->size,
                        'code' => $cart->user_id.'_'.$code
                    ];
                    $this->orderRepo->createOrder($orderData);
                    $this->cartRepo->deleteOne($cart);
                    
		        }
                session()->put('orderStatus', 'success');
                //mail notification
                
                $template = 'admin_notification';
                $data = [
                        'firstName' => $user->first_name,
                        'lastName' => $user->last_name
                        ];
                $this->mailRepo->sendOrderNotification($data, $template);

		        return redirect()->action('User\OrderController@getOrderedItems')->with('succes','jggh');
		    }else{
                session()->put('orderStatus', 'error');
		    	return redirect()->action('User\CartController@getShoppingCart')->with('error','Your balance is insufficient.');
		    }
	    }else{
            return redirect()->action('UserController@getIndex');
        }
    }

    /**
     * paypal send to this function cancel response
     *
     * @param Request $request
     * @return response
     */
    public function getPaypalCancelResponse(Request $request)
    {
        return redirect()->action('User\OrderController@getOrderPage');
    }
}
