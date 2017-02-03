@extends('admin.dashboard')

@section('content')  

<link href="/assets/css/dropzone.css" rel="stylesheet" type="text/css" /> 
<div class="tab-content">
<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Create Item
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/item/create-item')}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
@if ($errors->has('title') || $errors->has('description') || $errors->has('quantity') || $errors->has('price') || $errors->has('category_id') || $errors->has('title') || $errors->has('item_image') || $errors->has('alt') || Session::has('item_create_errors'))
<div class="col-sm-8">
    <div class="alert alert-danger">
       @foreach ($errors->all() as $error)
           {{ $error }}<BR>       
       @endforeach
       {{Session::get('item_create_errors')}} 
   </div>
</div>
@elseif(!(Session::has('item_create_errors')))
{{Session::forget('_old_input')}}
@endif
     
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        
        {!! Form::open(['action' => ['Admin\ItemController@postCreateItem'], 'files' => 'true','class' => 'form-horizontal col-md-7', 'role' => 'form', 'id' => 'create-item-form' ]) !!}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Title</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Title" maxlength="40" name="title" value="{{ old('title') }}"/>
                        
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">SKU</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="SKU" name="subtitle" value="{{ old('subtitle') }}"/>                      
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Price</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-dollar font-green"></i>
                            </span>
                            <input type="number" min="0" placeholder="Price" name="price" class="form-control"value="{{ old('price') }}"/>
                        	<input type="hidden" name="new_price" value="" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Discount</label>
                    <div class="col-md-6">
                        <div class="input-group">
                        <span class="input-group-addon">
                                
                            </span>
                            <input type="number" min="0" max="99" class="form-control" name="discount" placeholder="Discount" value="{{ old('discount') }}">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="new_price"></input>
                <div class="form-group">
                    <label class="col-md-3 control-label">Quantity</label>
                    <div class="col-md-6">
                        <div class="input-icon">
                            <input  type="number" class="form-control" min="0" placeholder="Quantity" name="quantity"value="{{ old('quantity') }}"> 
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-6">
                        <div class="input-icon">
                            <select class="form-control " name="status">
                                <option value="Available">Available</option>
                                <option value="Coming Soon">Coming Soon</option>
                                <option value="Out of the store">Out of the store</option>
                            </select>
						 </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Category</label>
                    <div class="size col-md-6">
                        <select class="form-control spinner" id="category" name="category_id">
                        	@if(count($categories) > 0)
                            	@foreach($categories as $category)
                                    <option class="category_type" value="{{$category->id}}" {{ (old('category_id') == $category->id ? "selected":"") }}>{{$category->category}}</option>
                                @endforeach  
                            @else   
                            	<option value="0" default>None</option>
                            @endif  
                        </select> <br />
                        @if($categories[0]->category == 'Rings' || old('category_id') == 1)
                        <div class="ring_size" aria-hidden="true" style="display: flex">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Size</label>
                                <div class="col-md-6">                  
                                   <input type="hidden" name="size_check" id="size_check" value="unchecked">                      
                                    <div class="icheck-list">
                                        @foreach($sizes as $size)
                                        <div class="portlet-body form">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="portlet_tab_1_1">
                                                <label>
                                                    <input id="size_checkbox" type="checkbox" class="icheck size_checkbox" data-checkbox="icheckbox_flat-grey" name="size_checkbox[]" value="{{$size}}"  @if(old('size_checkbox')) {{ (in_array($size, old('size_checkbox')) ? "checked":"") }} @endif>{{$size}}
                                                </label>
                                                </div> 
                                            </div>
                                        </div>
                                        @endforeach 
                                    </div> 
                                </div>
                            </div>
                        </div>
                        @endif  
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Collection</label>
                    <div class="col-md-6">
                        <select class="form-control spinner" name="collection_id">
                        <option value="0">None</option>
                        	@if(count($collections) > 0)
                            	@foreach($collections as $collection)
                                    <option value="{{$collection->id}}" {{ (old('collection_id') == $collection->id ? "selected":"") }}>{{$collection->name}}</option>
                                @endforeach   
                            @else
                            	<option value="0" default>None</option>
                            @endif     
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Metal</label>
                    <div class="col-md-6">                  
                       <input type="hidden" name="metal_check" id="metal_check" value="unchecked">
                        @if(count($metals) > 0)
                        <div class="icheck-list">
                            @foreach($metals as $metal)
                            <div class="portlet-body form">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="portlet_tab_1_1">
                                        <label>
                                            <input id="metal_checkbox" type="checkbox" class="icheck metal_checkbox" data-checkbox="icheckbox_flat-grey" name="metal_checkbox[]" value="{{$metal->id}}" data-checked = "unchecked" @if(old('metal_checkbox')) {{ (in_array($metal->id, old('metal_checkbox')) ? "checked":"") }} @endif>{{$metal->name}}
                                        </label>
                                    </div>  
                                </div>
                            </div>
                            @endforeach </div>
                        @else
                            <option value="0" default>None</option>
                        @endif  

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Gemstone</label>
                    <div class="col-md-6">                  
                       <input type="hidden" name="gemstone_check" id="gemstone_check" value="unchecked">
                    	@if(count($gemstones) > 0)
                    	<div class="icheck-list">
                        	@foreach($gemstones as $gemstone)
                        	<div class="portlet-body form">
                                <div class="tab-content">
	                        		<div class="tab-pane active" id="portlet_tab_1_1">
			                              	<label>
			                              		<input id="gemstone_checkbox" type="checkbox" class="icheck gemstone_checkbox" data-checkbox="icheckbox_flat-grey" name="gemstone_checkbox[]" value="{{$gemstone->id}}" data-checked = "unchecked"  @if(old('gemstone_checkbox')) {{ (in_array($gemstone->id, old('gemstone_checkbox')) ? "checked":"") }} @endif>{{$gemstone->name}}
			                              	</label>
				                    </div> 
			                    </div>
		                    </div>
                            @endforeach </div>
                        @else
                        	<option value="0" default>None</option>
                        @endif  

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Image Alt</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Alt" name="alt" value="{{ old('alt') }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Video Link</label>
                    <div class="col-md-6">
                        <input type="url" class="form-control" placeholder="Link" name="video"/>                       
                    </div>
                </div> 
                <input type="hidden" name="tags[]" id="tagsArr" />
                 <div class="form-group">
                 <label class="col-md-3 control-label">Search tags</label>
                     <div class="col-md-6">
                        <div id="tag-info" class="input-append">
                          <input id="item_tag" type="text">
                          <button class="btn add_tag" type="button">Add <i class="icon-plus"></i></button>
                        </div>
                        <ul id="tag-cloud"></ul>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-md-3 control-label">Meta Title:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control maxlength-handler" name="meta_title" maxlength="100" placeholder="" value="{{ old('meta_title') }}">
                        <span class="help-block"> max 100 chars </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Meta Keywords:</label>
                    <div class="col-md-8">
                        <textarea class="form-control maxlength-handler" rows="8" name="meta_keywords" maxlength="1000" value="{{ old('meta_keywords') }}"></textarea>
                        <span class="help-block"> max 1000 chars </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Meta Description:</label>
                    <div class="col-md-8">
                        <textarea class="form-control maxlength-handler" rows="8" name="meta_description" maxlength="255" value="{{ old('meta_description') }}"></textarea>
                        <span class="help-block"> max 255 chars </span>
                    </div>
                </div>          
                <div class="form-group">
                    <label class="col-md-3 control-label">Description</label>
                    <div class="col-md-8">
                        <div class="input-icon">
                        <textarea class="form-control" rows="8" name="description" placeholder="Other information">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions form-actions-create-item">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">Submit</button>
                        <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/item/show-item-list/1')}}">Cancel</a>
                    </div>
                </div>
            </div>
            <input type="hidden" id="main_image" name="main_image"> 


{!!Form::close()!!}
         
        <!-- END FORM-->

        <div class="col-md-5" style="float:right; margin-top: 15px;">
            <form action="{{action('Admin\ItemController@postUploadItemImagesDrop')}}" class="dropzone" id="my-awesome-dropzone">
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
<?php Session::forget('errors') ?>
<?php Session::forget('item_create_errors') ?>
<script src="/assets/js/dropzone.js"></script>


@endsection
@section('scripts')

{!! HTML::script(asset('assets/js/ring_size.js')) !!}
<script src="/assets/js/createitemcheck.js"></script>
{!! HTML::script( asset('assets/js/bootstrap-tag-cloud.js')) !!}
{!! HTML::script( asset('assets/js/add_tags.js')) !!}

@endsection

@section('style')
{!! HTML::style( asset('css/bootstrap-tag-cloud.css')) !!}
<style type="text/css">
    .form-actions-create-item {
        background-color:white!important;
    }
</style>
@endsection