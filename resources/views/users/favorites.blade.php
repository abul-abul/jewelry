@extends('layouts.app')

@section('scripts')
{!! HTML::script( asset('assets/vendor/jquery.min.js')) !!} 
@endsection

@section('content') 
{!! HTML::style( asset('/new-css/favorites.css')) !!}
<!-- Begin Main -->
		<div role="main" class="main">
			<section class="page-top" >
		<div class="container" >
			<div class="page-top-in" >
				<h2><span> Favorites </span></h2> 
			</div>
		</div>
	</section>	
			<div class="container">
				<div class="row">
				<div class="col-md-9" style="float: none; margin: 0px auto;">						
						<div class="catalog">
							<div class="toolbar clearfix">
								
							</div>
							@if(count($favorites) > 0)
							@foreach($favorites as $key => $favorite)
												

							<div class="product favorites product-list animation remove{{$favorite->id}}">
								<div class="product-thumb-info" style="border: none;">
									<div class="row">
										<div class="col-xs-5 col-sm-3">
											<div class="product-thumb-info-image">
											@if($favorite->discount != '0')
												<span class="bag bag-hot">{{$favorite->discount}} %</span>
												@endif  
											@if($favorite->image)
							                    <a href="{{URL::to('item/item',[$favorite->category->category, $favorite->slug])}}"><img src="{{URL::asset('/uploads/'.$favorite->image)}}" class="img-responsive main_image page{{$favorite->id}}" alt="{{$favorite->alt}}"></a>
							                    @else
							                    <a href="{{URL::to('item/item',[$favorite->category->category, $favorite->slug])}}"><img src="{{URL::asset('/default/default_img.jpg')}}" class="img-responsive no_image page{{$favorite->id}}" alt="{{$favorite->alt}}"></a>

							                @endif
											</div>
										</div>	
										<div class="col-xs-7 col-sm-9">
											<div class="product-thumb-info-content">
												<h4><a href="{{URL::to('item/item',[$favorite->category->category, $favorite->slug])}}">{{$favorite->title}}</a></h4>
												<div class="reviews-counter clearfix">
													<span>{{$count[$key]}}  Reviews</span>
												</div>
													@if($favorite->discount != '0')
														<span class="price" >
														<label class="old_price">{{rtrim(rtrim(Currency::format($favorite->price, $currency), 0), '.')}}</label>
														<label class="new_price">{{rtrim(rtrim(Currency::format($favorite->new_price, $currency), 0), '.')}}</label>
													</span>
													@else
														<span class="new_price price" >
														{{rtrim(rtrim(Currency::format($favorite->price, $currency), 0), '.')}}
														</span>
													@endif
												<p class="btn-group">
												<input type="hidden" value="{{ csrf_token() }}" class="token">
												@if(isset($cart[$key]))
												<button class="btn btn-sm btn-icon btn-primary add-to-cart-product {{$favorite->id}} disabled-added" disabled  ><i class="fa fa-shopping-cart"></i>
												 Added
												</button>
												@else
												<button class="btn btn-sm btn-icon add-to-cart-product {{$favorite->id}}" data-id="{{$favorite->id }}" data-subtotal = "{{$subtotal}}" data-title = "{{$favorite->title}}" data-category = "{{$favorite->category->category}}" data-price = "{{$favorite->new_price}}" href="#" data-toggle="modal" data-status="{{$favorite->status}}"><i class="fa fa-shopping-cart" ></i>
												 Add to cart
												</button>
												@endif
													
													<button data-item = "{{$favorite->id}}" class="btn btn-grey heart remove-from-favorites">
														<i id = "{{$favorite->id}}heart" class="fa fa-heart " ></i>
													</button>
												</p>
											</div>
										</div>	
									</div>	
								</div>
							</div>
							@endforeach	
							@else
							<label class="no_favorites" >No Favorites</label>
							@endif						
					   </div>
					</div>
				</div>
<div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <label type="button" class="close" data-dismiss="modal" aria-hidden="true">x</label>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            	<label id="item_page" data-dismiss="modal"></label>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
