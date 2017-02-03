@extends('layouts.app')

@section('content')
{!! HTML::style( asset('new-css/new-password.css')) !!}
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <label class="col-md-2 control-label"></label>
        @if ($errors->has('new_password_confirmation') || $errors->has('new_password'))               
                	@include('message')              
                @endif
                @if(Session::has('passwordMessage'))
                    <div class="alert alert-success">
                        {{Session::get('passwordMessage')}}
                    </div>

                <?php Session::forget('passwordMessage') ?> 
                @endif
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                
                <div class="panel-body">
                    {!! Form::open(['action' => ['UserController@postChangePassword',$id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => 'true' ]) !!}
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                    <label class="col-md-4 control-label">New password</label>
	                    <div class="col-md-6">
	                        {!! Form::password('new_password', ['class' => 'form-control' ]) !!}<br>
	                        <!-- @if ($errors->has('password'))
	                            <span class="help-block">
	                            <strong>{{ $errors->first('password') }}</strong>
	                            </span>
	                        @endif -->
	                    </div>
	                </div>
	                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	                    <label class="col-md-4 control-label">Confirm Password</label>
	                    <div class="col-md-6">
	                        {!! Form::password('new_password_confirmation', ['class' => 'form-control' ]) !!}<br>
	                        <!-- @if ($errors->has('password_confirmation'))
	                            <span class="help-block">
	                            <strong>{{ $errors->first('password_confirmation') }}</strong>
	                            </span>
	                        @endif -->
	                        
	                    </div>
	                </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit('Change Password', array('class' => 'btn btn-default')) !!}<br>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection