@extends('admin.dashboard')
@section('scripts')
{!! HTML::script(asset('assets/js/reload_page.js')) !!}
@endsection

@section('content')

<link href="/assets/css/dropzone.css" rel="stylesheet" type="text/css" /> 
<!-- <div class="tab-content">
<div class="tab-pane active" id="tab_0"> -->
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Edit Article 
        </div>
        <div class="tools">
            <a href="{{URL::to('admin/blog/create-article')}}" style="color:white">Add </a>
        </div>
    </div>
</div>
    <div class="tabbable-bordered">
    <ul class="nav nav-tabs">
        <li id="info-tab">
            <a href="#tab_information" data-toggle="tab"> Information </a>
        </li>
        <li id="images-tab"> 
            <a href="#tab_images" data-toggle="tab"> Images </a>
        </li>
    </ul>

    @include('message')
    <div class="tab-content">
    <div class="tab-pane active" id="tab_information">
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        {!! Form::model($article, ['action' => ['Admin\BlogController@postEditArticle', $article->id], 'files' => 'true','class' => 'form-horizontal']) !!}
        
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Title</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control " value="{{$article->title}}" name="title" required="required" />
                        
                    </div>
                </div>

                
                <div class="form-group">
                    <label class="col-md-3 control-label">Content</label>
                    <div class="col-md-4">
                        <div class="input-icon">
                        <textarea class="form-control" rows="3" name="content" placeholder="Other information" required="required">{{$article->content}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Image Alt</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control " value="{{$article->alt}}" name="alt" required="required" />
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Video Link</label>
                    <div class="col-md-4">
                        <input type="url" class="form-control" placeholder="Link" name="video" /><br />
                        @if($article->video)
		                <iframe src='https://www.youtube.com/embed/{{$article->video}}'></iframe>
		                @endif
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
         {!!Form::close()!!} 
    </div>
</div>
    
<div class="tab-pane" id="tab_images">
    <input type="hidden" id="main_image" name="main_image">
    <input type="hidden" name="_token" id = "main_image_token" value="{{ csrf_token() }}">
    <div class="form-body" id="xoxo">
            <form action="{{action('Admin\BlogController@postUploadArticleImages')}}" class="dropzone edit-dropzone" id="my-awesome-dropzone-blog"> 
                    {!! csrf_field() !!}
                    <input type="hidden" class="article_id" name="article_id" value="{{$article->id}}" />
                    <div  class="fallback">
                        <input  name="file" type="file" multiple accept="image/*"/>
                    </div>
            </form>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr role="row" class="heading">
                        <th width="10%"> Image </th>                       
                        <th width="10%"> Main Image </th>
                        <th width="10%"> Remove Image </th>
                    </tr>
                </thead>
                <tbody>
                @if(count($article->BlogImages) > 0)
                    @foreach($article->BlogImages as $image)
                    <tr>    
                    <td>
                        <a href="{{URL::asset('/uploads/'.$image->name)}}" class="fancybox-button" data-rel="fancybox-button">
                            <img class="img-responsive" style="width:200px;" src="{{URL::asset('/uploads/'.$image->name)}}" alt=""> 
                        </a>
                    </td>
                    <td>                                            
                        <label class="radio-inline">
                            @if($image->id == $article->main_image)
                            <input checked="checked" class="main_image_radio" type="radio" name="main_image_id" value="{{$image->id}}"   style="cursor:pointer">
                            @else
                            <input type="radio" class="main_image_radio" name="main_image_id" value="{{$image->id}}" style="cursor:pointer">
                            @endif 
                        </label>
                    </td>
                    <td>
                        <a class="red show_modal imageId {{$image->id}}" data-id = "{{$image->id}}" data-name = "{{$image->name}}"><i class="glyphicon glyphicon-trash red" data-toggle="modal" href="#small"></i></a>
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
</div>

<div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Image </h4>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a data-dismiss="modal" href=""><button type="button" class="btn red delete-article-image">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/js/dropzone_blog.js"></script>
<script src="/assets/js/deletearticleimage.js"></script>
<script src="/assets/js/blog_main_image.js"></script>
@endsection