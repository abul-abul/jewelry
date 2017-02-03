@extends('admin.dashboard')
@section('content')
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>User's orders
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                        	<th> # </th>
                                                        	<th> Order Date</th>
                                                            <th> Title </th>
                                                            <th> Image </th>
                                                            <th> Original Price </th>
                                                            <th> Price </th>
                                                            <th> Discount Amount </th>
                                                            <th> Quantity </th>
                                                            <th> Total </th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orders as $key => $order)
                                                        <tr>
                                                            <td> {{$key+1}} </td>
                                                            <td width="100px"> {{$order->date}} </td>
	                                                        <td style="width: 20px"> {{$order->item->title}} </td>
	                                                        <td>
	                                                         @if($order->item->main_image_id)
	                                                         <img alt="" class="img-responsive" style="width:150px;" src="{{URL::asset('/uploads/'.$order->item->mainImages->name)}}">
	                                                         @elseif($order->item->images->first())
	                                                         <img alt="" class="img-responsive" style="width:150px;" src="{{URL::asset('/uploads/'.$order->item->images[0]->name)}}">
	                                                         @else
	                                                         <img alt="" class="img-responsive" style="width:150px;" src="{{URL::asset('/default/default_img.jpg')}}">
	                                                         @endif
	                                                        </td> 
                                                            <td> ${{$order->item->price}} </td>
                                                            <td> ${{$order->item->new_price}} </td>
                                                            <td> {{$order->item->discount}} %</td>
                                                            <td> {{$order->quantity}} </td>
                                                            <!-- <td> </td>
                                                            <td> </td> -->
                                                            <td> ${{$order->item->new_price * $order->quantity}}</td>
                                                            <td>
                                                            	<a href="{{ action('Admin\OrderController@getViewOrder', [$order->user->id, $order->code]) }}" class="btn btn-outline btn-circle btn-sm green">
                                                					<i class="fa fa-edit"></i> View </a> 
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
@endsection