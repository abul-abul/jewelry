@extends('admin.dashboard')

@section('scripts')
{!! HTML::script(asset('assets/js/file-upload.main.js')) !!}
@endsection

@section('content')

<div class="tab-content">
<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Create Collection</div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/collection/create-collection')}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
@if ($errors->has('name') || $errors->has('description') || $errors->has('image') || $errors->has('alt'))
<div class="col-sm-8">
    <div class="alert alert-danger">
       @foreach ($errors->all() as $error) 
           {{ $error }}<BR>       
       @endforeach
   </div>  
</div>
@else
{{Session::forget('_old_input')}}
@endif
    <div class="portlet-body form">
        {!! Form::open(['action' => ['Admin\CollectionController@postCreateCollection'], 'files' => 'true','class' => 'form-horizontal', 'role' => 'form' ]) !!}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label> 
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Name" name="name" maxlength="60" value="{{ old('name') }}"/>
                        
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Description</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <textarea class="form-control" rows="3" cols="40" name="description" placeholder="Other information" >{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">              
                    <label class="col-md-3 control-label">Image</label>
                    <div class="input-group col-md-4" >          
                        <div class="input-group col-md-5" >
                            <input id="image" name="image" type="hidden" value="{{old('image')}}">
                        </div>
                        @if(old('image')) 
                        <label style="margin-left: 15px" class="input-group col-md-8" for="input_24" id="imag_slider">
                            <img src="{{URL::asset('/uploads/'.old('image'))}}"  class="img-rounded show-image" alt="Cinque Terre" width="100%">           
                        </label>
                        @else
                        <label style="margin-left: 15px" class="input-group col-md-8" for="input_24" id="imag_slider">
                            <img src="{{URL::asset('/seederImg/select_file.PNG')}}"  class="img-rounded show-image" alt="Cinque Terre" width="100%">           
                        </label>
                        @endif                                     
                    </div>                                       
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Image Alt</label> 
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Alt" name="alt" maxlength="60" value="{{ old('alt') }}"/>
                    </div>
                </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn  green">Submit</button>
                        <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/collection/collections')}}">Cancel</a>
                    </div>
                </div>
            </div>
         {!!Form::close()!!} 
        <input id="input_24" name="image_name" type="file" accept="image/*" class="file-loading" style="display:none">
        <input type='hidden' id="token" value="{{csrf_token()}}">  
    </div>
</div>
</div>
</div>
<?php Session::forget('errors') ?>
@endsection
