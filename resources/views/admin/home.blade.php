@extends('admin.dashboard')
@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> Home
    </h3>
    <!-- END PAGE TITLE-->

    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="{{URL::to('admin/user/show-user')}}">
                <div class="visual">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$userCount}}">{{$userCount}}</span>
                    </div>
                    <div class="desc"> Users </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="{{URL::to('admin/item/show-item-list/1')}}">
                <div class="visual">
                    <i class="fa fa-list"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$itemCount}}">{{$itemCount}}</span>
                    </div>
                    <div class="desc"> Item's</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="{{URL::to('admin/collection/collections')}}">
                <div class="visual">
                    <i class="fa fa-diamond"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$collectionCount}}">{{$collectionCount}}</span>
                    </div>
                    <div class="desc"> Collections </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="{{URL::to('admin/category/categories')}}">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$categoryCount}}">{{$categoryCount}}</span>
                    </div>
                    <div class="desc"> Category </div>
                </div>
            </a>
        </div>
    </div>
@endsection
