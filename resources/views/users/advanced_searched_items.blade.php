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
	<section class="page-top" >
		<div class="container" >
		<br />
			<ul class=" product-meta">
			<div class="col-md-6">
				<li class="search_info">
					<b>Title:</b> @if($searchData['title'] != "")
									{{$searchData['title']}}
									@else
									No Title
									@endif

				</li>
				<li class="search_info">
					<b>SKU:</b> @if($searchData['subtitle'] != "") 
									{{$searchData['subtitle']}}
									@else
									No Subtitle
									@endif
				</li>
				<li class="search_info">
					<b>Description:</b> @if($searchData['description'] != "")
									{{$searchData['description']}}
									@else
									No Description
									@endif
				</li>
				<li class="search_info"><b>Jewelry Type:</b> @if(isset($searchData['category']))
															{{$searchData['category']}}
															@else No category
															@endif
				</li>
			</div>
			<div class="col-md-6">
			<li class="search_info"><b>Collection:</b> @if(isset($searchData['collection']))
															{{$searchData['collection']}}
															@else No Collection
															@endif
			</li>
				<li class="search_info"><b>Metal: </b>
				@if(count($searchData['metals']) > 0)
					@foreach($searchData['metals'] as $key => $metal)
					{{$metal}}
					@if($key == count($searchData['metals']) - 1).
					@else 
					@endif 
					@endforeach
				@else 
					No metals
				@endif
				</li>
				<li class="search_info"><b>Gemstones: </b>
				@if(count($searchData['gemstones']) >0)
					@foreach($searchData['gemstones'] as $key => $gemstone)
					{{$gemstone}}
					@if($key == count($searchData['gemstones']) - 1).
					@else, 
					@endif
					@endforeach
				@else
					No gemstones
				@endif
				</li>
				<li class="search_info">
					<b>Price:</b> @if($searchData['minPrice'] !="" && $searchData['maxPrice'])
									{{$searchData['minPrice']}} - {{$searchData['maxPrice']}} {{$currency}}
									@else
									{{$searchData['minPrice']}}
									{{$searchData['maxPrice']}} {{$currency}}
									@endif
				</li>
	        </div>  
			</ul>
		</div>
	</section>	
<div role="main" class="main" >
	<div class="container">
		<div class="catalog">	
			<section class="product-tab">
				<div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="tab-content">
						<div class="tab-pane active" id="man">
							<div class="row">
							@if(count($items)>0)
								@foreach($items as $key => $item)
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 animation">
									<div class="product">
										<div class="product-thumb-info">
											<section class="product-thumb-info-image">
												@if($item->discount != '0')
												<span class="bag bag-hot">{{$item->discount}} %</span>
												@endif  
												<section>
													@if($item->mainImages != '')
													<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img alt="" class="img-responsive" src="{{URL::asset('/uploads/'.$item->mainImages->name)}}"></a>
													@elseif(count($item->images) > 0)
													<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img alt="" class="img-responsive" src="{{URL::asset('/uploads/'.$item->images[0]->name)}}"></a>
													@else
													<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img alt="" class="img-responsive" src="{{URL::asset('/default/default_img.jpg')}}"></a>
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
												<input type="hidden" value="{{ csrf_token() }}" class="token"/>
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
								@else
								<h3 style="text-align: center">No results</h3>
								@endif
							</div>
								<div class="row paginate-row">
									{{ $items->links() }}
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
@endsection