@extends('admin.dashboard')

@section('scripts')
{!! HTML::script(asset('assets/js/file-upload.main.js')) !!}
@endsection

@section('content')

<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Edit Gallery
        </div>
        <div class="tools">


            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/gallery/upload-img')}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    @include('message')
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        {!! Form::open(['action' => ['Admin\GalleryController@postEditGallery'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
        
            <div class="form-body">
                <div class="form-group">
                    <label><h3>{{$image->status}} Image:</h3></label>
                    <div class="input-group col-md-4">
                        <input type="hidden" name="id" value="{{$image->id}}"></input>
                        
                    </div>
                </div>
            </div>
            <div class="form-group">              
                <label class="col-md-3 control-label"></label>
                <div class="input-group col-md-4" >
                    <div class="form-group">              
                        <div class="input-group col-md-4" >
                            <input id="image" name="image" type="hidden">
                        </div>
                        <label class="input-group col-md-8" for="input_24" id="imag_slider">
                            @if($image->image == '')
                            <img src="{{URL::asset('/seederImg/select_file.PNG')}}"  class="img-rounded show-image" alt="Cinque Terre" width="100%" height="auto">           
                            @else
                            <img src="/uploads/{{$image->image}}"  class="img-rounded show-image" alt="Cinque Terre" width="100%" height="auto">
                            @endif
                        </label>                 
                    </div>
                </div>
            </div>
            <div class="form-group">              
                <label class="col-md-3 control-label"><h3>Image Alt</h3></label>
                <div class="input-group col-md-3" >
                    <input type="text" class="form-control" placeholder="Alt" name="alt" required="required" value="{{$image->alt}}" />             
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn  green">Submit</button>
                        <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/gallery/gallery')}}">Cancel</a>
                    </div>
                </div>
            </div>

         {!!Form::close()!!} 
        <!-- END FORM-->
        <input id="input_24" name="image_name" type="file" accept="image/*" class="file-loading" style="display:none">
        <input type='hidden' id="token" value="{{csrf_token()}}">  

    </div>
</div>
</div>

@endsection