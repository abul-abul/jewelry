@extends('admin.dashboard')
@section('content')
@section('style')
	{!! HTML::style( asset('assets/js/cropper-master/dist/cropper.css')) !!}
    {!! HTML::style( asset('assets/js/cropper-master/demo/css/main.css')) !!}
@endsection



<div class="tab-content">
    <div class="tab-pane active" id="tab_0">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Edit Slider
                </div>
                <div class="tools">
                    <a href="{{URL::to('admin/slider/create-slider')}}" style="color: white">  Add</a>
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="{{URL::to('admin/slider/edit-slider', $slider->id)}}"><i class="icon-refresh" style="color: white"></i> </a>
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

                {!! Form::open(['action' => ['Admin\SliderController@postEditSlider'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
                <div class="form-body">
              		<div class="form-group">
                        <label class="col-md-1 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="description" rows="3" width="100px" data-error-container="#editor2_error">{{$slider->description}}</textarea>
                            <div id="editor2_error"> </div>
                        </div>
                    </div>
                    <br /><br />
        			<div class="form-group">              
                        <label class="col-md-3 control-label">Image</label>
                        <div class="input-group col-md-4" >
                        	<input id="image" name="image" type="hidden">
                        </div>
                        <label class="input-group col-md-8" for="input_24" id="imag_slider">
                        	@if($slider->image == '')
                        	<img src="{{URL::asset('/seederImg/select_file.PNG')}}" width="330" height="105" class="img-rounded show-image" alt="Cinque Terre" width="204" height="136">           
              				@else
              				<img src="/uploads/{{$slider->image}}" width="330" height="105" class="img-rounded show-image" alt="Cinque Terre" width="204" height="136">
              				@endif
              			</label>                 
              		</div>
                    <div class="form-group">              
                        <b><label class="col-md-2 control-label">Image Alt</label></b>
                        <div class="input-group col-md-3" >
                            <input type="text" class="form-control" placeholder="Alt" name="alt" required="required" value="{{$slider->alt}}" />             
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
                    <input type="hidden" value = "{{$slider->id}}" name="slider_id">
                 {!!Form::close()!!} 
                    <!-- END FORM-->
                    <input id="input_24" name="image_name" type="file" accept="image/*" class="file-loading" style="display:none">
                    <input type='hidden' id="token" value="{{csrf_token()}}">  
                </div>
            </div>
        </div>
    </div>
</div>
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