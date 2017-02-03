@extends('admin.dashboard')

@section('scripts')
{!! HTML::script(asset('assets/js/ring_size.js')) !!}
{!! HTML::script( asset('assets/js/bootstrap-tag-cloud.js')) !!}
{!! HTML::script(asset('assets/js/reload_page.js')) !!}
{!! HTML::script(asset('assets/js/video_upload.js')) !!}
{!! HTML::script(asset('assets/js/check_all.js')) !!}
{!! HTML::script(asset('assets/js/delete_images.js')) !!}
@endsection

@section('content')
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" /> 
<link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico" />

<link href="/assets/css/dropzone.css" rel="stylesheet" type="text/css" />


<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Edit Item
        </div>
        <div class="tools">
            <a href="{{URL::to('admin/item/create-item')}}" style="color: white">  Add </a> /
            <a data-toggle="modal" href="#imageList" style="color: white">  Delete Images </a>
            <a href="{{URL::to('admin/item/edit-item', $item->slug)}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    <div class="col-sm-8">
        @include('message')
    </div>
</div>
<div class="tabbable-bordered">
    <ul class="nav nav-tabs">
        <li id="info-tab" >
            <a href="#tab_information" data-toggle="tab"> Information </a>
        </li>
        <li id="images-tab">
            <a href="#tab_images" data-toggle="tab"> Images </a>
        </li>
        <li  id="video-tab">
            <a href="#tab_videos" data-toggle="tab"> Videos</a>
        </li>
    </ul>
    <div class="tab-content">
            <div class="tab-pane" id="tab_information">
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                {!! Form::model($item, ['action' => ['Admin\ItemController@postEditItem'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
                <div class="form-body">
                    <div class="tab-active" id="tab_information">
                    <div class="form-group">              
                        <label class="col-md-3 control-label" >Title</label>
                        <div class="input-group col-md-4" >
                            <input type="text" class="form-control" name="title" required="required" maxlength="40" value="{{$item->title}}" />              
                        </div>
                    </div>

                    <div class="form-group">              
                        <label class="col-md-3 control-label" >SKU</label>
                        <div class="input-group col-md-4" >
                            <input type="text" class="form-control" name="subtitle" value="{{$item->subtitle}}" required="required"/>              
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Price</label>
                        <div class="input-group col-md-4">
                            <span class="input-group-addon">
                                <i class="fa fa-dollar font-green"></i>
                            </span>
                            <input type="number" class="form-control" name="price" value="{{$item->price}}" required="required" min="0" />                        	 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Discount</label>
                        <div class="input-group col-md-4">
                            <span class="input-group-addon">
                            <i class="font-green"></i>
                            </span>
                            <input type="number" class="form-control" name="discount" value="{{$item->discount}}" required="required" min="0" max="99" /> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Quantity</label>
                        <div class="input-group col-md-4">
                            <input type="number" class="form-control" name="quantity" value="{{$item->quantity}}" required="required"/> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Status</label>
                        <div class="input-group col-md-4">
                            {!! Form::select('status',['Available' =>'Available', 'Coming Soon' =>'Coming Soon', 'Out of the store' =>'Out of the store' ], null ,array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category</label>
                        <div class="input-group col-md-4" >		                                
                            @if(count($categories) > 0)
                            {!! Form::select('category_id', $categories, null ,array('class' => 'form-control', 'id' => 'category', 'size' => '{{$item->size}}')) !!} 
                            @else   
                            <option value="0" default>None</option>
                            @endif	<br /><br />	
                            <div class="ring_size" @if($item->category->category == 'Rings') style="display: flex" @else style="display: none" @endif>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Size</label>
                                    <div class="col-md-6">
                                        <input type="hidden" name="size_check" id="size_check">                      
                                        <div class="icheck-list">
                                            @foreach($sizes as $size)
                                            <div class="portlet-body form">
                                                <div class="tab-pane active" id="portlet_tab_1_1">
                                                    <label>
                                                        <input id="size_checkbox" type="checkbox" class="icheck size_checkbox" data-checkbox="icheckbox_flat-grey" name="size_checkbox[]" value="{{$size}}" @if(in_array($size, $sizeArr)) checked @endif>{{$size}}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach 
                                        </div> 
                                    </div>
                                </div>
                            </div>                                
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Collections</label>
                        <div class="input-group col-md-4">	   
                            <select class="form-control spinner" name="collection_id">
                                <option value="0">None</option>
                                @if(count($collections) > 0)
                                @foreach($collections as $collection)
                                <option value="{{$collection->id}}" @if($collection->id == $item->collection_id) selected @endif>{{$collection->name}}</option>
                                @endforeach   
                                @endif     
                            </select>	                                
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Metal</label>
                    <div class="input-group col-md-4"> 
                     @if(count($metals) > 0)                
                        <div class="icheck-list">
                            @foreach($metals as $metal)
                            <div class="portlet-body form"> 
                                <div class="tab-content">
                                <div class="tab-pane active" id="portlet_tab_1_1">
                                    <label>
                                    <input id="metal_checkbox" type="checkbox" class="icheck metal_checkbox" data-checkbox="icheckbox_flat-grey" name="metal_checkbox[]" value="{{$metal->id}}" data-checked = "unchecked" @if(in_array($metal->id, $items_metals)) checked @endif>{{$metal->name}}
                                    </label>
                                </div> 
                                </div>
                            </div>
                            @endforeach 
                        </div>
                        @else

                        <option value="0" default>None</option>
                        @endif  
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Gemstone</label>
                    <div class="input-group col-md-4">                  
                        @if(count($gemstones) > 0)
                        <div class="icheck-list">
                            @foreach($gemstones as $gemstone)
                            <div class="portlet-body form">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="portlet_tab_1_1">
                                        <label>
                                        <input id="gemstone_checkbox" type="checkbox" class="icheck gemstone_checkbox" data-checkbox="icheckbox_flat-grey" name="gemstone_checkbox[]" value="{{$gemstone->id}}" data-checked = "unchecked" @if(in_array($gemstone->id, $items_gemstones)) checked @endif>{{$gemstone->name}}
                                            <!-- {!! Form::checkbox('gemstone_checkbox[]', $gemstone->id, in_array($gemstone->id, $items_gemstones), array('class' => 'icheck gemstone_checkbox', 'id' => 'gemstone_checkbox', 'data-checkbox' => 'icheckbox_flat-grey')) !!} {{$gemstone->name}} -->
                                        </label>
                                    </div> 
                                </div>
                            </div>
                            @endforeach 
                        </div>
                        @else

                        <option value="0" default>None</option>
                        @endif  
                    </div>
                </div>
                <div class="form-group">              
                        <label class="col-md-3 control-label" >Image Alt</label>
                        <div class="input-group col-md-4" >
                            <input type="text" class="form-control" name="alt" required="required" maxlength="60" value="{{$item->alt}}" />              
                        </div>
                    </div>
                <input type="hidden" name="tags[]" id="tagsArr" />
                <div class="form-group">
                    <label class="col-md-3 control-label">Search tags</label>
                    <div class="input-group col-md-4">
                        <div id="tag-info" class="input-append">
                            <input id="item_tag" type="text">
                            <button class="btn add_tag" type="button">Add <i class="icon-plus"></i></button>
                        </div>
                        <ul id="tag-cloud">
                            @foreach($item->tags as $tag)
                            <li class="tag-cloud tag-cloud-info" data-id="{{$tag->id}}">
                                {{$tag->name}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-md-3 control-label">Meta Title:</label>
                    <div class="input-group col-md-4">
                        {!! Form::text('meta_title', null, ['class' => 'form-control']) !!}
                        <span class="help-block"> max 100 chars </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Meta Keywords:</label>
                    <div class="input-group col-md-4">
                        {!! Form::textarea('meta_keywords', null, ['class' => 'form-control' ]) !!}
                        <span class="help-block"> max 1000 chars </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Meta Description:</label>
                    <div class="input-group col-md-4">
                        {!! Form::textarea('meta_description', null, ['class' => 'form-control'  ]) !!}
                        <span class="help-block"> max 255 chars </span>
                    </div>
                </div>  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="input-group col-md-4">
                            <textarea class="form-control" rows="3" name="description" placeholder="Other information" required="required" >{{$item->description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <input type="hidden"  name="id" value="{{$item->id}}" />
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">Submit</button>
                        @if($item->collection)
                        <a type="button" class="btn grey-salsa btn-outline" href="{{action('Admin\CollectionController@getCollectionItems', [$item->collection->name, $page])}}">Cancel</a>
                        @else
                        <a type="button" class="btn grey-salsa btn-outline" href="{{action('Admin\ItemController@getShowItemList', $page)}}">Cancel</a>
                        @endif
                        </div>
                    </div>
                </div>
                {!!Form::close()!!} 
                <!-- END FORM-->
            </div>
        </div>
        </div>
        <div class="tab-pane" id="tab_images">
            @if(Session::has('warning'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Warning!</strong>
                {{ Session::get('warning') }}
            </div>
            @endif
            <input type="hidden" id="main_image" name="main_image">
            <div class="form-body" id="xoxo">
                <form action="{{action('Admin\ItemController@postUploadItemImages')}}" class="dropzone edit-dropzone" id="my-awesome-dropzone">
                {!! csrf_field() !!}
                    <span class="span_dropzone" style="display: none">{{$item->images->count()}}</span>
                    <input type="hidden" value="{{$item->id}}" name="item_id" />
                    <div class="fallback">
                        <input name="file" type="file" multiple accept="image/*"/>
                    </div>
                </form> 

                <form action="{{action('Admin\ItemController@postEditItem')}}">
                    <input type="hidden" name="_token" id = "main_image_token" value="{{ csrf_token() }}">
                    <input type="hidden" class="hidden_item_id" value="{{$item->id}}" name="id" />
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="10%"> Image </th>
                                <th width="10%"> Main Image </th>
                                <th width="10%"> Remove Image </th>
                                <th width="10%"> 
                                    Select All 
                                    <input type="checkbox" id="check_all">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->images as $image)
                            <tr class="image{{$image->id}}">    
                            <td>
                                <a href="{{URL::asset('/uploads/'.$image->name)}}" class="fancybox-button" data-rel="fancybox-button">
                                    <img class="img-responsive" style="width:200px;" src="{{URL::asset('/uploads/'.$image->name)}}" alt="">
                                </a>
                            </td>
                            <td>                                            
                                <label class="radio-inline">
                                    @if($image->id == $item->main_image_id || $item_images_count == 1)
                                    <input checked="checked" class="main_image_radio" type="radio" name="main_image_id" value="{{$image->id}}"   style="cursor:pointer">
                                    @else
                                    <input type="radio" class="main_image_radio" name="main_image_id" value="{{$image->id}}"   style="cursor:pointer">
                                    @endif 
                                </label>
                            </td>
                            <td>
                                <a class="red imageId" data-toggle="modal" href="#small" data-id = "{{$image->id}}" data-name = "{{$image->name}}"><i class="glyphicon glyphicon-trash red"></i></a> 
                            </td>
                            <td>
                                <input type="checkbox" value="{{$image->id}}" class="image_check{{$image->id}} check-list">
                            </td>
                            </tr>
                            @endforeach
                            <div class="added_image">
                            </div>  
                        </tbody>
                    </table>
                </form> 
            </div>
        </div>
        <div class="tab-pane" id="tab_videos">
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Warning!</strong>
                {{ Session::get('error') }} 
            </div>
            @endif
            <div class="form-body">     
                    {!! Form::open( ['action' => ['Admin\ItemController@postAddVideo'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
                    <input type="hidden" value="{{ csrf_token() }}" class="token"/>
                    <div class="portlet light bordered">
                        <div class="form-group">              
                            <label>Video Link</label>
                            <div class="input-group col-md-5" >
                                <input type="url" class="form-control video" placeholder="Link" name="name" required="required" />
                            </div>                   
                        </div>
                        <input type="hidden" name="item_id" value="{{$item->id}}" class="itemId" />
                        <div class="form-actions right">
                            <button type="submit" class="btn green-jungle upload" data-status="{{Session::get('uploadStatus')}}">Upload</button>
                        </div>
                        <div class="form-actions" style="margin-top: 5%">   
                            <iframe width="420" height="315" src='https://www.youtube.com/embed/{{$video}}'></iframe>
                        </div>
                    </div>  
                    {!!Form::close()!!}                 
            </div>
        </div>
        <?php Session::put('uploadStatus', 'false') ?>
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
                    <a class="red delete-image" data-dismiss="modal"><button type="button" class="btn red" >Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-sm" id="imageList" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Selected Images </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" data-dismiss="modal" class="delete_images" @if(count($item->images) > 0) data-count ="{{$item->images->last()->id}}" @endif ><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="/assets/global/plugins/plupload/js/plupload.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/assets/pages/scripts/ecommerce-products-edit.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/assets/js/dropzone.js"></script>
<script src="/assets/js/deleteimage.js"></script>
<script src="/assets/js/set_main_image.js"></script>
@endsection


@section('style')
{!! HTML::style( asset('css/bootstrap-tag-cloud.css')) !!}
@endsection