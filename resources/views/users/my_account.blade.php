@extends('layouts.app')
@section('css')
{!! HTML::style( asset('new-css/account.css')) !!}
@endsection
@section('script')
 <script type="text/javascript">


   $(document).ready(function () {
    // Handler for .ready() called.
    // var message = '@Session["message"]';
    // var password = '@Session["password"]';
    // var passwordConfiramtion = '@Session["passwordConfiramtion"]';
    // password = jQuery.trim(password);
    // message = jQuery.trim(message);
    // passwordConfiramtion = jQuery.trim(passwordConfiramtion);
    if($('.sessionCheck').val() == 1)
    {
     console.log('message');   
      $('html, body').animate({
          scrollTop: $('#message').offset().top
      }, 'slow');

    }
});
 </script>
@endsection
@section('content')

<div role="main" class="main">
    <section class="page-top" >

    </section>   
    <div class="container">
        <div class="row">
                <div class="catalog">
                    <div class="toolbar clearfix">
                        <label class="account-title">EDIT ACCOUNT INFORMATION</label>
                    </div>
                </div> 
                <div class="col-md-12 col-md-offset-1">
                    <div class="account-menu col-md-3">
                        <ul class="list-unstyled content-submenu">
                            <li><a href="{{action('UserController@getAccountDashboard')}}" >ACCOUNT DASHBOARD</a></li>
                            <li class="active">ACCOUNT INFORMATION</li>
                            <li><a href="{{action('UserController@getAddressBook')}}">ADDRESS BOOK</a></li>
                            <li><a href="{{URL::to('order/ordered-items')}}">MY ORDERS</a></li>
                            <li><a href="{{URL::to('favorites/favorites')}}">MY FAVORITES</a></li>
                        </ul>
                    </div>
                <div class="account-content col-md-7">
                    <div class="content-title ">
                        ACCOUNT INFORMATION
                    </div>
                    <div class="account-info">
                        {!! Form::model($user,['action' => ['UserController@postEditAccount', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => 'true' ]) !!}
                    {!! Form::hidden('id', $user->id) !!}
                        <div class="form-group col-md-4">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div>
                                    <span class="btn btn-file">
                                    @if($user->image)
                                        <img class="fileinput-new " src="{{URL::asset('/uploads/'.$user->image)}}" style="width: 200px; height: 150px;" alt="" /> 
                                    @else
                                        <img class="fileinput-new thumbnail" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                    @endif
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="image"> 
                                    </span>
                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-8 " style="margin-left: 45px;">
                       @if($errors->has('firstName') || $errors->has('lastName') || $errors->has('Email') || Session::has('account_message') || Session::has('acoount_error'))
                       <div class="errors">
                       @include('message')  
                       </div>
                       @endif
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="firstName">First Name<b style="color:red; font-size: 1.8em">*</b></label>
                                    <input name="firstName" type="text" id="name" class="form-control" value="{{$user->first_name}}" required>
                                </div>
                                <div class="col-xs-12">
                                    <label for="lastName">Last Name<b style="color:red; font-size: 1.8em">*</b></label>
                                    <input name="lastName" type="text" id="customer_mail" class="form-control" value="{{$user->last_name}}" required>
                                </div>
                                <div class="col-xs-12">
                                    <label for="Email">Email<b style="color:red; font-size: 1.8em">*</b></label>
                                    <input name="Email" type="text" id="customer_mail" class="form-control" value="{{$user->email}}" required>
                                </div>

                            </div>
                        </div>
                        <div class=" col-md-offset-4">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div><br />
                        {{ Form::close()}}
                    </div>
                    <div class="content-title">CHANGE PASSWORD</div>
                    <div class="account-info">
                    <div class="col-md-offset-4" id="message">
                    <input class="sessionCheck" type="hidden" @if(Session::has('passwordMessage') || $errors->has('new_password_confirmation') || $errors->has('password')) value="1" @else value="0" @endif >
                            @if ($errors->has('new_password_confirmation') || $errors->has('new_password'))
                            
                            @include('message')
                            
                            @endif
                            @if(Session::has('passwordMessage'))
                                <div class="alert alert-success">
                                    {{Session::get('passwordMessage')}}
                                </div>

                            <?php Session::forget('passwordMessage') ?> 
                            @endif
                            </div>
                            {!! Form::open(['action' => ['UserController@postChangePassword', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => 'true' ]) !!}
                                <div class="form-group">
                                    <label class="col-md-4">New password</label>
                                    <div class="col-md-6">
                                        {!! Form::password('new_password', ['class' => 'form-control' ]) !!}<br>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">Confirm Password</label>
                                    <div class="col-md-6">
                                        {!! Form::password('new_password_confirmation', ['class' => 'form-control' ]) !!}<br>
                                        {!! Form::submit('Change Password', array('class' => 'btn btn-default')) !!}<br>
                                    </div>
                                </div>
                            {{ Form::close()}}
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