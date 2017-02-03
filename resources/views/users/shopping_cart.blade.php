@extends('layouts.app')
@section('content') 
{!! HTML::style( asset('new-css/shopping-cart.css')) !!}
<!-- Begin Main -->
<div role="main" class="main">

	<!-- Begin page top -->
	<section class="page-top">
		<div class="container">
			<div class="page-top-in">
				<h2><span>Shopping Bag</span></h2> 
			</div>
		</div>
	</section>
	<!-- End page top -->
 
	<div class="container">
	@if($count>0) 		
		<div class="row featured-boxes">
			<div class="col-md-8 table_shopping_cart">
				<div class="shoping_cart_selection">Your selection (<span class = "items_count" data-currency="{{$currency_symbol}}">{{$count}}</span> items)</div>
				<div class="featured-box featured-box-cart">
					<div class="box-content table-responsive">
						<table class="shop_table table" style="width:100%; height: auto; ">
							<thead>
									<tr>
										<th class="product-thumbnail">
											Product 
										</th>
										<th class="product-name">
											
										</th>
										<th> Size </th>
										<th class="product-price">
											Price
										</th>
										<th class="product-quantity">
											Quantity
										</th>
										<th>
											Save Quantity
										</th>
										<th class="product-subtotal">
											SubTotal
										</th>
										<th class="product-remove">
											&nbsp;
										</th>
									</tr>
							</thead>
							<tbody>
								@foreach($items as $item)
									<tr class="cart_table_item">
										<td class="product-thumbnail">
											@if($item->main_image)
												<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img class = "cart-main-image" alt="{{$item->alt}}" src="{{URL::asset('/uploads/'.$item->main_image)}}" ></a>
											@else
												<a href="{{URL::to('item/item',[$userItem['item']->category->category, $userItem['item']->slug])}}"><img src="{{URL::asset('/default/default_img.jpg')}}" class="img-responsive cart-no-image" alt="{{$item->alt}}"></a>
											@endif
										</td>
										<td class="product-name">
											<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}" >{{$item->title}} </a>
										</td>
										<td>
											{{$item->cartSize}}
										</td>
										<td class="product-price">
										@if($item->discount != 0) 
										<label style="text-decoration: line-through; ">{{rtrim(rtrim(Currency::format($item->price, $currency), 0), '.')}}</label>
										@endif
											<span class="{{$item->id}}price amount" data-price="{{$item->new_price}}">{{rtrim(rtrim(Currency::format($item->new_price, $currency), 0), '.')}}
											 
											</span>
										</td>
										<td class="product-quantity"> 
											{!! csrf_field() !!}
											<div class="quantity pull-left col-md-12 col-lg-12 col-xs-12 col-sm-12" data-id="{{$item->id}}">
												<input type="button" onclick="counter(-1)" class="col-md-3 col-lg-3 col-xs-3 col-sm-3 minus xxxx {{$item->id}}" data-id="xx{{$item->id}}" value="-" />

												<input type="text" class="col-md-6 col-lg-6 col-xs-6 col-sm-6 input-text qty xxxx" id="xx{{$item->id}}" title="Qty" data-quantity="{{$item->qty}}" value="{{$item->qty}}" name="quantity"    maxquantity="{{$item->maxquantity}}" />

												<input type="button" onclick="counter(1)" class="col-md-3 col-lg-3 col-xs-3 col-sm-3 plus xxxx {{$item->id}}" data-id="xx{{$item->id}}" value="+" />
											</div>										
										</td>
										<td class="saveQuantity{{$item->id}}">
											<button type="button" data-item = "{{$item->id}}" data-cart = "{{$item->qty}}" class="update_quantity" value="{{$item->qty}}" >Save</button>

										</td>
										<td class="product-subtotal">
										<span class="{{$item->id}}subtotal amount" data-price="{{$item->new_price * $item->qty}}">{{rtrim(rtrim(Currency::format($item->new_price * $item->qty,$currency), 0), '.')}}</span>
										</td>
										<td class="product-remove">
											<a title="Remove this item" class = "remove_cart"  data-toggle="modal" data-target=".quick" data-item="{{$item->id}}" data-quantity = "{{$item->qty}}">
												<i class="fa fa-times-circle"></i>											
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="featured-box featured-box-secondary sidebar featured-box-bag-summary">
					<div class="box-content">
						<h4>Shopping bag summary</h4>
						<table  class="cart-totals">
							<tbody>
								<tr class="cart-subtotal">
									<th>
										Cart Subtotal
									</th>
									<td class="product-price">
										<span class="sub_amount" data-amount="{{$subtotal}}">{{rtrim(rtrim(Currency::format($subtotal, $currency), 0), '.')}}</span>
									</td>
								</tr>
								<tr class="shipping">
									<th>
										Shipping
									</th>
									<td class="shipping ship" >
										{{rtrim(rtrim(Currency::format($shippingAmount, $currency), 0), '.')}}
										<input type="hidden" value="{{$shippingAmount}}" id="shipping_method" name="shipping_method">
									</td>
								</tr>
								<tr class="total">
									<th>
										Total
									</th>
									<td class="product-price">
										<span class="total_amount">{{rtrim(rtrim(Currency::format($subtotal+$shippingAmount, $currency), 0), '.')}}</span>
									</td>
								</tr>
							</tbody>
						</table>
						@if(Auth::check())							
						<p><a href="{{URL::to('order/order-items')}}"><button class="btn btn-primary btn-block btn-sm">Proceed To checkout</button></a></p>
						@else
			                <nav class="navbar-main">
		                        <p class="login">
		                            <a><button class="btn btn-primary btn-block btn-sm">Proceed To checkout</button></a>
		                        </p>
			                </nav>
                    	@endif
						<p><a href="{{action('UserController@getIndex')}}"><button class="btn btn-primary btn-block btn-sm" >Continue Shopping</button></a></p>
					</div>
				</div>
			</div>
		</div>
		@else
		<div >
			<p class="empty_bag">Your shopping bag is empty.</p>
		</div>
		@endif
	</div>
</div>
<!-- End Main -->

@endsection 