@extends('admin.dashboard')
@section('content')
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-users"></i>Users</div>          
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($users) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Country/City</th>
                                    <th>Orders</th>
                                    <th>Edit</th>
                                    <th>Delete</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->country}}/{{$user->city}}</td>
                                        <td>
                                            <a href="{{ action('Admin\UserController@getUsersOrders', $user->id) }}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> View </a>
                                        </td>
                                        <td>
                                            <a href="{{ action('Admin\UserController@getEditUser', $user->id) }}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline btn-circle dark btn-sm red show_modal" data-toggle="modal" href="#small" alt="{{$user->id}}" >
                                                <i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Users</h3>
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
                    <h4 class="modal-title">Delete User </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" id="delete_user"><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');
            $('#delete_user').attr('href','/admin/user/delete-user/'+id);
        });
    </script>
@endsection