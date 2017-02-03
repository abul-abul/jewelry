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
            <i class="fa fa-gift"></i>Edit Collection
            
            </div>
        <div class="tools">
            <a href="{{URL::to('admin/collection/create-collection')}}" style="color: white">  Add</a>
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/collection/edit-collection',$collection->id)}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    @if ($errors->has('name') || $errors->has('description') || $errors->has('image') || $errors->has('alt'))
    @include('message')
    @endif
    @if(Session::has('success'))
	    <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>Success!</strong>
            {{ Session::get('success') }}
    	</div>
	@endif
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        {!! Form::model($collection, ['action' => ['Admin\CollectionController@postEditCollection'], 'files' => 'true','class' => 'login-form']) !!}
            <div class="form-body">

            	<div class="form-group">              
                    <b><label class="col-md-2 control-label">Name</label></b>
                    <div class="input-group col-md-3" >
                        <input type="text" class="form-control" placeholder="Name" name="name" required="required" value="{{$collection->name}}" />             
          			</div>
          		</div>
                <div class="form-group">
	                <b><label class="col-md-2 control-label">Description</label></b>
	                <div class="input-group col-md-3">
	                <textarea class="form-control" rows="3" name="description" placeholder="Other information" required="required" >{{$collection->description}}</textarea>
	                </div>
	            </div>
                <div class="form-group">              
                    <b><label class="col-md-2 control-label">Main Image</label></b>
                    <div class="form-group">              
                        <div class="input-group col-md-4" >
                            <input id="image" name="image" type="hidden">
                        </div>
                        <label class="input-group col-md-6" for="input_24" id="imag_slider">
                            @if($collection->image == '')
                            <img src="{{URL::asset('/seederImg/select_file.PNG')}}"  class="img-rounded show-image" alt="Cinque Terre" width="auto" height="50%">           
                            @else
                            <img src="/uploads/{{$collection->image}}"  class="img-rounded show-image" alt="Cinque Terre" width="50%" height="auto">
                            @endif
                        </label>                 
                    </div>              
                </div>              
            </div>
            <div class="form-group">              
                <b><label class="col-md-2 control-label">Image Alt</label></b>
                <div class="input-group col-md-3" >
                    <input type="text" class="form-control" placeholder="Alt" name="alt" required="required" value="{{$collection->alt}}" />             
                </div>
            </div>
            <input type="hidden" name="id" value="{{$collection->id}}"></input>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn green">Submit</button>
                        <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/collection/collections')}}">Cancel</a>
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
</div>


@endsection
@section('script')
@stop