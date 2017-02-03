@extends('admin.dashboard')

@section('scripts')
{!! HTML::script(asset('assets/js/editOrderStatus.js')) !!}
@endsection

@section('content')

    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i> Orders
                    
                     </div> 
                     <div class="tools">

                     </div>         
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($orders) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Order Date</th>
                                    <th> UserName </th>
                                    <th> Order Amount </th>
                                    <th>  </th>                            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td width="100px"> {{$order->date}}</td>                                
                                        <td> 
                                            <a style="color:black" href="{{ action('Admin\UserController@getEditUser', $order->user->id) }}">{{$order->user->first_name}} {{ $order->user->last_name}} </a>
                                        </td>
                                        <td> ${{$order->total}} </td>
                                        <td>
                                            <a href="{{ action('Admin\OrderController@getViewOrder', [$order->user->id, $order->first()->code]) }}"  @if($order->first()->seen == 1) class="btn btn-outline btn-circle btn-sm green" @else class="btn btn-outline btn-circle btn-sm red" @endif> 
                                                <i class="fa fa-edit"></i> View </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Orders</h3>
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
@endsection