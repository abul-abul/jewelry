@extends('admin.dashboard') 
@section('content')
<link href="/assets/css/dropzone.css" rel="stylesheet" type="text/css" /> 
<div class="tab-content">
<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Create Article 
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/blog/create-article')}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
   @if(Session::has('errors'))
   @include('message')
   @else
   {{Session::forget('_old_input')}}
   @endif
        
    <div class="portlet-body form">
        {!! Form::open(['action' => ['Admin\BlogController@postCreateArticle'], 'files' => 'true','class' => 'form-horizontal col-md-7', 'role' => 'form', 'id' => 'create-article-form' ]) !!}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Title</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control " placeholder="Title" name="title" required="required" value="{{old('title')}}" />
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Content</label>
                    <div class="col-md-6">
                        <div class="input-icon">
                        <textarea class="form-control" rows="3" name="content" placeholder="Other information">{{old('content')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Image Alt</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control " placeholder="Alt" name="alt" required="required" value="{{old('alt')}}" />
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Video Link</label>
                    <div class="col-md-6">
                        <input type="url" class="form-control" placeholder="Link" name="video" />                       
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button id="image_upload" type="submit" class="btn green">Submit</button>
                        <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/blog/articles')}}">Cancel</a>
                    </div>
                </div>
            </div>
            <input type="hidden" id="main_image" name="main_image">
         {!!Form::close()!!} 
         <div class="col-md-5" style="float:right; margin-top: 15px;">
            <form action="{{action('Admin\BlogController@postUploadImages')}}" class="dropzone" id="my-awesome-dropzone-blog">
                    {!! csrf_field() !!}
                    
                    <div  class="fallback">
                        <input  name="file" type="file" multiple accept="image/*"/> 
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script src="/assets/js/dropzone_blog.js"></script>
@endsection