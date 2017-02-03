@extends('layouts.app')
@section('css')
	<style type="text/css">
		.disabledbutton {
		    pointer-events: none;
		    opacity: 0.4;
		}
	</style>
	{!! HTML::style( asset('/assets/css/jquery-ui.css')) !!} 
@endsection
@section('script')

	@if(!Auth::user())
	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function(){
				$('.rating-input').addClass("disabledbutton");
			},10)
			
		})

	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function(){
				$('.rating-input').addClass("disabledbutton");
			},10)
			$( "#slider-range" ).slider({
		    	range: true,
		     	min: 0,
		      	max: 5000,
		      	values: [0, 5000 ],
		      	slide: function( event, ui ) {
		        	$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		      	}
		    });
		    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
		})
	</script>
	@endif
{!! HTML::script( asset('/assets/js/rating.main.js')) !!}
{!! HTML::script( asset('/assets/js/item-rate.js')) !!}
@endsection
@section('content')
		<!-- Begin Main -->
		<div role="main" class="main">
		
			<!-- Begin page top -->
			<section class="page-top-md">
				<div class="container">
					<p style="text-align: center;margin-top: 15px">
						<i>Jewels were always part of human culture. Even from the times when humans first started using clothes and tools some 100.000 years ago, jewels were produced from any kind of materials that were available - stones, animal skins, feathers, plants, bones, shells, wood, and natural made semi-precious materials such as obsidian. As the time went on, advancing technology enabled artisans to start taming metals and precious gems into works of art that influenced entire cultures and many modern jewelry styles. However, even with all advancements of metallurgy and gem processing, the purpose of wearing jewelry always remained the same - they enabled wearer to express himself non-verbally, showcase wealth, rank, political and religious affiliation or affections toward someone. This enabled jewelry to become timeless and a target for constant development and refinement.</i>
					</p>
				</div>
			</section>
			<!-- End page top -->
			
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						{!! Form::open([ 'method' => 'GET' ,'action' => ['User\ItemController@getSearch'], 'class' => 'form-horizontal','id' => 'form-login','role' => 'form' ]) !!}
							<aside class="sidebar">
								<aside class="block blk-cat">
									<h4>Jewelry Type</h4>
									<ul class="list-unstyled list-cat">
									@foreach($categories as $category)
										<li><input type="radio" name="categories" value="{{$category->id}}" @if($searchData['categories'] == $category->id)checked="checked" @endif>  {{$category->category}}</li>
									@endforeach	
										<li><input type="radio" name="categories" value="{{null}}" @if($searchData['categories'] == null)checked="checked" @endif> None</li>
									</ul>
								</aside>
								<aside class="block blk-brands">
									<h4>Collection</h4>
									<ul class="list-unstyled list-cat">
									@foreach($collections as $collection)
										<li><input type="radio" name="collections" value="{{$collection->id}}" @if($searchData['collections'] == $collection->id)checked="checked" @endif>  {{$collection->name}}</li>
									@endforeach	
										<li><input type="radio" name="collections" value="{{null}}" @if($searchData['collections'] == null)checked="checked" @endif> None</li>
									</ul>
								</aside>
								<aside class="block blk-colors">
									<h4>Metal</h4>
									<ul class="list-unstyled list-cat">
										@foreach($metals as $metal)
											<li><input type="radio" name="metals" value="{{$metal->id}}" @if($searchData['metals'] == $metal->id)checked="checked" @endif>  {{$metal->name}}</li>
										@endforeach	
											<li><input type="radio" name="metals" value="{{null}}" @if($searchData['metals'] == null)checked="checked" @endif> None</li>
									</ul>
								</aside>
								<aside class="block blk-colors">
									<h4>Gemstones</h4>
									<ul class="list-unstyled list-cat">
										@foreach($gemstones as $gemstone)
											<li><input type="radio" name="gemstones" value="{{$gemstone->id}}" @if($searchData['gemstones'] == $gemstone->id)checked="checked" @endif>  {{$gemstone->name}}</li>
										@endforeach	
										<li><input type="radio" name="gemstones" value="{{null}}" @if($searchData['gemstones'] == null)checked="checked" @endif> None</li>
									</ul>
								</aside>
								<aside class="block blk-colors">
									<ul class="list-unstyled list-cat">
										<p>
										 	<label for="amount">Price</label>
										  	<input type="text" id="amount" name="price" readonly style="border:0; color:#455454; font-weight:bold;">
										</p>
										 
										<div id="slider-range"></div>
									</ul>
								</aside>
								<aside class="block filter-blk">
									<div id="price-range">
										<p class="clearfix"><button type="submit" class="btn btn-primary btn-sm">Apply Filter</button></p>
									</div>
								</aside>
							</aside>
						{!! Form::close() !!} 
					</div>
					<div class="col-md-9">						
						<div class="catalog">
							<div class="toolbar clearfix">
								<p class="pull-left">Showing 1-12 of 50 results</p>
							</div>
							@foreach($items as $key => $item)
							<div class="product product-list animation">
								<div class="product-thumb-info">
									<div class="row">
										<div class="col-xs-5 col-sm-3">
											<div class="product-thumb-info-image">
											@if($item->mainImages != '')
												<img alt="" class="img-responsive" src="{{URL::asset('/uploads/'.$item->mainImages->name)}}">
											@elseif(count($item->images) > 0)
												<img alt="" class="img-responsive" src="{{URL::asset('/uploads/'.$item->images[0]->name)}}">
											@else
												<img alt="" class="img-responsive" src="{{URL::asset('/default/default_img.jpg')}}">
											@endif
											</div>
										</div>	
										<div class="col-xs-7 col-sm-9">
											<div class="product-thumb-info-content">
												<h4><a href="{{URL::to('item/item',[$item->collection->name, $item->category->category, $item->slug])}}">{{$item->title}}</a></h4>
												<div class="reviews-counter clearfix">
													<div class="rating five-stars pull-left">
														<input type="number" class="rating rate" name="test" data-min="1" data-max="5" value="{{$item->rating}}">
														<input type="hidden" class="it_id" data-id="{{$item->id}}">
														<div class="star-bg"></div>
													</div>
													<span>{{$item->review}} Reviews</span>
												</div>
												<p class="price">{{$item->price}}   USD</p>
												<p>{{$item->description}}</p>
												<p class="btn-group">
													<button class="btn btn-sm btn-icon add-to-cart-product" data-id="{{$item->id}}" href="#"><i class="fa fa-shopping-cart"></i> Add to cart</button>
													<a href="#">
														<span><i class="fa fa-heart-o"></i></span>
													</a>
												</p>
											</div>
										</div>	
									</div>	
								</div>
							</div>
							@endforeach							
					   </div>
					   {!! $items->render() !!}
					</div>
				</div>
					

						
				<!-- Begin Latest Blogs -->
				<section class="latest-blog">
					<div class="container">
						<h2 class="title"><span>Collection</span></h2>
						<div class="row">
							<div class="col-xs-6 animation">
								<article class="post">
									<div class="post-image">
										<span class="post-info-act">
											<a href="blog-single.html"><i class="fa fa-caret-right"></i></a>
										</span>
										<img class="img-responsive" src="https://www.pacificfair.com.au/PacificFair/media/contents/04_Stores/01_Store_Logos/logo_Swarovski.png?ext=.png" alt="Blog">
									</div>
									<h3><a href="blog-single.html">Paris Fashion Week S/S 2014: womenswear collections</a></h3>
									<p class="date"><small>15th December 2014</small></p>
								</article>
							</div>
							<div class="col-xs-6 animation">
								<article class="post">
									<div class="post-image">
										<span class="post-info-act">
											<a href="blog-single.html"><i class="fa fa-camera"></i></a>
										</span>
										<img class="img-responsive" src="https://www.pacificfair.com.au/PacificFair/media/contents/04_Stores/01_Store_Logos/logo_Swarovski.png?ext=.png" alt="Blog">
									</div>
									<h3><a href="blog-single.html">Show tunes: London Fashion Week S/S 2014's runway playlist</a></h3>
									<p class="date"><small>15th December 2014</small></p>
								</article>
							</div>
						</div>
					</div>
				</section>
				<!-- End Latest Blogs -->
			</div>
			
		</div>
		<!-- End Main -->
@endsection
@section('script')

@endsection