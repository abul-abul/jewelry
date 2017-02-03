@extends('layouts.app')
@section('css')
{!! HTML::style( asset('new-css/account.css')) !!}
@endsection
@section('content')
<div role="main" class="main">
    <section class="page-top" >

    </section>  
    <div class="container">
        <div class="row">
                <div class="catalog">
                    <div class="toolbar clearfix">
                        <label class="account-title">HELLO, {{$user->first_name}} {{$user->last_name}} !</label>
                    </div>
                </div>
                @if(Session::has('activationMessage'))
                <div class="alert alert-success col-md-offset-5 col-md-3">
                    {{Session::get('activationMessage')}}
                </div>
                <?php Session::forget('activationMessage') ?>
                @endif
                <div class="col-md-12 col-md-offset-1">
                    <div class="account-menu col-md-3">
                        <ul class="list-unstyled content-submenu">
                            <li class="active">ACCOUNT DASHBOARD</li>
                            <li><a href="{{action('UserController@getMyAccount')}}">ACCOUNT INFORMATION</a></li>
                            <li><a href="{{action('UserController@getAddressBook')}}">ADDRESS BOOK</a></li>
                            <li><a href="{{URL::to('order/ordered-items')}}">MY ORDERS</a></li>
                            <li><a href="{{URL::to('favorites/favorites')}}">MY FAVORITES</a></li>
                        </ul>
                    </div>

                    <div class="account-content col-md-7">
                        <div class="content-title ">ACCOUNT INFORMATION</div>
                        <div class="account-info">
                            <div class="address col-md-12">
                                <div class="col-md-6">
                                    <label><b>Contact Information</b></label>
                                    <p>{{$user->first_name}} {{$user->last_name}}<br />
                                    {{$user->email}}</p>

                                </div>
                                <div class="form-group">
                                <a href="{{action('UserController@getMyAccount')}}">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                                </a>
                                </div>
                            </div>
                            <div class=" shipping_address col-md-12">
                                <div class="col-md-5">
                                    <label><b>Shipping Address</b></label>
                                    <p>
                                        {{$user->address}} <br />
                                        {{$user->city}}, {{$user->postal_code}} <br />
                                        {{$user->country}} <br />
                                        {{$user->phone_number}} <br />
                                    </p>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                <a href="{{action('UserController@getAddressBook')}}">
                                    <button type="submit" class="btn btn-primary btn-sm ship_edit">Edit</button>
                                </a>
                                </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<br />
<br />

@endsection