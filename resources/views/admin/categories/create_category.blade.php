@extends('admin.dashboard')

@section('scripts')
{!! HTML::script(asset('assets/js/file-upload.main.js')) !!}
{!! HTML::script(asset('assets/global/plugins/ckeditor/ckeditor.js')) !!} 
@endsection

@section('content')

<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Create Category
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/category/create-category')}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    @include('message')
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        {!! Form::open(['action' => ['Admin\CategoryController@postCreateCategory'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="input-group col-md-4">
                     <input type="text" class="form-control " placeholder="Name" name="category" required="required"/>
                    </div> 
                </div>
                <div class="form-group">
                    <label class=col-md-3 "control-label">Name Style</label>
                    <div class="input-group col-md-6">
                    <!-- <input type="text" class="form-control " placeholder="Name" name="category" required="required"/>-->
                    <textarea class="ckeditor form-control" name="style" rows="3" width="100px" data-error-container="#editor2_error"></textarea>
                        <div id="editor2_error"> </div>
                    </div> 
                        
                </div>
                <div class="form-group">              
                    <label class="col-md-3 control-label">Category Image</label>
                    <div class="input-group col-md-4" >
                        <div class="form-group">              
                            <div class="input-group col-md-4" >
                                <input id="image" name="image" type="hidden">
                            </div>
                            <label class="input-group col-md-8" for="input_24" id="imag_slider">
                                <img src="{{URL::asset('/seederImg/select_file.PNG')}}"  class="img-rounded show-image" alt="Cinque Terre" width="100%"> 
                            </label>                 
                        </div>                                       
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Image Alt</label>
                    <div class="input-group col-md-4">
                     <input type="text" class="form-control " placeholder="Alt" name="alt" required="required"/>
                    </div> 
                </div> 

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn  green">Submit</button>
                        <a type="button" class="btn grey-salsa btn-outline" href="{{URL::to('admin/category/categories')}}">Cancel</a>
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
@section('script')
@stop