@extends('layouts.app') 

@section('css') 
{!! HTML::style( asset('/assets/css/jquery-ui.css')) !!}
{!! HTML::style( asset('/new-css/items_list.css')) !!}
@endsection

@section('script')
{!! HTML::script( asset('/assets/js/show_item_info.js')) !!}
{!! HTML::script( asset('/assets/js/login_modal.js')) !!}

@endsection

@section('content')
<!-- Begin Main --> 
<section class="page-top breadcrumb-container">
	<div class="container">
		<div class="page-top-in">
			<ol class="breadcrumb pull-left">
				<li>
					<a href="{{action('UserController@getIndex')}}">Home</a>
				</li>
				<li>
					Featured Products
				</li>
			</ol>
			<ol class="breadcrumb pull-right">
				<div class="btn-group">
	               <button id="btnGroupVerticalDrop1" type="button" class="btn green btn-xs dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i> 
	                   SORT BY
	               </button>
	               <ul  class="dropdown-menu sort" role="menu" >
	                   <li>
	                       <a href="/item/featured-products/name"> @if($sort == 'name')<i style="color:white" class="fa fa-check"></i>@endif NAME</a>
	                   </li>
	                   <li>
	                       <a  href="/item/featured-products/price" > @if($sort == 'price')<i style="color:white" class="fa fa-check"></i>@endif PRICE</a>
	                   </li>
	                   <li>
	                       <a   href="/item/featured-products/noSort" > @if($sort == 'noSort')<i style="color:white" class="fa fa-check"></i>@endif POSITION</a>
	                   </li>
	               </ul>
	           </div> 
		        <div class="btn-group">
	               <button id="btnGroupVerticalDrop1" type="button" class="btn green btn-xs dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i> 
	                   SHOW
	               </button>
	               <ul  class="dropdown-menu sort" role="menu" >
	                   <li>
	                       <a href="{{URL::to('item/session','12')}}" >12</a>
	                   </li>
	                   <li> 
	                       <a href="{{URL::to('item/session','24')}}">24</a>
	                   </li>
	                   <li>
	                       <a  href="{{URL::to('item/session','48')}}">48</a>
	                   </li>
	               </ul>
	           </div>
	           <label style="color:black;font-family: Roboto Slab, serif; margin-top: 4px; margin-left: 5px;">{{session()->get('number')}} items</label>
	        </ol>
		</div>
	</div>
</section>		
<div role="main" class="main" >
	<div class="container filter-block">
<!-- 		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<ul>
				<b>CATEGORIES</b>
				@foreach($categories as $category)
				<li>
					<b><a href="{{action('User\ItemController@getCategoryFeaturedItems', [$category->category, 'noSort'])}}">{{$category->category}}</a></b>
				</li>
				@endforeach
			</ul>
		</div>  -->
	<div class="col-md-2 col-sm-2 col-xs-3 col-lg-2">
		<aside class="sidebar">
			<aside class="block filter-blk">
					<h4>Filter</h4>
				</aside>						
				<aside class="block blk-cat">
					<h4>Category</h4>
					<ul class="list-unstyled list-cat">
					@foreach($categories as $category)
					{!! Form::open([ 'method' => 'GET' ,'action' => ['User\ItemController@getSearchFilter'], 'class' => 'form-horizontal','id' => 'form-login']) !!}
						<li>
							{{$category->category}} 
							
							<input type="hidden" name="category" value="{{$category->id}}">
							@if(isset($searchData['category']) && $searchData['category'] == $category->id)
							<button type="submit" class="btn btn-xs filter category selected pull-right" data-id="{{$category->id}}"></button>
							@else
							<button type="submit" class="btn btn-xs filter category unselected pull-right" data-id="{{$category->id}}"></button>
							@endif
						</li>
					{!! Form::close() !!}
					@endforeach
					</ul>
				</aside>
				<aside class="block blk-colors">
					<h4>Collection</h4>
					<ul class="list-unstyled list-cat">
					@foreach($collections as $collection)
					{!! Form::open([ 'method' => 'GET' ,'action' => ['User\ItemController@getSearchFilter'], 'class' => 'form-horizontal','id' => 'form-login']) !!}
						<li>
							<span class="collection_title">{{$collection->name}}</span>
							<input type="hidden" name="collection" value="{{$collection->id}}">
							@if(isset($searchData['collection']) && $searchData['collection'] == $collection->id)
							<button type="submit" class="btn btn-xs filter collection selected pull-right" data-id="{{$collection->id}}"></button>
							@else
							<button type="submit" class="btn btn-xs filter collection unselected pull-right" data-id="{{$collection->id}}"></button>
							@endif								
						</li>
					{!! Form::close() !!}
					@endforeach
					</ul>
				</aside>
				<aside class="block blk-colors">
					<h4>Metal</h4>
					<ul class="list-unstyled list-cat">
					@foreach($metals as $key => $metal)
					{!! Form::open([ 'method' => 'GET' ,'action' => ['User\ItemController@getSearchFilter'], 'class' => 'form-horizontal','id' => 'form-login']) !!}
						<li>
							{{$metal->name}}
							<input type="hidden" name="metals[]" value="{{$metal->id}}">
							@if(isset($searchData['metals']) && in_array($metal->id, $searchData['metals']))
							<button type="submit" class="btn btn-xs filter metal selected pull-right" data-id="{{$metal->id}}"></button>
							@else
							<button type="submit" class="btn btn-xs filter metal unselected pull-right" data-id="{{$metal->id}}"></button>
							@endif
						</li>
					{!! Form::close() !!}
					@endforeach
					</ul>
				</aside>
				<aside class="block blk-colors">
					<h4>Gemstone</h4>
					<ul class="list-unstyled list-cat">
					@foreach($gemstones as $key => $gemstone)
					{!! Form::open([ 'method' => 'GET' ,'action' => ['User\ItemController@getSearchFilter'], 'class' => 'form-horizontal','id' => 'form-login']) !!}
						<li>
							{{$gemstone->name}}
							<input type="hidden" name="gemstones[]" value="{{$gemstone->id}}">
							@if(isset($searchData['gemstones']) && in_array($gemstone->id, $searchData['gemstones']))
							<button type="submit" class="btn btn-xs filter gemstone selected pull-right" data-id="{{$gemstone->id}}"></button>
							@else
							<button type="submit" class="btn btn-xs filter gemstone unselected pull-right" data-id="{{$gemstone->id}}"></button>
							@endif
						</li>
					{!! Form::close() !!}
					@endforeach
					</ul>
				</aside>
				<aside class="block blk-cat"> 
					<h4>Price</h4>
					{!! Form::open([ 'method' => 'GET' ,'action' => ['User\ItemController@getSearchFilter'], 'class' => 'form-horizontal','id' => 'form-login']) !!}
					<input id="amount" type="number" min="0" name="price_min" style="width: 60px; border-color: #666666" placeholder=" min" @if(isset($searchData['price_min'])) value="{{$searchData['price_min']}}" @endif /> - <input type="number" min="0" name = "price_max" @if(isset($searchData['price_max'])) value="{{$searchData['price_max']}}" @endif style="width: 60px; border-color:#666666" placeholder=" max" /><b class="symbol">{{$currencySymbol}}</b>
					<button type="submit" class="pull-right" style="margin: 1px -25px -8px -7px; "><i class='fa fa-search'></i></button>
					{!! Form::close() !!}
				</aside>
				<br />	
			</aside>
		</div>
	<div class="catalog global_class col-md-10 col-xs-9 col-sm-10 col-lg-10" style="overflow: hidden;">
		<div class="product-tab">
			<div class="container col-lg-10 col-md-10 col-sm-10 col-xs-12" style="float: none; margin: 0 auto;">
					<div class="tab-content">
						<div class="tab-pane active" id="man">
							<div class="row">
								@foreach($items as $key => $item)
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 animation">
									<div class="product">
										<div class="product-thumb-info">
											<section class="product-thumb-info-image">
												@if($item->discount != '0')
												<span class="bag bag-hot">{{$item->discount}} %</span>
												@endif 
												<section>
													@if($item->mainImages != '')
													<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img alt="{{$item->alt}}" class="img-responsive" src="{{URL::asset('/uploads/'.$item->mainImages->name)}}"></a>
													@elseif(count($item->images) > 0)
													<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img alt="{{$item->alt}}" class="img-responsive" src="{{URL::asset('/uploads/'.$item->images[0]->name)}}"></a>
													@else
													<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img alt="{{$item->alt}}" class="img-responsive" src="{{URL::asset('/default/default_img.jpg')}}"></a>
													@endif

													<span class="product-thumb-info-act">
														@if(Auth::check())
															@if(isset($item->favorite))
																<a class="list_heart add-to-favorites" href="#" id="add-to-favorites" data-item = "{{$item->id}}" class="list_heart added-to-favorites" data-status="1">
																<span><i class="icon fa fa-heart"> ADDED</i></span> 
																</a>
															@else
																<a class="list_heart add-to-favorites" href="#" id="add-to-favorites" data-item = "{{$item->id}}" data-status="0">
																<span><i class="icon fa fa-heart " > ADD TO FAVORITES</i></span> 
																</a>
															@endif
														@else
															<a  class="non-logged-in-like" href="javascript:void(0);">
																<span><i class="icon fa fa-heart"> ADD TO FAVORITES</i></span> 
															</a>
														@endif


														@if(isset($item->cart))
														<a class="added" href="javascript:void(0);">
														<span><i class="icon icon-shop fa fa-shopping-cart"> ADDED</i></span>
														</a>
														@else
														<a class="add-to-cart-product item_list{{$item->id}}" data-id="{{$item->id}}" data-subtotal = "{{$subtotal}}" data-title = "{{$item->title}}" data-category = "{{$item->category->category}}" data-price = "{{$item->new_price}}" href="#" data-toggle="modal" data-status="{{$item->status}}">
														<span><i class="icon icon-shop fa fa-shopping-cart"> BUY NOW</i></span>
														</a>
														@endif
													</span>
												</section>   
											</section>
											<div class="img_info">
												<input type="hidden" value="{{ csrf_token() }}" class="token"></input>
												
												@if($item->discount != '0')
												<span class="new_price pull-right" >
												 {{rtrim(rtrim(Currency::format($item->new_price, $currency), 0), '.')}}
												<!-- {{$item->new_price}} -->
												</span>
												<span class="old price" >
												{{rtrim(rtrim(Currency::format($item->price, $currency), 0), '.')}}
												<!-- {{$item->price}} $ -->
												</span>
												@else
												<span class="price" >
												{{rtrim(rtrim(Currency::format($item->price, $currency), 0), '.')}}
												</span>
												@endif
												<span class="item_title"><a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}">{{$item->title}}</a></span><br />
												{{$item->subtitle}}
												<span class="item-cat">
													<small><a href="#"></a></small>
												</span>
												</div> 
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
</div>
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