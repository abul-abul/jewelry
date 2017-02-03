@extends('layouts.app')
@section('css')
	{!! HTML::style( asset('css/example.css')) !!}
	{!! HTML::style( asset('css/pygments.css')) !!}
	{!! HTML::style( asset('css/easyzoom.css')) !!}
	{!! HTML::style( asset('assets/css/owl.carousel.min.css')) !!}
	{!! HTML::style( asset('assets/css/owl.theme.default.min.css')) !!} 
	<style type="text/css">
		/*.owl-controls {
			display: none!important;
		}*/

		.easyzoom img {
	    display: block;
	    width: auto !important; 
		}
 
		.owl-prev, .owl-next {
		    position: absolute;
		    top: 50%; 
		    margin-top: -50px; 
		    width: 50px;
		    height: 50px;
		    text-align: center; 
		    background-color: #333333;
		    color:white;
		    vertical-align: middle;
		    padding:0;
		    line-height: 50px;
		    font-size: 1.285em;
		}
		.owl-next {
		    right: 0px;
		}

		.small-image{
			cursor: pointer;
		}

		.img_info {
            margin-bottom: 20px;
            display: block !important;
            width: 100%;
    	}
    	.excelent_choices{
    		text-align: center;
    	}
	</style>
	
@endsection

@section('script')
{!! HTML::script( asset('/assets/js/show_item_info.js')) !!} 
{!! HTML::script( asset('/assets/js/login_modal.js')) !!}
<!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> -->
{!! HTML::script( asset('js/easyzoom.js')) !!}
{!! HTML::script( asset('assets/js/get_image.js')) !!}
{!! HTML::script( asset('assets/js/owl.carousel.min.js')) !!}
	<script>
		// Instantiate EasyZoom plugin
		var $easyzoom = $('.easyzoom').easyZoom(); 

		// Get the instance API
		var api = $easyzoom.data('easyZoom');
	</script>
	@if(!Auth::user())
	<script type="text/javascript">
		$('#test').parent().addClass("disabledbutton");
	</script>
	@endif

	<script type="text/javascript">
		$(document).ready(function(){
	      $(".owl-carousel-featured").owlCarousel();
	    });

		$('.owl-carousel-featured').owlCarousel({
		    margin:0,
	        autoWidth:false,
	        items:1,
	        dots:true,
	        nav:true,
	        navText:["<i class='fa fa-angle-left'></i>" , "<i class='fa fa-angle-right'></i>"]
			})
	</script>

	<script type="text/javascript"> 
		$(document).ready(function(){
			var current_url = document.URL;
			// var current_url = $('.pinterest-share').data('url');			
			var facebook_href = "http://www.facebook.com/sharer/sharer.php?u="+current_url;
			$('.facebook-share').attr('href', facebook_href);
			var twitter_href = "http://www.twitter.com/share?url="+current_url;
			$('.twitter-share').attr('href',twitter_href);
			var google_plus_href = "https://plus.google.com/share?url="+current_url;
			$('.google-plus-share').attr('href', google_plus_href);
			var image = $('.pinterest-share').attr('data-image');
			var description = $('.pinterest-share').data('description');
			image = encodeURIComponent(image);
			$('.pinterest-share').click(function(){
				console.log(current_url);
			})			
			var pinterest_href = 'http://pinterest.com/pin/create/link/?url='+current_url+'&amp;media='+image+' &amp;description='+description;
			$('.pinterest-share').attr('href', pinterest_href);


		})
	</script>
	<script type="text/javascript">
			$('.hide_text').click( function(){
				if($('.more_info').hasClass('fa-chevron-down')) 
				{
					$('.more_info').removeClass('fa-chevron-down');
					$('.more_info').addClass('fa-chevron-up')
				}else{
					$('.more_info').removeClass('fa-chevron-up');
					$('.more_info').addClass('fa-chevron-down')
				}
	})
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
	    // Handler for .ready() called.
	    var review_error = $('.alert-danger').text();
	    var review_message = $('.alert-success').text();
	    review_error = jQuery.trim(review_error);
	    review_message = jQuery.trim(review_message);
	    if(review_error == "The review field is required." || review_message == "Your review has been sent.")
	    {	        
	      $('html, body').animate({
	          scrollTop: $('.show_message').offset().top
	      }, 'slow');
	    }
	});
 	</script>
{!! HTML::script( asset('/assets/js/remove_review.js')) !!}
{!! HTML::script( asset('/assets/js/edit_review.js')) !!}
{!! HTML::script( asset('/assets/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')) !!}

@endsection

@section('content')
{!! HTML::style( asset('new-css/item-details.css')) !!}
<!-- Begin Main -->
<div role="main" class="main">		
<!-- Begin page top -->
	<div class="page-top breadcrumb-container">
		<div class="container">
			<div class="page-top-in">
				<ol class="breadcrumb pull-left">
					<li>
						<a href="{{action('UserController@getIndex')}}">Home</a>
					</li>
					@if(Session::has('breadcrumb'))

						@if(Session::get('breadcrumb') == "Collections" && $item->collection)
						<li>
							<a href="{{URL::to('/collection/collections')}}">{{Session::get('breadcrumb')}}</a>
						</li>
						<li>
							<a href="{{URL::to('/item/items/collection', [$item->collection->name, 'noSort'])}}">{{$item->collection->name}}</a>
						</li>
						@endif
						@if(Session::get('breadcrumb') == "Occasions")
							<li>
								<a href="{{URL::to('item/occasions/noSort')}}">{{Session::get('breadcrumb')}}</a>
							</li>
						@endif
						@if(Session::get('breadcrumb') == "Featured Products")
							<li>
								<a href="{{URL::to('/item/featured-products/noSort')}}">{{Session::get('breadcrumb')}}</a>
							</li>
						@endif
						@if(Session::get('breadcrumb') == "New Arrivals")
							<li>
								<a href="{{URL::to('item/new-arrivals/noSort')}}">{{Session::get('breadcrumb')}}</a>
							</li>
						@endif
						@if(Session::get('breadcrumb') == $item->category->category)
							<li>
								<a href="{{URL::to('/item/items/category', [$item->category->category, 'noSort'])}}">{{Session::get('breadcrumb')}}</a>
							</li>
						@endif
						@if(Session::get('breadcrumb') == "Favorites")
							<li>
								<a href="{{URL::to('/favorites/favorites')}}">{{Session::get('breadcrumb')}}</a>
							</li>
						@endif
					@endif
					@if($type != "")
					<li>
						@if($type == 'Occasions')
							<a href="{{URL::to('item/occasions/noSort')}}">{{$type}}</a>
						@elseif(Session::get('breadcrumb') == "Collections")
							<a href="{{URL::to('item/collection-categories',[$item->collection->name, $item->category->category, 'noSort'])}}">{{$item->category->category}}</a>
						@else
							<a href="{{URL::to('/item/items/category', [$item->category->category, 'noSort'])}}">{{$type}}</a>
						@endif
					</li>
					@endif
					@if($gemstone != "")
					<li>
						<a href="{{URL::to('/item/items-list/category', [$item->category->category, $gemstoneBreadcrumb, 'noSort'])}}">{{$gemstone}}</a>
					</li>
					@endif
					<li>{{$item->title}}</li>
				</ol>
			</div>
		</div>
	</div>
	<!-- End page top -->

	<div class="container">
	<div class="row">
		<div class="col-md-8 col-lg-8 col-xs-7 col-sm-7">
			<div class="product-preview">
				@if($item->images)
				<div class="owl-carousel-featured">
					@foreach($item->images as $image)
					<div class="item">
						@if($item->discount != '0')
							<span class="bag bag-hot pull-right">{{$item->discount}} %</span>
						@endif
						<div class="easyzoom easyzoom--overlay">
							<a href="{{URL::asset('/uploads/'.$image->name)}}">
								<img class="img-responsive main-slide {{$image->id}} normal" id="img{{$image->id}}" data-id="{{$image->id}}" src="{{URL::asset('/uploads/'.$image->name)}}" alt="{{$item->alt}}" />								
							</a>
						</div>
						@if($item_status == 'Coming Soon')
							<span class="status-bag pull-left ">Coming Soon</span>
						@endif
					</div>
					@endforeach
				</div>
				<br />					 
				<div class="list-inline bx-pager">
					<div class="small-images col-md-12 col-xs-12 col-sm-12 col-lg-12">
						@foreach($item->images as $key => $smalliImage)
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
								<a class="image_id small-image" data-id="{{$smalliImage->id}}">
									<img class="img-responsive small-slides {{$smalliImage->id}}" data-index = "{{$key}}" src="{{URL::asset('/uploads/'.$smalliImage->name)}}" data-id="{{$smalliImage->id}}" alt="{{$item->alt}}" />
								</a>
							</div>
						@endforeach
					</div>
				</div>
				@endif        
			</div>
			<div id="accordion2" class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">
						<br />
						<label class="item_info">ITEM INFORMATION</label>							
						<ul class="item_description show_more">
							@foreach($descriptionOne as $desc)
							<li >{{ $desc }}</li>
							@endforeach
						</ul>
						@if($descriptionTwo)
						<div id="collapseOne" class="panel-collapse collapse">
							<div> 
								<ul class="item_description">
									@foreach($descriptionTwo as $description)
									<li>{{ $description }}</li>
									@endforeach
								</ul>
								<a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" class="collapsed">
							</div>
						</div>
						<h4>
							<a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" class="collapsed">
							<b class="item-information hide_text"><i style="font-size: 1.2em;" class="fa fa-chevron-down more_info"></i> SHOW MORE INFORMATION</b>
							</a>
						</h4>
						@Endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4 col-xs-5 col-sm-5">
		<div class="summary entry-summary">
			<b class="item_title">{{$item->title}}</b><br />
			<label style="font-size: 1.7em; color: #423d3d;">{{$item->subtitle}}</label>
			<p class="price" >
				@if($item->discount != '0')
				<span class = "text-price">{{rtrim(rtrim(Currency::format($item->price, $currency), 0), '.')}}</span>
				<span class = "text-new-price">{{rtrim(rtrim(Currency::format($item->new_price, $currency), 0), '.')}}</span>
				@else
				<span class = "text-price-else">{{rtrim(rtrim(Currency::format($item->price, $currency), 0), '.')}}</span>
				@endif
			</p>
			<ul class=" product-meta">
				<li><b>Jewelry Type:</b> {{$item->category->category}}</li>
				<li><b>Collection:</b> {{$item->coll}}</li>
				<li><b>Metal: </b>
					@if(count($item->metals) > 0)
					@foreach($item->metals as $key => $metal)
					{{$metal->name}}
					@if($key != count($item->metals) - 1),
					@endif 
					@endforeach
					@else 
					No metals
					@endif
				</li>
				<li><b>Gemstones: </b>
					@if(count($item->gemstones) > 0)
					@foreach($item->gemstones as $key => $gemstone)
					{{$gemstone->name}}
					@if($key != count($item->gemstones) - 1) ,
					@endif
					@endforeach
					@else
					No gemstones
					@endif
				</li>
				@if($item->category->category == 'Rings' && $item->size)
				<li>
					<b>Size:</b>
					<select  class="formDropdown ring_size" id="itemSize" name="size">
						<option value="0" >Select size</option>
						@foreach($item->size as $size)
						<option value="{{$size->size}}">{{$size->size}}</option>
						@endforeach
					</select>	
				</li>					
				@else
				<input id="itemSize" name="size" type="hidden" value="0"/>
				@endif
			</ul>

		<br />
		{!! csrf_field() !!}
		<div class="quantity pull-left col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<input type="button" onclick="counter(-1)" class="minus xxxx col-md-4 col-lg-4 col-sm-4 col-xs-4" data-id="xx{{$item->id}}" value="-" />
			<input type="text" class="input-text qty xxxx col-md-4 col-lg-4 col-sm-4 col-xs-4" id="xx{{$item->id}}" title="Qty" value="1" name="quantity" min="1" step="1" maxquantity="{{$item->quantity}}"/>
			<input type="button" onclick="counter(1)" class="plus xxxx col-md-4 col-lg-4 col-sm-4 col-xs-4" data-id="xx{{$item->id}}" value="+" />
		</div>
		<div>
			@if(isset($cart))
			<button class="btn btn-primary btn-icon added" ><i class="fa fa-shopping-cart"></i>
			Added
			</button>
			@else
			<button data-toggle="modal" data-id="{{$item->id }}" data-subtotal = "{{$subtotal}}" data-title = "{{$item->title}}" data-category = "{{$item->category->category}}" data-price = "{{$item->new_price}}" @if($main_image) data-image = "{{URL::asset('/uploads/'.$main_image)}}" @else data-image = "{{URL::asset('/default/default_img.jpg')}}" @endif class="btn btn-icon  add_cart" data-status="{{$item->status}}"><i class="fa fa-shopping-cart"></i>
			Add to cart
			</button>
			@endif
		</div>
		<br />
		<div >
			@if(Auth::check())
			@if($status == "1")
			<button href="#" id="add-to-favorites" data-item = "{{$item->id}}" class="liked btn btn-primary btn-icon added-to-favorites add-to-favorites" data-status = "{{$status}}">
			<i class="fa fa-heart"> </i>In Favorites
			</button>
			@else
			<button  href="#" id="add-to-favorites" data-item = "{{$item->id}}" class="like btn btn-primary btn-icon add-to-favorites " data-status = "{{$status}}">
			<i class="fa fa-heart"></i> Add to Favorites
			</button>
			@endif
			@else
			<button  class="like btn btn-primary btn-icon non-logged-in-like ">
			<i class="fa fa-heart"></i>Add to Favorites
			</button>				
			@endif
		</div>
		<input type="hidden" value="{{$item->id}}" />
		<input type="hidden" value="{{ csrf_token() }}" class="token" />
		<br /><br />

		<h5><b>Share:</b></h5>
		<ul class="list-inline social-list social">
			<li><a class="facebook-share" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook" href=""><i class="fa fa-facebook"></i></a></li>
			<li><a class="twitter-share" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter" href=""><i class="fa fa-twitter"></i></a></li>
			<li><a class="google-plus-share" target="_blank" data-toggle="tooltip" data-placement="top" title="Google+" href=""><i class="fa fa-google-plus"></i></a></li>
			<li><a class="pinterest-share" target="_blank" data-url="{{$shareUrl}}" data-toggle="tooltip" data-placement="top" data-description="{{$item->title}}" title="Pinterest" @if($main_image) data-image = "{{URL::asset('/uploads/'.$main_image)}}" @elseif(count($item->images) > 0) data-image = "{{URL::asset('/uploads/'.$item->images[0]->name)}}" @else data-image = "{{URL::asset('/default/default_img.jpg')}}" @endif href=""><i class="fa fa-pinterest"></i></a></li>
		</ul>
		<div id="accordion1" class="panel-group show_message">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion1" href="#collapseThree" class="collapsed">
						<b class="item-reviews ">Reviews (<span class="review-count" >{{$count}}</span>)</b>
						</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse in">					
					@if(Session::has('review_error'))

					    <div class="alert alert-danger">
					        {{Session::get('review_error')}}
					    </div>

					<?php Session::forget('review_error') ?>
					@endif


					@if(Session::has('review_message'))

					    <div class="alert alert-success">
					        {{Session::get('review_message')}}
					    </div>

					<?php Session::forget('review_message') ?>
					@endif	
					<ul class="panel-body post-comments">
						@foreach($reviews as $review)
						<br />
						<div class="review{{$review->id}} col-md-12 col-lg-12 col-sm-12 col-xs-12">
							@if($review->user->image)
							<div class="col-md-4 col-lg-4 col-sm-4 col-xs-5">
								<img class="img-responsive small-slides" src="{{URL::asset('/uploads/'.$review->user->image)}}" alt=""/>
							</div> 
							@endif
							<div class="comment col-md-8 col-lg-8 col-sm-8 col-xs-7">
								<div class="comment-block">									
									<span class="comment-by"> <strong>{{$review->user->first_name}} {{$review->user->last_name}}</strong></span>
									<span class="date"><small><i class="fa fa-clock-o"></i>{{$review->date}}</small></span>
									<p class="review{{$review->id}}">{{$review->review}}</p>
									@if(Auth::user() && Auth::user()->id == $review->user_id)
									<span class="edit_review" type="submit" data-id="{{$review->id}}" style="cursor: pointer;"><i class="fa fa-pencil"></i></span>
									<span class="remove_review" data-id="{{$review->id}}" style="cursor: pointer;"><i class="fa fa-trash"></i></span>
									@endif
									<hr/>
								</div>
							</div>
						</div>
						<span class="panel-body postedit-comments{{$review->id}}" style="display:none"> 
							@if(Auth::user())
							{!! Form::model($review, ['action' => ['User\ItemController@postEditReview',$review->id], 'class' => 'form-horizontal']) !!}
							<input type="hidden" value="{{ csrf_token() }}" class="token"/>
							{!! Form::textarea('review', null, ['class' => 'form-control review-form' ]) !!} <br />
							<button class="btn btn-primary review_button btn-sm"><b>Save</b></button>
							<span class="btn btn-primary cancel_button btn-sm" data-id="{{$review->id}}"><b>Cancel</b></span>
							{!! Form::close() !!}
							@endif
						</span>
						<br />
						@endforeach
					</ul>
					<div class="panel-body post-comments"> 
						@if(Auth::user())
						{!! Form::open(['action' => ['User\ItemController@postAddReview',$item->id], 'class' => 'form-horizontal']) !!}
						{!! Form::textarea('review', null, ['class' => 'form-control review-form' ]) !!} <br />
						<button class="btn btn-primary review_button"><b>Save</b></button>
						{!! Form::close() !!}
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	@if($video)
		<div class="container col-md-12 col-lg-12 col-xs-12 col-sm-12">
			<iframe class="video_run" src='https://www.youtube.com/embed/{{$video}}'></iframe>
		</div>
	@endif
</div>
</div>
		<div class="excellent-choices">
			<div class="excelent_choices container-excelent">
				<h2><b>Excellent Choices</b></h2>
				<h4>Customers who purchased these items also purchased these items</h4>
				<div class="row row-centered">
				@foreach($suggested_items as $item)
				<div class="col-md-3 col-lg-2 col-xs-6 col-sm-4 container excellent_choices col-centered">
					<div class=" animation">
						<div class="product">
							<div class="product-thumb-info">
								<div class="product-thumb-info-image">
									@if($item->discount != '0')
										<span style="display: none;" class="bag bag-hot">{{$item->discount}} %</span>
									@endif 
									<div>
											<span class="product-thumb-info-act"></span>  
									@if($item->mainImages != '')
										<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img alt="{{$item->alt}}" class="img-responsive excellent-images" src="{{URL::asset('/uploads/'.$item->mainImages->name)}}"></a>
									@elseif(count($item->images) > 0)
										<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img alt="{{$item->alt}}" class="img-responsive excellent-images" src="{{URL::asset('/uploads/'.$item->images[0]->name)}}"></a>
									@else
										<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img alt="{{$item->alt}}" class="img-responsive excellent-images" src="{{URL::asset('/default/default_img.jpg')}}"></a>
									@endif
									</div>   
									
								</div>
								<div class="img_info">
										@if($item->discount != '0') 
											<span class="pull-right pull-right-new-price">{{rtrim(rtrim(Currency::format($item->new_price, $currency), 0), '.')}}</span>
											<span class="pull-right-price">{{rtrim(rtrim(Currency::format($item->price, $currency), 0), '.')}}</span>
										@else
											<span class="pull-right-price-else">{{rtrim(rtrim(Currency::format($item->price, $currency), 0), '.')}}</span>
										@endif
										<h4><a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}">{{$item->title}}<p>{{$item->subtitle}}</p></a></h4>
										<span class="item-cat"><small><a href="#"></a></small></span>
									</div> 
							</div>
						</div>
					</div>
				</div>
				@endforeach
				</div>
			</div >		
		</div>
	</div>
	<div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Review</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline btn-xs" data-dismiss="modal">Close</button>
                    <a href="" id="delete_review"><button type="button" class="btn btn-xs red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Begin Quickview -->
<div class="modal fade bs-modal-sm" id="comingSoon" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
               
            </div>
            <div class="modal-body">
            	<label id="item_page" data-dismiss="modal">This item will be in store soon!</label>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

	@endsection