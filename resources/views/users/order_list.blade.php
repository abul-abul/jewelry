@extends('layouts.app')
@section('content')
{!! HTML::style( asset('new-css/order-list.css')) !!}
<!-- Begin Main -->
<div role="main" class="main order-container">

	<!-- Begin page top -->
	<section class="page-top">
		<div class="container">
			<div class="page-top-in">
				<h2><span>Your Orders</span></h2>
			</div>
		</div>
	</section>
	<!-- End page top -->
	<input type="hidden" value="{{Session::get('orderStatus')}}" class='orderStatus'>
	<div class="container col-lg-12 col-md-12 col-xs-12 col-sm-12">
		@if($count > 0 )
		<div class="row featured-boxes col-lg-10 col-md-10 col-xs-12 col-sm-12">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<h3 >Your selection (<t class = "items_count">{{$count}}</t> items)</h3>
				<div class="featured-box featured-box-cart">
					<div class="box-content table-responsive">
							<table cellspacing="0" class="shop_table table">
								<thead>
									<tr>
										<th class="product-thumbnail">
											Product
										</th>
										<th class="product-name">
											
										</th>
										<th class="product-price">
											Price
										</th>
										<th class="product-quantity">
											Quantity
										</th>
										<th class="product-subtotal">
											SubTotal
										</th>
										<th class="product-subtotal">
											Status
										</th>
										<th class="product-subtotal">
											Order Date
										</th>
									</tr>
								</thead>
								<tbody>
								@foreach($orders as $order)
								@if($order != 'ordered')
									<tr class="cart_table_item">
										<td class="product-thumbnail">
											<a href="">
											@if($order->item->main_image)
												<img class="order-main-image" alt="{{$order->item->alt}}" src="{{URL::asset('/uploads/'.$order->item->main_image)}}" >
											@else
												<a href="{{URL::to('item/item',[$order->item->category->category, $order->item->slug])}}"><img src="{{URL::asset('/default/default_img.jpg')}}" class="img-responsive" alt="{{$order->item->alt}}"></a>

											@endif
											</a>
										</td>
										<td class="product-name">
											<a href="{{URL::to('item/item',[$order->item->category->category, $order->item->slug])}}">{{$order->item->title}}</a>
										</td>
										<td class="product-price"> 
											@if($order->item->discount != 0) 
											<label style="text-decoration: line-through; ">${{$order->item->price}}</label><br />
											@endif
											<span class="{{$order->item->id}}price amount" data-price="{{$order->item->new_price}}">${{$order->item->new_price}}</span>
										</td>
										<td class="product-quantity">
											<span class="amount">{{$order->quantity}}</span>
										</td>
										<td class="product-subtotal">
											<span class="amount">${{$order->item->new_price * $order->quantity}}</span>

										</td>
										<td class="product-price">
											<span class="amount">{{$order->status}}</span>
										</td>
										<td class="product-price">
											<span class="amount">{{$order->date}}</span>
										</td>
									</tr>
									@endif
								@endforeach
								</tbody>
							</table>
						</div>
			</div>

		</div>
	</div>
	@else
	<div >
		<p class="no_orders">You have no orders!</p>
	</div>
	@endif
</div>

</div>
<div class="modal fade bs-modal-sm" id="orderStatus" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
		<div  class="lookbook" style="width: 400px">
			<p id="modalText"></p>
		</div>
    </div>
	<?php Session::forget('orderStatus') ?>
</div>
		<!-- End Main -->

@section('script')
{!! HTML::script( asset('/assets/js/order_status.js')) !!}
@endsection

@endsection 