@extends('admin.dashboard')
@section('content')

<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Create Gemstone</div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/gemstone/add-gemstone')}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    @include('message')
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        {!! Form::open(['action' => ['Admin\GemstoneController@postAddGemstone'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Name" name="name" required="required" /> 
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">Submit</button>
                        <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/gemstone/gemstone')}}">Cancel</a>
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