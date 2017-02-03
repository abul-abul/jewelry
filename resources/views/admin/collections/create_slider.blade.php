@extends('admin.dashboard')

@section('style')
	{!! HTML::style( asset('assets/js/cropper-master/dist/cropper.css')) !!}
    {!! HTML::style( asset('assets/js/cropper-master/demo/css/main.css')) !!}
@endsection

@section('scripts')
	{!! HTML::script(asset('assets/js/file-upload.main.js')) !!}
	{!! HTML::script(asset('assets/js/tinymce/tinymce.min.js')) !!}
	{!! HTML::script(asset('assets/js/cropper-master/dist/cropper.js')) !!} 
    {!! HTML::script(asset('assets/global/plugins/ckeditor/ckeditor.js')) !!} 
    <script type="text/javascript">
        tinymce.init({
            selector: "#description"
        });
    </script>
@endsection

@section('content')
<div class="tab-content">
<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Create Slider</div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/slider/create-slider')}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    @if ($errors->has('description') || $errors->has('image'))
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
            {!! Form::open(['action' => ['Admin\SliderController@postCreateSlider'], 'files' => 'true','class' => 'form-horizontal', 'role' => 'form' ]) !!}
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-1 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="description" rows="3" width="100px" data-error-container="#editor2_error"></textarea>
                            <div id="editor2_error"> </div>
                        </div>
                    </div>
                    <div class="form-group">              
                        <label class="col-md-3 control-label">Image</label>
                        <div class="input-group col-md-4" >
                            <div class="input-group col-md-12" > 
                                <input id="image" name="image" type="hidden" value="{{old('image')}}">
                            </div>
                            @if(old('image'))
                            <label class="input-group col-md-8 " for="input_24" id="imag_slider">                   
                                <img src="{{URL::asset('/uploads/'.old('image'))}}" class="img-rounded " alt="Cinque Terre" width="50%"> <br>      
                            </label>
                            @else
                            <label class="input-group col-md-8 " for="input_24" id="imag_slider">                   
                                <img src="{{URL::asset('/seederImg/select_file.PNG')}}" class="img-rounded " alt="Cinque Terre" width="100%"> <br>      
                            </label>
                            @endif
                        </div>            
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image Alt</label> 
                        <div class="input-group col-md-3">
                            <input type="text" class="form-control" placeholder="Alt" name="alt" maxlength="60" value="{{ old('alt') }}"/>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Submit</button>
                                <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/slider/sliders')}}">Cancel</a> 
                            </div>
                        </div>
                    </div>
                </div>
             {!!Form::close()!!} 
            <input id="input_24" name="image_name" type="file" class="file-loading" accept="image/*" style="display:none">
            <input type='hidden' id="token" value="{{csrf_token()}}">              
        </div>
    </div>
</div>
</div>
<?php Session::forget('errors') ?>
@endsection
