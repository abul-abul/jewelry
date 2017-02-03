@extends('admin.dashboard')
<link href="/assets/css/dropzone.css" rel="stylesheet" type="text/css" /> 

@section('content')

<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Edit Gallery
        </div>
        <div class="tools">

            <a href="javascript:;" class="collapse"> </a>
            <a href=""><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    @include('message')
    <div class="portlet-body form">
            
@if($image->status != 'Collections')

<!-- BEGIN FORM--><div class="form-body">
                <div class="form-group">
                    <label><h3>{{$image->status}} Image:</h3></label>
                    
                </div>
            </div>
        {!! Form::open(['action' => ['Admin\GalleryController@postEditGallery', $image->id], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
        
            <input type="hidden" name="id" value="{{$image->id}}">
            <input type="hidden" name="status" value="{{$image->status}}">

            <div class="form-group">              
                <label class="col-md-3 control-label"></label>
                <div class="input-group col-md-4" >
                    <div class="form-group">              
                        <div class="input-group col-md-4" >
                            <input id="image" name="image" type="hidden" value="{{old('image')}}">
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

@else

<!-- COLLECTION GALLERY -->
<br />
{!! Form::open(['action' => ['Admin\GalleryController@postEditGallery', $image->id], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
        
            <input type="hidden" name="id" value="{{$image->id}}">
            <input type="hidden" name="status" value="{{$image->status}}">
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
         <div class="form-body">
                <div class="form-group">
                    <label><h3>{{$image->status}} Images:</h3></label>
                    
                </div>
            </div>
<div class="tab-pane" id="tab_images">
    <input type="hidden" id="main_image" name="main_image">
    <input type="hidden" name="_token" id = "main_image_token" value="{{ csrf_token() }}">
    <div class="form-body" id="xoxo">
            <form action="{{action('Admin\GalleryController@postUploadCollGalleryImages')}}" class="dropzone edit-dropzone" id="my-awesome-dropzone-blog">
                    {!! csrf_field() !!}
                    <input type="hidden" class="gallery_id" name="gallery_id" value="{{$image->id}}" />
                    <div  class="fallback">
                        <input  name="file" type="file" multiple accept="image/*"/>
                    </div>
            </form>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr role="row" class="heading">
                        <th width="10%"> Image </th>                       
                        <th width="10%"> Remove Image </th>
                    </tr>
                </thead>
                <tbody>
                @if(count($imgs) > 0)
                @foreach($imgs as $img)
                    <tr class="{{$img->id}}">    
                    <td>
                        <a href="{{URL::asset('/uploads/'.$img->name)}}" class="fancybox-button" data-rel="fancybox-button">
                            <img class="img-responsive" style="width:200px;" src="{{URL::asset('/uploads/'.$img->name)}}" alt=""> 
                        </a>
                    </td>
                
                    <td>
                        <a class="red show_modal imageId {{$image->id}}" data-id="{{$img->id}}" data-name="{{$img->name}}"><i class="glyphicon glyphicon-trash red" data-toggle="modal" href="#small"></i></a>
                    </td>
                    </tr>
                    @endforeach
                    @endif
                    <div class="added_image">
                    </div>  
                </tbody>
            </table>
        
    </div>
</div>
@endif
<div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Iamge </h4>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a data-dismiss="modal" href=""><button data-gallery="{{$image->id}}" type="button" class="btn red delete-gallery-image">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
{!! HTML::script(asset('assets/js/file-upload.main.js')) !!}
<script src="/assets/js/dropzone_collgallery.js"></script>
<script src="/assets/js/deletecollgalleryimage.js"></script>
@endsection