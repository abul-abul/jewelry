@extends('admin.dashboard')
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
<div class="row">
    <div class="col-md-5">
    	<div class="portlet light bordered col-md-12">
    	<div class="portlet-title">
            <div class="caption font-success">
                <i class="icon-plus success"></i>
                <span class="caption-subject bold uppercase">Item #{{$item->id}}</span>
            </div>
        </div>
			<div class="portlet-body">
				<div class="tabbable-bordered">
					<ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_information" data-toggle="tab"> Information </a>
                        </li>
                        <li>
                            <a href="#tab_images" data-toggle="tab"> Images </a>
                        </li>
                        <li>
                            <a href="#tab_videos" data-toggle="tab"> Videos</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    	<div class="tab-pane active" id="tab_information">                 				            
				            <div class="portlet-body form">
				                   
					                <p><b style="color:#2E2E2E">Title: </b>   <span><i>{{$item->title}}</i></span></p>
					                <p><b style="color:#2E2E2E">Price: </b>   <span><i>{{$item->price}}$</i></span></p>
					                <p><b style="color:#2E2E2E">Description: </b><br>
					                	<text disabled rows="8" cols="55" style="resize:none">
										 &nbsp{{$item->description}}
										</text>	
					                </p>
					                <p><b style="color:#2E2E2E">Status: </b>   <span><i>{{$item->status}}</i></span></p>
					                <p><b style="color:#2E2E2E">Discount: </b>   <span><i>{{$item->discount}}%</i></span></p>
					                <p><b style="color:#2E2E2E">Quantity: </b>   <span><i>{{$item->quantity}}</i></span></p>
					                <p><b style="color:#2E2E2E">Collection: </b>   <span><i>{{$item->collection->name}}</i></span></p>
				            
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
                    		<div class="form-body" id="xoxo">
                                  <form action="{{action('Admin\ItemController@postUploadItemImagesDrop')}}" class="dropzone" id="my-awesome-dropzone">
                                  {!! csrf_field() !!}
                                  <span class="span_dropzone" style="display: none">{{$item->images->count()}}</span>
                                  <input type="hidden" value="{{$item->id}}" name="item_id" />
                                      <div class="fallback">
                                        <input name="file" type="file" multiple /> 
                                      </div>
                                   </form>
                                   
                                   <form action="{{action('Admin\ItemController@postEditItem')}}">
                                   <input type="hidden" name="_token" id = "main_image_token" value="{{ csrf_token() }}">
                                    <input type="hidden" class="hidden_item_id" value="{{$item->id}}" name="id" />
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th width="10%"> Image </th>
                                                <th width="10%"> Main image </th>
                                                <th width="10%"> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            @foreach($item->images as $image)
                                            <tr>    
                                                <td>
                                                    <a href="{{URL::asset('/uploads/'.$image->name)}}" class="fancybox-button" data-rel="fancybox-button">
                                                        <img class="img-responsive" src="{{URL::asset('/uploads/'.$image->name)}}" alt="">
                                                    </a>
                                                </td>
                                                <td>                                            
                                                    <label class="radio-inline">
                                                    @if($image->id == $item->main_image_id)
                                                        <input checked="checked" class="main_image_radio" type="radio" name="main_image_id" value="{{$image->id}}"   style="cursor:pointer">
                                                    @else
                                                        <input type="radio" class="main_image_radio" name="main_image_id" value="{{$image->id}}"   style="cursor:pointer">
                                                    @endif
                                                    </label>
                                                    
                                                </td>
                                                <td>
                                                    <a class="red delete-image" data-id = "{{$image->id}}" data-name = "{{$image->name}}"><i class="glyphicon glyphicon-trash red"></i></a>
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
                            @include('message')
                        <div class="form-actions">  
                            <div class="col-md-12">
                                {!! Form::open( ['action' => ['Admin\ItemController@postAddVideo'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
                                    <div class="portlet light bordered">
                                        <div class="form-group">              
                                            <label>Video Link</label>
                                            <div class="input-group col-md-8" >
                                                <input type="text" class="form-control " placeholder="Link" name="name" required="required" />
                                            </div>                   
                                        </div>
                                            <input type="hidden" name="item_id" value="{{$item->id}}"/>
                                            <div class="form-actions right">
                                                <button type="submit" class="btn green-jungle">Upload</button>
                                            </div>
                                    </div>  
                                {!!Form::close()!!} 
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="col-md-12">
                                <iframe width="420" height="315" src='https://www.youtube.com/embed/{{$video}}'></iframe>
                            </div>
                        </div>
                        </div>
                    </div>
				</div>
			</div>
    	 </div>
    </div>
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
@section('script')        
@stop