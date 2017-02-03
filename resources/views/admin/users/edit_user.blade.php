@extends('admin.dashboard')
@section('content')
<div class="tab-content">
<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Edit User 
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/user/edit-user', $user->id)}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    @if (Session::has('errorMessages'))
    	@include('message')
    @endif
    @if(Session::has('success'))
	    <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>Success!</strong>
            {{ Session::get('success') }}
    	</div>
	@endif
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
         {!! Form::model($user, ['action' => ['Admin\UserController@postEditUser'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
            <div class="form-body">

								<div class="form-group">              
		                            <label class="col-md-3 control-label">First Name</label>
		                            <div class="input-group col-md-4" >
		                            	{!! Form::text('first_name', null, ['class' => 'form-control input-circle', 'required' => 'required',  ]) !!}   
		                            </div>            
	                      		</div>

								<div class="form-group">              
		                            <label class="col-md-3 control-label">Last Name</label>
		                            <div class="input-group col-md-4" >
		                           		{!! Form::text('last_name', null, ['class' => 'form-control input-circle', 'required' => 'required',  ]) !!}  
		                            </div>             
	                      		</div>
								<div class="form-group">              
		                            <label class="col-md-3 control-label">E-mail</label>
		                            <div class="input-group col-md-4" >
		                            	{!! Form::email('email', null, ['class' => 'form-control input-circle', 'required' => 'required',  ]) !!}    
		                            </div>           
	                      		</div>
								<div class="form-group">              
		                            <label class="col-md-3 control-label">Country</label>
		                            <div class="input-group col-md-4" >
		                            {!! Form::text('country', null, ['class' => 'form-control input-circle' ]) !!}               
	                      			</div>
	                      		</div>	
								<div class="form-group">              
		                            <label class="col-md-3 control-label">City</label>
		                            <div class="input-group col-md-4" >
		                            {!! Form::text('city', null, ['class' => 'form-control input-circle' ]) !!}               
	                      			</div>
	                      		</div>
	                      		<div class="form-group">              
		                            <label class="col-md-3 control-label">State</label>
		                            <div class="input-group col-md-4" >
		                            	{!! Form::text('state', null, ['class' => 'form-control input-circle']) !!}   
		                            </div>            
	                      		</div>
	                      		<div class="form-group">              
		                            <label class="col-md-3 control-label">Address</label>
		                            <div class="input-group col-md-4" >
		                            {!! Form::text('address', null, ['class' => 'form-control input-circle', 'required' => 'required']) !!}               
	                      			</div>
	                      		</div>
	                      		<div class="form-group">
		                            <label class="col-md-3 control-label">Postal Code</label>
		                            <div class="input-group col-md-4">
                                   		{!! Form::number('postal_code', null, ['class' => 'form-control input-circle', 'required' => 'required' ]) !!}                         	 
		                            </div>
		                        </div>
		                        <div class="form-group">              
		                            <label class="col-md-3 control-label">Phone Number</label>
		                            <div class="input-group col-md-4" >
		                            	{!! Form::text('phone_number', null, ['class' => 'form-control input-circle', 'required' => 'required',  ]) !!}   
		                            </div>            
	                      		</div>

		                        <input type="hidden"  name="id" value="{{$user->id}}"></input>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-circle green">Submit</button>
                        <a type="button" class="btn btn-circle grey-salsa btn-outline" href="{{URL::to('admin/user/show-user')}}">Cancel</a>
                    </div>
                </div>
            </div>
         {!!Form::close()!!} 
        <!-- END FORM-->
    </div>
</div>
</div>
</div>

@endsection
