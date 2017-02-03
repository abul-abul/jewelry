@extends('admin.dashboard')

<style type="text/css">
    .show_modal:focus{
        border-color: #e7505a!important;
        color: #e7505a!important;
        background: 0 0!important;
    }
    .tools >a:focus{
        text-decoration: none;
    }
</style>

@section('content')
<!-- BEGIN PAGE BAR -->


    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <!-- END PAGE TITLE-->

    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i> Collections
                    
                     </div> 
                     <div class="tools">
                         <a href="{{URL::to('admin/collection/create-collection')}}" style="color: white">  Add</a>
                         <a data-toggle="modal" href="#collectionList"style="color: white">/ Delete</a>
                     </div>         
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($collections) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Name</th>
                                    <th> Image</th>
                                    <th> Description</th>
                                    <th> Items </th>
                                    <th> Edit</th> 
                                    <th> Delete </th>
                                    <th> Select All
                                    <input type="checkbox" id="check_all" />
                                    </th>                             
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collections as $key => $collection)
                                    <tr>
                                        <td class="coll_id">{{$key + 1}}</td>                                 
                                        <td>
                                            <a href="{{URL::to('admin/collection/edit-collection',$collection->id)}}">{{$collection->name}}</a>
                                        </td>
                                        <td>
                                            <a href="{{URL::to('admin/collection/edit-collection',$collection->id)}}"><img alt="" class="img-responsive" style="width:150px;" src="{{URL::asset('/uploads/'.$collection->image)}}"></a>
                                        </td>
                                        <td><span style="overflow:hidden; text-overflow: ellipsis; width: 150px;  display: inline-block; white-space: nowrap;" >{{$collection->description}}</span>
                                        </td>
                                        <td>
                                            <a href="{{URL::to('admin/collection/collection-items',[$collection->name, 1])}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> View 
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{URL::to('admin/collection/edit-collection',$collection->id)}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit 
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline btn-circle dark btn-sm red show_modal" data-toggle="modal" href="#small" alt="{{$collection->id}}" >
                                                <i class="fa fa-trash-o"></i> Delete </a>
                                        </td> 
                                        <td>
                                        <span style="margin-left: 65px">
                                            <input type="checkbox" class="coll_check{{$collection->id}} check-lis" value="{{$collection->id}}" ></input>
                                            </span>
                                        </td>                                     
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Collections</h3>
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
                    <h4 class="modal-title">Delete Collection </h4>
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
    <div class="modal fade bs-modal-sm" id="collectionList" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Selected Collections </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a data-dismiss="modal" class="delete_collections"   @if(count($collections) > 0)data-count="{{$collections->last()->id}}" @endif ><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
{!! HTML::script(asset('assets/js/delete_collections.js')) !!}
{!! HTML::script(asset('assets/js/check_all.js')) !!}
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');
            $('#delete_collection').attr('href','/admin/collection/delete-collection/'+id);
        });
    </script>
@endsection