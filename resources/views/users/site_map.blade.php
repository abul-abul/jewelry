@extends('layouts.app')
@section('css')
<style type="text/css">
	.sitemap{
		font-family: inherit;
	}
	.catName{
		text-transform: uppercase;
	}
	a:hover{
		color:#f64243 !important;
	}
</style>
@endsection
@section('content')
		<!-- Begin Main -->
		<div role="main" class="main">
			<!-- Begin page top -->
			<section class="page-top" >
				<div class="container" >
					<div class="page-top-in" >
						<h2><span> Site Map </span></h2> 
					</div>
				</div>
			</section>	
			<!-- End page top -->
			<article class="sitemap">
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<h3>COLLECTION</h3>
							<ul class="list-unstyled list-cat">
							<li>
								<a href="{{URL::to('collection/collections')}}">COLLECTIONS</a>
							</li>
							<ul>
                           @foreach($collections as $collection)
                           <li >
                               <a  href="{{URL::to('item/items',['collection', $collection->name, 'noSort'])}}">{{$collection->name}}</a>
                               <ul>
                                   @foreach($collection->categories as $category)
                                       <li>
                                          <a href="{{URL::to('item/collection-categories',[$collection->name, $category->category, 'noSort'])}}">{{$category->category}}</a> 
                                       </li>
                                   @endforeach
                               </ul>
                           </li>
                           @endforeach
                           </ul>
							</ul>
						</div>
						<div class="col-sm-3">
							<h3>CATEGORY</h3>
							<ul class="list-unstyled list-cat">
								<li><a href="{{URL::to('item/new-arrivals','noSort')}}">NEW ARRIVALS</a></li>
								<li><a href="{{URL::to('item/featured-products','noSort')}}">FEATURED ITEMS</a></li>
								@foreach($categories as $category)
								<li>
								<a class="catName" href="{{URL::to('item/items',['category', $category->category, 'noSort'])}}" target="_blank">{{$category->category}}</a>
								<ul>
									<li>
										<a href="{{URL::to('item/items-list',['category', $category->category, 'with-gemstones', 'noSort'])}}">With Stones</a>
									</li>
									<li>
										<a href="{{URL::to('item/items-list',['category', 'Necklaces', 'without-gemstones', 'noSort'])}}">Without Stones</a>
									</li>
								</ul>
								</li>
								@endforeach
							</ul>
						</div>
						<div class="col-sm-3">
							<h3>MENU</h3>
                    <ul class="list-unstyled list-cat">
	                    <li>
	                    	<a href="{{action('User\BlogController@getBlog')}}">BLOG</a>
	                    </li>
                        <li>
                            <a href="{{action('UserController@getAboutShop')}}">ABOUT US</a>
                        </li>
                        <li>
                            <a href="{{action('UserController@getContact')}}">CONTACT US</a>
                        </li>
                        <li>
                            <a href="{{action('UserController@getCustomerService')}}" >CUSTOMER SERVICE</a>
                        </li>
                        <li class="footer-login">
                            <a href="javascript:void(0);" >LOGIN</a>
                        </li>
                        <li>
                            <a href="{{action('UserController@getRegistration')}}">REGISTER</a>
                        </li>
                        <li>
                            <a href="{{action('UserController@getFaq')}}">FAQ</a>
                        </li>

                        <li>
                            <a href="{{action('UserController@getCleanPieaces')}}">HOW TO CLEAN THE PIECES?</a>
                        </li>
                        <li>
                            <a href="#">SALES REPRESENTATIVE</a> 
                        </li>
                    </ul>
						</div>
						<div class="col-sm-3">
							<h3>ACCOUNT</h3>
							<ul class="list-unstyled list-cat">
	  			                <li><a href="{{action('UserController@getAccountDashboard')}}">MY ACCOUNT</a></li>
	                            <li><a href="{{action('UserController@getMyAccount')}}">ACCOUNT INFORMATION</a></li>
	                            <li><a href="{{action('UserController@getAddressBook')}}">ADDRESS BOOK</a></li>
	                            <li><a href="{{URL::to('favorites/favorites')}}">MY FAVORITES</a></li>
	                            <li><a href="{{URL::to('cart/shopping-cart')}}">MY SHOPPING CART</a></li>
	                            <li><a href="{{URL::to('order/ordered-items')}}">MY ORDERS</a></li>
							</ul>
						</div>
					</div>
				</div>
			</article>
		</div>
		<!-- End Main -->
@endsection