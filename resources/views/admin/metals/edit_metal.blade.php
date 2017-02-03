@extends('admin.dashboard')
@section('content')
<div class="tab-content">
<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Edit Metal
            </div>
        <div class="tools">
            <a href="{{URL::to('admin/metal/create-metal', $metal->id)}}" style="color:white">Add</a>
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/metal/edit-metal', $metal->id)}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    @include('message')
    @if(Session::has('success'))
	    <div class="alert alert-success alert-dismissable">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	        <strong>Success!</strong>
	        {{ Session::get('success') }}
		</div>
	@endif
	<div class="portlet-body form">
        <!-- BEGIN FORM-->
        {!! Form::model($metal, ['action' => ['Admin\MetalController@postEditMetal'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
            <div class="form-body">
            	<div class="form-group">              
                    <b><label class="col-md-3 control-label">Name</label></b>
                    <div class="input-group col-md-4" >
                    <!-- {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required',  ]) !!}                -->
                    <input type="text" class="form-control" placeholder="Name" name="name" required="required" value="{{$metal->name}}"/>
          			</div>
		                     			                        
		            <input type="hidden"  name="id" value="{{$metal->id}}"></input>
		        </div>
<!--                 <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-4">
                    <input type="text" class="form-control input-circle" placeholder="Name" name="name" required="required" />
                    </div>
                </div> -->
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">Submit</button>
                        <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/metal/metals')}}">Cancel</a>
                    </div>
                </div>
            </div>
         {!!Form::close()!!} 
        <!-- END FORM-->
    </div>
</div>
</div>

@endsection
@section('script')
@stop