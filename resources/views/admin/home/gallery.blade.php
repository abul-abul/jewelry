@extends('admin.dashboard')
@section('content')

 <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i> Gallery
                    </div>  
                    <div class="tools">
                        
                    </div>
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($images) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Image </th>
                                    <th> Edit </th>                              
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($images as $image)
                                    <tr>
                                        <td>{{$image->id}}</td>                                 
                                        <td>
                                            <a href="{{URL::to('admin/gallery/edit-gallery', $image->id)}}">{{$image->status}}</a>
                                        </td>
                                        @if($image->image)
                                        <td>
                                            <a href="{{URL::to('admin/gallery/edit-gallery', $image->id)}}"><img src="{{URL::asset('/uploads/'.$image->image)}}" style="width: 100px; height: auto;"></a>
                                        </td>
                                        @else
                                        <td>
                                            <a href="{{URL::to('admin/gallery/edit-gallery', $image->id)}}"><img alt="" class="img-responsive" src="{{URL::asset('/default/default_img.jpg')}}" style="width: 100px; height: 100px"></a>
                                        </td>
                                        @endif
                                        <td>
                                            <a href="{{URL::to('admin/gallery/edit-gallery', $image->id)}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit 
                                            </a>
                                        </td>                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Images</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Category </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" id="delete_collection"><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection