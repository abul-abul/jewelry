<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
    <li class="sidebar-toggler-wrapper hide">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler"> </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
    </li>
    <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
    <li class="sidebar-search-wrapper">
        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

        <!-- END RESPONSIVE QUICK SEARCH FORM -->
    </li>
    @if(isset($dashboardActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="{{ action('AdminController@getDashboard') }}" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>
    @if(isset($itemActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="glyphicon glyphicon-list"></i>
            <span class="title">Items</span>
            @if(isset($itemActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            @if(isset($itemsList))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/item/show-item-list', '1')}}" class="nav-link ">
                    <i class="glyphicon glyphicon-list"></i>
                    <span class="title">Item's list</span>
                </a>
            </li>
            @if(isset($createItem))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/item/create-item')}}" class="nav-link ">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span class="title">Create item</span>
                </a>
            </li>            
        </ul>
    </li>
    @if(isset($userActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-users"></i>
            <span class="title">Users</span>
            @if(isset($userActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            @if(isset($usersList))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/user/show-user')}}" class="nav-link ">
                    <i class="glyphicon glyphicon-user"></i>
                    <span class="title">User's list</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>
    @if(isset($collectionActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-puzzle"></i>
            <span class="title">Collections</span>
            @if(isset($collectionActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            @if(isset($collectionsList))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/collection/collections')}}" class="nav-link ">
                    <i class="icon-list"></i>
                    <span class="title">Collections</span>
                </a>
            </li>
            @if(isset($collectionCreate))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/collection/create-collection')}}" class="nav-link ">
                    <i class="icon-plus"></i>
                    <span class="title">Create collection</span>
                </a>
            </li>

        </ul>
    </li>
    @if(isset($categoryActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-bar-chart"></i>
            <span class="title">Categories</span>
            @if(isset($categoryActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            @if(isset($categoriesList))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/category/categories')}}" class="nav-link ">
                    <i class="icon-list"></i>
                    <span class="title">Categories</span>
                </a>
            </li>
            @if(isset($createCategory))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/category/create-category')}}" class="nav-link ">
                    <i class="icon-plus"></i>
                    <span class="title">Create Category</span>
                </a>
            </li>

        </ul>
    </li>
    <!-- <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-puzzle"></i>
            <span class="title">Gallery</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item start">
                <a href="" class="nav-link ">
                    <i class="glyphicon glyphicon-picture"></i>
                    <span class="title">Photo Gallery</span>
                </a>
            </li>
            <li class="nav-item start">
                <a href="" class="nav-link ">
                    <i class="glyphicon glyphicon-facetime-video"></i>
                    <span class="title">Video Gallery</span>
                </a>
            </li>
        </ul>
    </li> -->
    @if(isset($metalActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-puzzle"></i>
            <span class="title">Metals</span>
            @if(isset($metalActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            @if(isset($metalsList))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/metal/metals')}}" class="nav-link ">
                    <i class="icon-list"></i>
                    <span class="title">Metals</span>
                </a>
            </li>
            @if(isset($createMetal))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/metal/create-metal')}}" class="nav-link ">
                    <i class="icon-plus"></i>
                    <span class="title">Create Metal</span>
                </a>
            </li>
        </ul>
    </li>
    @if(isset($gemstoneActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-diamond"></i>
            <span class="title">Gemstones</span>
            @if(isset($gemstoneActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            @if(isset($gemstonesList))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/gemstone/gemstone')}}" class="nav-link ">
                    <i class="icon-list"></i>
                    <span class="title">Gemstones</span>
                </a>
            </li>
            @if(isset($createGemstone))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/gemstone/add-gemstone')}}" class="nav-link ">
                    <i class="icon-plus"></i>
                    <span class="title">Create Gemstone</span>
                </a>
            </li>
        </ul>
    </li>

    @if(isset($sliderActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-camera"></i>
            <span class="title">Sliders</span>
            @if(isset($sliderActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            @if(isset($slidersList))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/slider/sliders')}}" class="nav-link ">
                    <i class="icon-list"></i>
                    <span class="title">Sliders</span>
                </a>
            </li>
            @if(isset($createSlider))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/slider/create-slider')}}" class="nav-link ">
                    <i class="icon-plus"></i>
                    <span class="title">Create Slider</span>
                </a>
            </li>
        </ul>
    </li>
    @if(isset($blogActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-puzzle"></i>
            <span class="title">Blog</span>
            @if(isset($articleActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            <li class="nav-item start">
            @if(isset($articlesList))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/blog/articles/1')}}" class="nav-link ">
                    <i class="icon-list"></i>
                    <span class="title">Articles</span>
                </a>
            </li>
            <li class="nav-item start">
            @if(isset($createArticle))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/blog/create-article')}}" class="nav-link ">
                    <i class="icon-plus"></i>
                    <span class="title">Create article</span>
                </a>
            </li>

        </ul>
    </li>

@if(isset($homeActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-puzzle"></i>
            <span class="title">Home View</span>
            @if(isset($homeActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            <li class="nav-item start">
            @if(isset($gallery))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/gallery/gallery')}}" class="nav-link ">
                    <i class="icon-list"></i>
                    <span class="title">Gallery</span>
                </a>
            </li>
<!--             <li class="nav-item start">
            @if(isset($uploadImg))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/gallery/upload-img')}}" class="nav-link ">
                    <i class="icon-plus"></i>
                    <span class="title">Upload image</span>
                </a>
            </li> -->

        </ul>
    </li>   

    @if(isset($reviewActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif

        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-commenting" ></i>
            <span class="title" >Reviews    </span>
            @if($unseenReviewsCount > 0)
            <div class="unseen-reviews-count" style="border-radius: 50%!important; width: 20px;
            height: 20px;
            background: #A52323;
            border: 1px solid white;
            color:white;
            text-align: center;
            position: absolute;
            top:10px;
            margin-left: 40%;
            line-height: 15px;">{{$unseenReviewsCount}}</div> 
            @endif
            @if(isset($reviewActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            @if(isset($reviewsList))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{action('AdminController@getReviews', '1')}}" class="nav-link ">
                    <i class="fa fa-comments-o"></i>
                    <span class="title">Reviews List</span>
                </a>
            </li>
        </ul>
    </li>

    @if(isset($newsLetterActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif

        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-newspaper-o " ></i>
            <span class="title" >News Letter    </span>
            @if($subscriptionsCount > 0)
            <div style="border-radius: 50%!important; width: 20px;
            height: 20px;
            background: #A52323;
            border: 1px solid white;
            color:white;
            text-align: center;
            position: absolute;
            top:10px;
            margin-left: 50%;
            line-height: 15px;">{{$subscriptionsCount}}</div>
            @endif
            @if(isset($newsLetterActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            @if(isset($newsLetter))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{action('AdminController@getNewsLetter')}}" class="nav-link ">
                    <i class="fa fa-pencil "></i>
                    <span class="title">News Letter</span>
                </a>
            </li>
        </ul>
    </li> 

@if(isset($orderActive))
    <li class="nav-item start active open">
    @else
    <li class="nav-item">
    @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-puzzle"></i>
            <span class="title">Orders</span>
            @if($newOrdersCount > 0)
            <div  style="border-radius: 50%!important; width: 20px;
            height: 20px;
            background: #A52323;
            border: 1px solid white;
            color:white;
            text-align: center;
            position: absolute;
            top:10px;
            margin-left: 40%;
            line-height: 15px;">{{$newOrdersCount}}</div> 
            @endif
            @if(isset($orderActive))
            <span class="arrow open"></span>
            @else
            <span class="arrow"></span>
            @endif
        </a>
        <ul class="sub-menu">
            <li class="nav-item start">
            @if(isset($order))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/order/orders')}}" class="nav-link ">
                    <i class="icon-list"></i>
                    <span class="title">Orders</span>
                </a>
            </li>
<!--             <li class="nav-item start">
            @if(isset($uploadImg))
            <li class="nav-item start active open">
            @else
            <li class="nav-item start">
            @endif
                <a href="{{URL::to('admin/gallery/upload-img')}}" class="nav-link ">
                    <i class="icon-plus"></i>
                    <span class="title">Upload image</span>
                </a>
            </li> -->

        </ul>
    </li> 

</ul>


