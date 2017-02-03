@extends('layouts.app')

@section('css')
{!! HTML::style( asset('new-css/customer_service.css')) !!}
@endsection

@section('content')
<div class="container">
			<div class="page-top">
				
			</div>
			<span class="top">Customer Service</span>
			<ul class="menu">
				<li>Shipping & Delivery</li>
				<li>Privacy & Security</li>
				<li>Returns & Replacements</li>
				<li>Ordering</li>
				<li>Payment, Pricing & Promotions</li>
				<li>Viewing Orders</li>
				<li>Updating Account Information</li>
			</ul>
			<br />
			<b>Shipping & Delivery</b>
			<p class="content">Please allow three to four weeks for the delivery of your order. Oh Scarlett jewelry is handmade to order. We use USPS for all our shipping in the US and we use either Fed Ex or UPS for our International Customers, Order processing and delivery can be accessed through our website.</p>

			<b>Privacy & Security</b>
			<p class="content">Our website is private and secure for your protection. Secure websites use encryption technology to transfer information via your computer to the online merchant's computer. Encryption "scrambles" the sensitive information that is sent, like your credit card information, in order to prevent "hackers" from obtaining this information en route. The only people who can unscramble the code are those with legitimate access privileges. Here at Oh Scarlett we take your privacy and security as our number one priority. That is why we use PayPal for all of your transactions. PayPal has proven to be safe, secure and easy to use.</p>

			<b>Returns & Replacements</b>
			<p class="content">When you receive your order from Oh Scarlett, and it's not what you expected or that it was damaged, simply email to <a class="links_in_text" href="{{action('UserController@getCustomerService')}}">Our Customer Service</a>, Return your items within 30 days for replacement or for credit to your account. Replacement items will be sent to you as soon as possible.</p>

			<b>Ordering</b>
			<p class="content">Please consult your local sales associates for ordering Oh Scarlett jewelry. If you are a retailer and wish to order from our website, you must first register and be approved. We will notify you via email if you qualify and when acceptance has been completed.</p>

			<b>Payment, Pricing & Promotions</b>
			<p class="content">The price shown on our website is wholesale Prices, not include the shipping costs, The Prices are subject to change. We only use PayPal for payment. PayPal accept Visa, Master Card, American Express and Discovery credit cards.</p>

			<b>Viewing Orders</b>
			<p class="content">It's easy to check the status of your order. Just visit <a class="links_in_text" href="{{action('UserController@getIndex')}}">www.ohscarlett.com</a> , log in with your Oh Scarlett user ID and password. Orders placed online can be viewed under "My Account". You will be able to see your order number, the date the order was placed, the status of your order, order total, shipping method and tracking information once your items have shipped..</p>

			<b>Updating Account Information</b>
			<p class="content">You can conveniently update your account information using our website <a class="links_in_text" href="{{action('UserController@getIndex')}}">www.ohscarlett.com</a>, Simply log in with your Oh Scarlett user ID and password. You will then be able to edit any of your information under "My Account".</p>

</div>
@endsection