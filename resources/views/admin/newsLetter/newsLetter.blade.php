@extends('admin.dashboard')
@section('scripts')

{!! HTML::script(asset('assets/js/check_all.js')) !!}
{!! HTML::script(asset('assets/global/plugins/ckeditor/ckeditor.js')) !!}  
@endsection
@section('content')

<div class="tab-content">
<div class="tab-pane active" id="tab_0">
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>News Letter 
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="{{URL::to('admin/blog/create-article')}}"><i class="icon-refresh" style="color: white"></i> </a>
        </div>
    </div>
    @include('message')

    <div class="portlet-body form"> 
    	{!! Form::open(['action' => ['AdminController@postWriteNewsLetter'], 'class' => 'form-horizontal col-md-7', 'role' => 'form', 'id' => 'write-newsletter-form' ]) !!}
    		<div class="form-body">
    			<div class="form-group">
    				<label class=" control-label">News Letter</label><br />
    				<div class="">
                        <div class="input-icon">
                        <!-- <textarea class="form-control" rows="3" name="content" placeholder="News Letter" required="required"></textarea>  -->
                            <textarea class="ckeditor form-control" name="content" rows="3" width="100px" data-error-container="#editor2_error"></textarea>
                            <div id="editor2_error"> </div>
                        </div>
                    </div>
    			</div>
    		</div>
    		<div class="form-actions">
    			<div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button id="image_upload" type="submit" class="btn green">Submit</button>
                    </div>
                </div>
    		</div>
    		<div class="col-md-3 col-md-offset-1">
    			<h3>Subscribers</h3>
    		</div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th> Name</th> 
                        <th> Surname</th>
                        <th> Email</th>
                        <th> Check All <input type="checkbox" id="check_all"/></th> 
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($subscribers as $subscriber)
                    <tr @if($subscriber['status'] == 'unsent') style="color: red" @endif class="subscriber">
                        <td>{{$subscriber['first_name']}}</td>
                        <td>{{$subscriber['last_name']}}</td>
                        <td>{{$subscriber['email']}}</td>
                        <td>
                            <span style="margin-left: 65px">
                                <input type="checkbox" @if($subscriber['id'] == "") value="{{$subscriber['email']}}" @else value="{{$subscriber['email']}}" @endif name="subscriber_check[]" class="subscriber_check {{$subscriber['id']}} check-list"/>
                            </span>
                        </td>
                        <input type="hidden" name="registered[]" @if($subscriber['id'] == "") value="unregistered" @else value="registered" @endif>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
    	{!!Form::close()!!} 
    </div>

</div>
</div>
</div>

@endsection