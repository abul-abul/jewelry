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
                    <div class="caption"><i class="icon-list"></i> Gemstones
                    </div>
                    <div class="tools">
                        <a href="{{URL::to('admin/gemstone/add-gemstone')}}" style="color: white">  Add</a>
                        <a data-toggle="modal" href="#gemstonesList" style="color: white">/ Delete</a>
                    </div>
                    </div>
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($gemstones) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Name</th>
                                    <th> Edit</th>
                                    <th> Delete</th>
                                    <th> Select All
                                    <input type="checkbox" id="check_all" />
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gemstones as $key => $gemstone)
                                    <tr class="gemstone">
                                        <td class="metal_id" value="{{$gemstone->id}}">{{$key + 1}}</td>                                 
                                        <td>
                                            <a href="{{URL::to('admin/gemstone/edit-gemstone', $gemstone->id)}}">{{$gemstone->name}}</a>
                                        </td>
                                        <td>
                                            <a href="{{URL::to('admin/gemstone/edit-gemstone', $gemstone->id)}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit 
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline btn-circle dark btn-sm red show_modal" data-toggle="modal" href="#small" alt="{{$gemstone->id}}" >
                                                <i class="fa fa-trash-o"></i> Delete </a>
                                        </td> 
                                        <td>
                                            <span style="margin-left: 65px">
                                                <input type="checkbox" value="{{$gemstone->id}}" class="gemstone_check{{$gemstone->id}} check-list"></input>
                                            </span>
                                        </td>                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Gemstones</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="border: none !important;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Gemstone </h4>
                </div>
                <div class="modal-footer" style="border: none !important;">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" id="delete_gemstone"><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-sm" id="gemstonesList" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Selected Gemstones </h4>
                </div>               
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a data-dismiss="modal" class="delete_selected_gemstones" @if (count($gemstones) > 0) data-count="{{$gemstones->last()->id}}" @endif><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
{!! HTML::script(asset('assets/js/delete_gemstones.js')) !!}
{!! HTML::script(asset('assets/js/check_all.js')) !!}
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');

            console.log(id);
            $('#delete_gemstone').attr('href', '/admin/gemstone/delete-gemstone/'+id);

        });
    </script>
@endsection
