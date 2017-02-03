@extends('layouts.app')

@section('css')
    {!! HTML::style( asset('new-css/home.css')) !!}
    {!! HTML::style( asset('assets/css/owl.carousel.min.css')) !!}
    {!! HTML::style( asset('assets/css/owl.theme.default.min.css')) !!}

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    {!! HTML::script( asset('assets/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')) !!}
    {!! HTML::script( asset('assets/js/owl.carousel.min.js')) !!}
    <script type="text/javascript">
        $(document).ready(function(){
            $(".owl-carousel-featured").owlCarousel();
        });

        $('.owl-carousel-featured').owlCarousel({
            margin:0,
            autoWidth:false,
            items:1,
            dots:true
        })

        $('.back').hover(function(){
            $(this).children('.category_center_container').children('.shop_now1').attr('style', 'display: block;')
        }, function(){
            $(this).children('.category_center_container').children('.shop_now1').attr('style', 'display: none;')
        })

    </script>

@endsection
@section('content')
    <h1 class="home_title">online jewellery shopping</h1>
    <h2 class="home_title">online jewellery shopping</h2>
    <div role="main" class="main">
        <!-- Begin Main Slide -->
        <div class="main-slide border">
            <div id="owl-main-demo" class="owl-carousel main-demo">
                @foreach($collectionsSlide as $slide)
                    <div class="item"><img src="/uploads/{{$slide->image}}" class="img-responsive slider-image" alt="{{$slide->alt}}">
                        <div class="item-caption ">
                            <div class="item-caption-inner">
                                <div class="item-caption-wrap">
                                    <div class="slider_text pull-left" >{!! $slide->description !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
            <div class="border">
                <div class="col-md-6 col-sm-6 col-xs-6 back" >
                    @if(count($collImages) > 0)
                            <img src="{{URL::asset('/uploads/'.$collImages[0]->name)}}" alt="{{$gallery['Collections']->alt}}" class="collection_image" >
                    @else

                        <img  src="{{URL::asset('/seederImg/collection.jpg')}}" class="collection_image"  alt="{{$gallery['Collections']->alt}}" >
                    @endif
                    <div class="home_categorys category_center_container" >
                        <p class="category-shop-now">COLLECTIONS</p>
                        <a href="{{URL::to('collection/collections')}}" class="btn hidden-md col_shop_now shop_now shop_now1">Shop Now</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 back" >
                    @if($gallery['New Arrivals']->image)
                        <img src="{{URL::asset('/uploads/'.$gallery['New Arrivals']->image)}}" alt="{{$gallery['New Arrivals']->alt}}" class="collection_image">
                    @else
                        <img  src="{{URL::asset('/seederImg/new_arrivals.jpg')}}" class="collection_image" alt="{{$gallery['New Arrivals']->alt}}">
                    @endif
                    <div class="new_arr">
                        <a href="{{URL::to('item/new-arrivals', 'noSort')}}" class="btn btn-transparent btn-xs shop_now">NEW ARRIVALS</a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="border">
                <div class="col-md-4 col-sm-4 col-xs-6 back" >
                    @if($category['Rings']->image)
                        <img  src="{{URL::asset('/uploads/'.$category['Rings']->image)}}" class="category_image" alt="{{$category['Rings']->alt}}">
                    @else
                        <img  src="{{URL::asset('/seederImg/Rings.png')}}"  alt="{{$category['Rings']->alt}}" class="category_image">
                    @endif
                    <div class="category_center_container">
                        <p class="category-shop-now">
                            @if($category['Rings']->style)
                                {!! $category['Rings']->style !!}
                            @else
                                RINGS
                            @endif
                        </p>
                        <input type="hidden" name="name" value="Rings"/>
                        <a href="{{URL::to('item/items',['category', 'Rings', 'noSort'])}}" class="btn btn-transparent btn-lg shop_now shop_now1">Shop Now</a>
                    </div>
                </div>
                <div class="col-md-4  col-sm-4 col-xs-6 back" >
                    @if($category['Necklaces']->image)
                        <img  src="{{URL::asset('/uploads/'.$category['Necklaces']->image)}}"  alt="{{$category['Necklaces']->alt}}"
                              class="category_image">
                    @else
                        <img  src="{{URL::asset('/seederImg/Necklaces.jpg')}}"  alt="{{$category['Necklaces']->alt}}" class="category_image">
                    @endif
                    <div class="category_center_container">
                        <p class="category-shop-now">
                            @if($category['Necklaces']->style)
                                {!! $category['Necklaces']->style !!}
                            @else
                                NECKLACES
                            @endif
                        </p>
                        <a  href="{{URL::to('item/items',['category', 'Necklaces', 'noSort'])}}" class="btn btn-transparent btn-lg shop_now shop_now1">Shop Now</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 back">
                    @if($category['Bracelets']->image)
                        <img  src="{{URL::asset('/uploads/'.$category['Bracelets']->image)}}"  alt="{{$category['Bracelets']->alt}}" class="category_image">
                    @else
                        <img  src="{{URL::asset('/seederImg/Bracelets.jpg')}}"  alt="{{$category['Bracelets']->alt}}" class="category_image">
                    @endif
                    <div class="category_center_container">
                        <p class="category-shop-now">
                            @if($category['Bracelets']->style)
                                {!! $category['Bracelets']->style !!}
                            @else
                                BRACELETS
                            @endif
                        </p>
                        <a href="{{URL::to('item/items',['category', 'Bracelets', 'noSort'])}}" class="btn btn-transparent btn-lg shop_now shop_now1">Shop Now</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 back">
                    @if($category['Earrings']->image)
                        <img  src="{{URL::asset('/uploads/'.$category['Earrings']->image)}}"  alt="{{$category['Earrings']->alt}}" class="category_image">
                    @else
                        <img  src="{{URL::asset('/seederImg/Earrings.jpg')}}"  alt="{{$category['Earrings']->alt}}" class="category_image">
                    @endif
                    <div class="category_center_container">
                        <p class="category-shop-now">
                            @if($category['Earrings']->style)
                                {!! $category['Earrings']->style !!}
                            @else
                                EARRINGS
                            @endif
                        </p>
                        <a href="{{URL::to('item/items',['category', 'Earrings', 'noSort'])}}" class="btn btn-transparent btn-lg shop_now shop_now1">Shop Now</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 back">
                    @if($category['Crosses & Rosaries']->image)
                        <img  src="{{URL::asset('/uploads/'.$category['Crosses & Rosaries']->image)}}"  alt="{{$category['Crosses & Rosaries']->alt}}" class="category_image">
                    @else
                        <img  src="{{URL::asset('/seederImg/Crosses_rosaries.jpg')}}"  alt="{{$category['Crosses & Rosaries']->alt}}" class="category_image">
                    @endif
                    <div class="category_center_container">
                        <p class="category-shop-now">
                            @if($category['Crosses & Rosaries']->style)
                                {!! $category['Crosses & Rosaries']->style !!}
                            @else
                                CROSSES & ROSARIES
                            @endif
                        </p>
                        <a href="{{URL::to('item/items',['category', 'Crosses & Rosaries', 'noSort'])}}" class="btn btn-transparent btn-lg shop_now shop_now1">Shop Now</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 back">
                    @if($category['Chains']->image)
                        <img  src="{{URL::asset('/uploads/'.$category['Chains']->image)}}"  alt="{{$category['Chains']->alt}}" class="category_image">
                    @else
                        <img  src="{{URL::asset('/seederImg/Chains.jpg')}}"  alt="{{$category['Chains']->alt}}" class="category_image">
                    @endif
                    <div class="category_center_container">
                        <p class="category-shop-now">
                            @if($category['Chains']->style)
                                {!! $category['Chains']->style !!}
                            @else
                                CHAINS
                            @endif
                        </p>
                        <a href="{{URL::to('item/items',['category', 'Chains', 'noSort'])}}" class="btn btn-transparent btn-lg shop_now shop_now1">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="back gallery">
            <div class="owl-carousel-featured owl-theme">
                @if($all_featured_items_count > 0)
                    @foreach($featuredArr as $key => $arr)
                        <div class="item">
                            @if($gallery['Featured Items']->image)
                                <img src="{{URL::asset('/uploads/'.$gallery['Featured Items']->image)}}" alt="{{$gallery['Featured Items']->alt}}" class="featured_image">
                            @else

                                <img src="{{URL::asset('/seederImg/01.jpg')}}"  class="img-responsive slider-image featured_image" alt="jewellery">
                            @endif
                            <div class="gallery-text">
                                <a class="home_our_featured" href="/item/featured-products/noSort">Our Featured Products</a>
                                <div class="featured_items_centered">
                                    @foreach($featuredArr[$key] as $featItem)

                                        <div class="featArr col-md-2 col-xs-2 col-lg-2 col-sm-2">
                                            <a class="featItemsTitle" href="{{URL::to('item/item',[$featItem->category->category, $featItem->slug])}}" ><img alt="{{$featItem->alt}}" src="/uploads/{{$featItem->image->name}}" class="round featured_items"></a>
                                            <div class="sku_container">
                                                <a class="featItemsTitle" href="{{URL::to('item/item',[$featItem->category->category, $featItem->slug])}}" >
                                                    {{$featItem->title}}
                                                </a>
                                                <a class="featItemsTitle" href="{{URL::to('item/item',[$featItem->category->category, $featItem->slug])}}" >
                                                    {{$featItem->subtitle}}
                                                </a>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div>
            <div class="col-md-6 col-sm-6 col-xs-12 back">
                @if($gallery['Newsletter']->image)
                    <img alt="jewelry stores" src="{{URL::asset('/uploads/'.$gallery['Newsletter']->image)}}" class="event_image">
                @else
                    <img alt="jewelry stores" src="{{URL::asset('/seederImg/newsletter.jpg')}}" class="event_image">
                @endif
                <div>
                    <div class="newsletter1 col-md-9  not-footer-letter">
                        <div class="news"><b>NEWSLETTER</b></div>

                        <input type="hidden" class="sessionCheck">

                        <div style="display: none" class="newsletter-success alert alert-success">
                        </div>

                        <div style="display: none" class="newsletter-danger alert alert-danger">
                        </div>

                        <form class="form-inline form-newsletter home-letter" type="POST">
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail3"
                                       placeholder="Please enter your email" name="user_email">
                            </div>
                            <button type="submit" class="btn newsletter-button">
                                <i class="fa fa-caret-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 back">
                @if($gallery['Event']->image)
                    <img alt="{{$gallery['Event']->alt}}" src="{{URL::asset('/uploads/'.$gallery['Event']->image)}}" class="event_image">
                @else
                    <img alt="{{$gallery['Event']->alt}}" src="{{URL::asset('/seederImg/event.jpg')}}" class="event_image">
                @endif
            </div>
        </div>
    </div>

@endsection
