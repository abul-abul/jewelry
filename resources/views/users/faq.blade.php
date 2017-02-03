@extends('layouts.app')
 
@section('css')
{!! HTML::style( asset('new-css/faq.css')) !!}
@endsection

@section('content')
<h1 class="home_title">{{$title}}</h1>	
<div class="container">
			<section class="page-top">
				
			</section>

			<span class="top">Frequently Asked Questions</span>
			<ul class="question">
				<li>How long does it take to receive my order?</li>
				<li>Is all of Oh Scarlett jewelry 92.5 sterling silver?</li>
				<li>Is your Silver jewelry Nickel and Lead free?</li>
				<li>Are those real stones?</li>
				<li>Which company do you use for shipping?</li>
				<li>What form of payment do you accept?</li>
				<li>What is your minimum order?</li>
				<li>What are the sizes of your Bracelets and Necklaces?</li>
				<li>Where can I Buy Oh Scarlett Jewelry?</li>
			</ul>
			<br /> 
				<b class="quest">Q. How long does it take to receive my order?</b><br />
				<p class="answer">A. Oh Scarlett jewelry is all hand-made to order. It is our aim to provide you with your order in three to four weeks. We will keep you fully informed on the progress of your order via our website.</p>

				<b class="quest">Q. Is all of Oh Scarlett jewelry 92.5 sterling silver?</b><br />
				<p class="answer">A. Yes, all of our silver jewelry pieces are made with a minimum of 92.5% pure silver. Gold and rose gold plated items are 18k. The black pieces are plated with rhodium or ruthenium, which are part of the platinum family. Oh Scarlett does not use base metals plated in silver.</p>

				<b class="quest">Q. Is your Silver jewelry Nickel and Lead free?</b><br />
				<p class="answer">A. Yes, and our 92.5 sterling silver jewelry conforms to world legislation standards regarding nickel, lead and other heavy metal content and the silver is regularly tested to ensure compliance of these standards.</p>

				<b class="quest">Q. Are those real stones?</b><br />
				<p class="answer">A. Yes, we use only semi-precious stones and fresh water pearls.</p>

				<b class="quest">Q. Which company do you use for shipping?</b><br />
				<p class="answer">A. We are using USPS for all the shipping in the US and we use FedEx or UPS for all our international Customers, as they offer the best security, delivery and value for the money.</p>

				<b class="quest">Q. What form of payment do you accept?</b><br />
				<p class="answer">A. We are using USPS for all the shipping in the US and we use FedEx or UPS for all our international Customers, as they offer the best security, delivery and value for the money.</p>

				<b class="quest">Q. What is your minimum order?</b><br />
				<p class="answer">A. Oh Scarlett's total minimum order is $350 This will apply to each location an order is being shipped to. Each item under $50 will have a two piece minimum, and each item over $50 has a one piece minimum</p>

				<b class="quest">Q. What are the sizes of your Bracelets and Necklaces?</b><br />
				<p class="answer">A. Bracelets are 7.5 inches long, an industry standard. However, pieces can be customized for an additional cost. Necklace lengths vary on the style of each piece. Please consult our website for details.</p>

				<b class="quest">Q. Where can I Buy Oh Scarlett Jewelry?</b><br />
				<p class="answer">A. If you are a retailer and wish to purchase our pieces for resale, please select a sales associate in your area to contact you from our website. If you would like to personally purchase any of our items, please consult our website under the store locator for a retailer near you. Our jewelry is only sold through select retailers. If for some reason there are no retailers in your area, please contact our Customer Service</p>




</div>


@endsection