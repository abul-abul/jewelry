@section('script')

{!! HTML::script( asset('/assets/js/addtocartbutton.js')) !!}
{!! HTML::script( asset('assets/js/show_last_item.js')) !!}

@endsection
{!! HTML::style( asset('new-css/header.css')) !!}   

<div class="top-div global_class">
    <div class="upper global_class">
        <ul class="nav  navbar-nav  navbar-main  navbar-navigation1"> 
        <li>
            <a class="phone">
                <span class="glyphicon glyphicon-earphone"></span>
                <b> 949-864-6055 </b>
            </a>
        </li>
           <li> 
                <a href="{{action('UserController@getContact')}}"><b> CONTACT US </b></a> 
           </li> 
            <li> 
                <a href="{{action('UserController@getAboutShop')}}"><b> ABOUT US </b></a> 
           </li>  
            <li> 
                <a href="{{action('User\BlogController@getBlog')}}"><b> BLOG </b></a> 
           </li>
        </ul>
        <ul class="nav navbar-nav navbar-main navbar-navigation2">    
            <li  class="currency_li currency_li1"> 
             {{--    <a href="javascript:void(0);" style="margin-top: -4px"> --}}
                    <b class="about-us">Currency </b>
                    <select onChange="window.location.href=this.value" id="currency" name="currency" class="styled-select">
                       <option value="{{URL::to('item/change-currency/USD')}}" @if($currency == 'USD') selected @endif >$ USD</option>
                       <option value="{{URL::to('item/change-currency/EUR')}}" @if($currency == 'EUR') selected @endif>€ EUR</option>
                       <option value="{{URL::to('item/change-currency/GBP')}}" @if($currency == 'GBP') selected @endif >£ GBP</option>
                    </select>
              {{--   </a> --}}
            </li>

            <li class="login header_login">
                 <a><b class="about-us">My Account</b></a>
            </li>
            @if(Auth::user())
            <li class="header_fac">
                <a href="{{URL::to('favorites/favorites')}}" ><b class="about-us">FAVORITES</b></a>                        
            </li>
            @else                   
            <li  class="login header_fac">
                <a href="javascript:void(0);"><b class="about-us">FAVORITES</b></a>
            </li>
            @endif
            <li  class="dropdown menu-shop nav nav-pills nav-top header_fac">
                <a href="#" id="show_last_item" class="dropdown" data-toggle="dropdown">              
                    <b>Bag</b>
                    <span><i class="fa fa-shopping-cart"></i></span>
                     <span class="shopping-bag">
                        {{$quantity}} 
                    </span>
                </a>
                <div class="last_item_dropdown pull-left">
 
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="header">
    <div class="oh-scarlett-logo-div">
        <div class="header_fac">
            <div class="mysearch">
                <form class="form-inline" action="{{action('User\ItemController@getSearch')}}">
                    <div class="form-group">
                        <input class=" search-input" type="text" name="search" id="search" size="30" placeholder="Search entire store here... " required="required">
                        <button type="submit" class="button-search"><i class='fa fa-search header-search'></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <div class="logo_block">
                <a href="{{action('UserController@getIndex')}}">
                    <img alt="jewelry logo" class="oh-scarlett-logo" src="{{URL::asset('/seederImg/logo.gif')}}"> 
                </a>
                <div class="search pull-right">
                    <!-- <a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg"> Search entire store here <i class="fa fa-search"></i></a> -->
                </div>
            </div>            
        </div>
    </div>
<nav class="navbar-main navbar-main-slide">
        <div class="menu_container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed"
                        data-toggle="collapse" data-target=".navbar-collapse1">
                    <span class="icon-bar menu_open_icon"></span> 
                    <span class="icon-bar menu_open_icon"></span> 
                    <span class="icon-bar menu_open_icon"></span> 
                </button>               
            </div>
            <div class="collapse navbar-collapse1 menu_content_container">
                <ul class="nav navbar-nav list home_navigation" >
                    <li @if($title == 'Jewelry Shop') class="active" @endif>
                        <a href="{{action('UserController@getIndex')}}" >Home</a>
                    </li>
                    <li @if($title == 'Collections') class="dropdown megamenu active" @else class="dropdown megamenu" @endif>
                        {{--<a href="{{URL::to('collection/collections')}}" >Collections<i class="fa fa-sort-desc dropdown-toggle collection_icon" --}}
                                                                                       {{--data-toggle="dropdown" aria-hidden="true"></i></a>--}}
                        <a href="{{URL::to('collection/collections')}}" class="dropdown-toggle collection-dropdown" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            Collections<i class="fa fa-sort-desc collection_icon"></i></a>
                        {{--<ul class="dropdown-menu collection-menu-drop">--}}
                            {{--<div class="mega-menu-content ">--}}
                                {{--<div class="row" >--}}
                                    {{--<div class="col-md-12 col-sm-12 col-xs-12 menu-column">--}}
                                        {{--@foreach($collections as $collection)--}}
                                            {{--<li class="col-md-2 col-sm-2 col-xs-2 coll">--}}
                                                {{--<a class="collection-a" href="{{URL::to('item/items',['collection', $collection->name, 'noSort'])}}">{{$collection->name}}</a>--}}
                                                {{--<img class="img-responsive collection-image" src="{{URL::asset('/uploads/'.$collection->image)}}" alt="" />--}}
                                                {{--<ul>--}}
                                                    {{--@foreach($collection->categories as $category)--}}
                                                        {{--<li>--}}
                                                            {{--<a href="{{URL::to('item/collection-categories',[$collection->name, $category->category, 'noSort'])}}">{{$category->category}}</a>--}}
                                                        {{--</li>--}}
                                                    {{--@endforeach--}}
                                                {{--</ul>--}}
                                            {{--</li>--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</ul>--}}
                        <div class="dropdown-menu collection-menu-drop">
                           <div class="mega-menu-content ">
                               <div class="row" >
                                   <div class="col-md-12 col-sm-12 col-xs-12 menu-column">
                                       <ul class="list-unstyled sub-menu header-sub-menu">
                                           @foreach($collections as $collection)
                                               <li class="col-md-2 col-sm-2 col-xs-2 coll">
                                                   <a class="collection-a" href="{{URL::to('item/items',['collection', $collection->name, 'noSort'])}}">{{$collection->name}}</a>
                                                   <img class="img-responsive collection-image" src="{{URL::asset('/uploads/'.$collection->image)}}" alt="" />
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
                                   </div>
                               </div>
                           </div>
                       </div>
                    </li>
                    <li @if($title == 'Necklaces jewelry') class="dropdown megamenu active" @else class='dropdown megamenu' @endif><a href="{{URL::to('item/items',['category', 'Necklaces', 'noSort'])}}">Necklaces<i class="fa fa-sort-desc collection_icon" aria-hidden="true"></i></a>
                        <div class="dropdown-menu">
                            <div class="mega-menu-content ">
                                <div class="row">
                                    <div class="col-md-6 menu-column">
                                        <div class="list-unstyled sub-menu header-sub-menu">
                                            <a class="braslet_link" href="{{URL::to('item/items-list',['category', 'Necklaces', 'with-gemstones', 'noSort'])}}">With Stones</a>
                                            <a href="{{URL::to('item/items-list',['category', 'Necklaces', 'without-gemstones', 'noSort'])}}">Without Stones</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li @if($title == 'Bracelets jewelry') class="dropdown megamenu active" @else class='dropdown megamenu' @endif><a href="{{URL::to('item/items',['category', 'Bracelets', 'noSort'])}}">Bracelets<i   class="fa fa-sort-desc braslet_icon" aria-hidden="true"></i></a>
                        <div class="dropdown-menu">
                            <div class="mega-menu-content ">
                                <div class="row">
                                    <div class="col-md-6 menu-column">
                                        <div class="list-unstyled sub-menu header-sub-menu">
                                            <a class="braslet_link" href="{{URL::to('item/items-list',['category', 'Bracelets', 'with-gemstones', 'noSort'])}}  ">With Stones</a>
                                            <a href="{{URL::to('item/items-list',['category', 'Bracelets', 'without-gemstones', 'noSort'])}}">Without Stones</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li @if($title == 'Earrings jewelry') class="dropdown megamenu active" @else class='dropdown megamenu' @endif><a href="{{URL::to('item/items',['category', 'Earrings', 'noSort'])}}">Earrings<i class="fa fa-sort-desc braslet_icon" aria-hidden="true"></i></a>
                        <div class="dropdown-menu">
                            <div class="mega-menu-content ">
                                <div class="row">
                                    <div class="col-md-6 menu-column">
                                        <div class="list-unstyled sub-menu header-sub-menu">
                                            <a class="braslet_link" href="{{URL::to('item/items-list',['category', 'Earrings', 'with-gemstones', 'noSort'])}}">With Stones</a>
                                            <a href="{{URL::to('item/items-list',['category', 'Earrings', 'without-gemstones', 'noSort'])}}">Without Stones</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li @if($title == 'Chains jewelry') class="active" @else @endif><a href="{{URL::to('item/items',['category', 'Chains', 'noSort'])}}" >Chains</a>
                    </li>
                    <li @if($title == 'Crosses & Rosaries | Jewelry Shop') class=" active" @else  @endif><a href="{{URL::to('item/items',['category', 'Crosses & Rosaries', 'noSort'])}}" >Crosses & Rosaries</a>
                    </li>
                    <li @if($title == 'Rings | Jewelry Shop') class="dropdown megamenu active" @else class='dropdown megamenu' @endif><a href="{{URL::to('item/items',['category', 'Rings', 'noSort'])}}">Rings<i class="fa fa-sort-desc braslet_icon" aria-hidden="true"></i></a>
                        <div class="dropdown-menu">
                            <div class="mega-menu-content ">
                                <div class="row">
                                    <div class="col-md-6 menu-column">
                                        <div class="list-unstyled sub-menu header-sub-menu">
                                            <a class="braslet_link" href="{{URL::to('item/items-list',['category', 'Rings', 'with-gemstones', 'noSort'])}}">With Stones</a>
                                            <a href="{{URL::to('item/items-list',['category', 'Rings', 'without-gemstones', 'noSort'])}}">Without Stones</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li @if($title == 'New arrivals jewelry') class=" active" @else @endif><a href="{{URL::to('item/new-arrivals','noSort')}}" >New Arrivals</a>
                    </li>
                    <!-- <li @if($title == 'Occasions | Jewelry Shop') class=" active" @else @endif><a href="{{URL::to('item/occasions','noSort')}}" >Occasions<t></t></a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
</div>


<!-- Begin Login -->
@if(Session::has('message_login') || Session::has('error_danger'))
<div class="login-wrapper open">
    <div class="alert alert-danger">
    {{Session::get('message_login')}}
    {{Session::get('error_danger')}}
    </div>
<?php Session::forget('message_login') ?>
<?php Session::forget('error_danger') ?>
@else
<div class="login-wrapper col-lg-12 col-md-12 col-xs-12 col-sm-12">
@endif
    @if(!Auth::user())
            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 pull-right">
            <a href="javascript:void(0);" class="close_modal">x</a>
        </div>
    {!! Form::open(['action' => ['UserController@postLogin'],  'files' => 'true' ]) !!}
        <h4>Login</h4>
        <p>If you're a member, login here.</p>
        @if(Session::has('message_login'))
            <div class="alert alert-danger">
                {{Session::get('message_login')}}
            </div>
        @endif
        <div class="form-group">
            <label for="inputemail">Email</label>
            <input type="email" class="form-control input-lg" id="inputemail" name = "email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="inputpassword">Password</label>
            <input type="password" class="form-control input-lg" id="inputpassword" name="password" placeholder="Password">
        </div>
        <ul class="list-inline">
            <li><a href="{{action('UserController@getRegistration')}}">Create new account</a></li>
            <li><a href="{{action('UserController@getForgetPassword')}}">Request new password</a></li>
        </ul>
        <ul class="list-inline">
            <li>
                <a data-toggle="tooltip" class="facebook-login-a" data-placement="top" title="Facebook" href="{{ action('UserController@getFacebookLogin') }}"><i class="fa fa-facebook facebook-login"></i></a>
            </li>
            <li>
                <a data-toggle="tooltip" class="twitter-login-a" data-placement="top" title="Twitter" href="{{ action('UserController@getTwitterLogin') }}"><i class="fa fa-twitter twitter-login"></i></a>
            </li>
            <li>
                <a data-toggle="tooltip" class="google-plus-login-a" data-placement="top" title="Google+" href="{{ action('UserController@getGoogleLogin') }}"><i class="fa fa-google-plus google-plus-login"></i></a>
            </li>
        </ul>
                 <label><input type="checkbox" name="remember_me">Remember me</label>
        <button type="submit" class="btn btn-white">Log in</button>
    {!! Form::close() !!}

    @else
        @if($user->image)
        <div class="col-md-3 col-md-3 col-sm-3 col-xs-3">
            <img class="img-responsive small-slides necles_headrer" src="{{URL::asset('/uploads/'.$user->image)}}"  alt="where to buy choker necklaces" />
        </div>
        @endif
        <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
        <a href="{{action('UserController@getAccountDashboard')}}">My Account</a>  <br />
        <a href="{{ action('UserController@getLogout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
        </div>
        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 pull-right">
            <a href="javascript:void(0);" class="close_modal">x</a>
        </div>
    @endif
    </div>
