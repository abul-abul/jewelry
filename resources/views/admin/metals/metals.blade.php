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

    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i> Metals
                    </div> 
                    <div class="tools">
                        <a href="{{URL::to('admin/metal/create-metal')}}" style="color: white"> Add</a>
                        <a data-toggle="modal" href="#metalsList" style="color: white">/ Delete</a>
                    </div>        
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($metals) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Name</th>
                                    <th> Edit</th>
                                    <th> Delete</th>
                                    <th> Select All
                                    <input type="checkbox" id="check_all">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($metals as $key => $metal)
                                    <tr class="metal">
                                        <td class="metal_id" value="{{$metal->id}}">{{$key + 1}}</td>                                 
                                        <td>
                                            <a href="{{URL::to('admin/metal/edit-metal',$metal->id)}}">{{$metal->name}}</a>
                                        </td>
                                        <td>
                                            <a href="{{URL::to('admin/metal/edit-metal',$metal->id)}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit 
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline btn-circle dark btn-sm red show_modal" data-toggle="modal" href="#small" alt="{{$metal->id}}" >
                                                <i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                        <td>
                                            <span style="margin-left: 65px">
                                                <input type="checkbox" value="{{$metal->id}}" class="metal_check{{$metal->id}} check-list"></input>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Metals</h3>
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
                    <h4 class="modal-title">Delete Metal </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" id="delete_metal" class="delete_metal"><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-sm" id="metalsList" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Selected Metals </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a data-dismiss="modal" class="delete_selected_metals" @if(count($metals) > 0) data-count="{{$metals->last()->id}}" @endif ><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
{!! HTML::script(asset('assets/js/delete_metals.js')) !!}
{!! HTML::script(asset('assets/js/check_all.js')) !!}
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');
            $('#delete_metal').attr('href', '/admin/metal/delete-metal/'+id);
            
        });
    </script>
@endsection
