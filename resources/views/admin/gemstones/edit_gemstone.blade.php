@extends('admin.dashboard')
@section('content')

<div class="tab-content">
<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Edit Gemstone
            </div>
        <div class="tools">
            <a href="{{URL::to('admin/gemstone/add-gemstone', $gemstone->id)}}" style="color:white">Add</a>
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/metal/edit-gemstone', $gemstone->id)}}"><i class="icon-refresh" style="color: white"></i> </a>
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
        {!! Form::model($gemstone, ['action' => ['Admin\GemstoneController@postEditGemstone'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
            <div class="form-body">
                <div class="form-group">              
                    <b><label class="col-md-3 control-label">Name</label></b>
                    <div class="input-group col-md-4" >
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required',  ]) !!}               
                    </div>
                                                                
                    <input type="hidden"  name="id" value="{{$gemstone->id}}"></input>
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
                        <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/gemstone/gemstones')}}">Cancel</a>
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