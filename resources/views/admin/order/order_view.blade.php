 @extends('admin.dashboard')
 @section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">

            <div class="portlet-body">
                <div class="tabbable-line">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="portlet yellow-crusta box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Order Details </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Order #: </div>
                                                <div class="col-md-7 value"> 
                                                    <!-- <span class="label label-info label-sm"> Email confirmation was sent </span> -->
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Order Date & Time: </div>
                                                <div class="col-md-7 value"> {{$orders->first()->date}} </div>  
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Grand Total: </div>
                                                <div class="col-md-7 value"> ${{$total+$shipping}} </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Payment Information: </div>
                                                <div class="col-md-7 value"> PayPal </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="portlet blue-hoki box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Customer Information </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Customer Name: </div>
                                                <div class="col-md-7 value"> {{$orders->first()->user->first_name}} {{$orders->first()->user->last_name}} </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Email: </div>
                                                <div class="col-md-7 value"> {{$orders->first()->user->email}}  </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> State: </div>
                                                <div class="col-md-7 value"> {{$orders->first()->user->city}}  </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Phone Number: </div>
                                                <div class="col-md-7 value"> {{$orders->first()->user->phone_number}}  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="portlet red-sunglo box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Shipping Address </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Country/City: </div>
                                                <div class="col-md-7 value"> {{$orders->first()->country}} / {{$orders->first()->city}} </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> State: </div>
                                                <div class="col-md-7 value"> {{$orders->first()->state}}  </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Address: </div>
                                                <div class="col-md-7 value"> {{$orders->first()->address}}  </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Posatl Code: </div>
                                                <div class="col-md-7 value"> {{$orders->first()->postal_code}}  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Items Ordered </div>

                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th> Product </th>
                                                            <th> Image </th>
                                                            <th> Size </th>
                                                            <th> Order Status </th>
                                                            <th> Original Price </th>
                                                            <th> Price </th>
                                                            <th> Quantity </th>
                                                            <th> Tax Amount </th>
                                                            <th> Tax Percent </th>
                                                            <th> Discount Amount </th>
                                                            <th> Total </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $order)
                                                        <tr>
                                                            <td width="100px">
                                                                <a href="{{URL::to('admin/item/edit-item',$order->item->slug)}}"> {{$order->item->title}} </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{URL::to('admin/item/edit-item',$order->item->slug)}}"> 
                                                                    @if($order->item->main_image_id)
                                                                     <img alt="" class="img-responsive" style="width:100px;" src="{{URL::asset('/uploads/'.$order->item->mainImages->name)}}">
                                                                     @elseif($order->item->images->first())
                                                                     <img alt="" class="img-responsive" style="width:100px;" src="{{URL::asset('/uploads/'.$order->item->images[0]->name)}}">
                                                                     @else
                                                                     <img alt="" class="img-responsive" style="width:100px;" src="{{URL::asset('/default/default_img.jpg')}}">
                                                                     @endif
                                                                </a>
                                                            </td>
                                                            <td>
                                                                @if($order->item->category_id == 1 )
                                                                    {{$order->size}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{--{{$statuses}}--}}
                                                                <select name="status" class="label label-sm label-success" id="status">
                                                                @foreach($statuses as $status)
                                                                    <option id="{{$order->id}}" @if($order->status == $status) selected @endif>{{$status}}</option>
                                                                @endforeach
                                                                </select>
                                                            </td>
                                                            <td> ${{$order->item->price}}</td>
                                                            <td> ${{$order->item->new_price}} </td>
                                                            <td> {{$order->quantity}} </td>
                                                            <td>  </td>
                                                            <td> </td>
                                                            <td> {{$order->item->discount}} </td>
                                                            <td> ${{$order->item->new_price*$order->quantity}} </td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> </div>
                                <div class="col-md-6">
                                    <div class="well">
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Sub Total: </div>
                                            <div class="col-md-3 value"> ${{$total}} </div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Shipping: </div>
                                            <div class="col-md-3 value"> ${{$shipping}} </div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Grand Total: </div>
                                            <div class="col-md-3 value"> ${{$total+$shipping}} </div>
                                        </div>
                                        <!-- <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Total Paid: </div>
                                            <div class="col-md-3 value"> $1,260.00 </div>
                                        </div> -->
<!--                                                             <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Total Refunded: </div>
                                            <div class="col-md-3 value"> $0.00 </div>
                                        </div> -->
<!--                                                             <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Total Due: </div>
                                            <div class="col-md-3 value"> $1,124.50 </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="table-container">
                                <div class="table-actions-wrapper">
                                    <span> </span>
                                    <select class="table-group-action-input form-control input-inline input-small input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                    <button class="btn btn-sm yellow table-group-action-submit">
                                        <i class="fa fa-check"></i> Submit</button>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="5%">
                                                <input type="checkbox" class="group-checkable"> </th>
                                            <th width="5%"> Invoice&nbsp;# </th>
                                            <th width="15%"> Bill To </th>
                                            <th width="15%"> Invoice&nbsp;Date </th>
                                            <th width="10%"> Amount </th>
                                            <th width="10%"> Status </th>
                                            <th width="10%"> Actions </th>
                                        </tr>
                                        <tr role="row" class="filter">
                                            <td> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="order_invoice_no"> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to"> </td>
                                            <td>
                                                <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_invoice_date_from" placeholder="From">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_invoice_date_to" placeholder="To">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <input type="text" class="form-control form-filter input-sm" name="order_invoice_amount_from" placeholder="From" /> </div>
                                                <input type="text" class="form-control form-filter input-sm" name="order_invoice_amount_to" placeholder="To" /> </td>
                                            <td>
                                                <select name="order_invoice_status" class="form-control form-filter input-sm">
                                                    <option value="">Select...</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="paid">Paid</option>
                                                    <option value="canceled">Canceled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <button class="btn btn-sm yellow filter-submit margin-bottom">
                                                        <i class="fa fa-search"></i> Search</button>
                                                </div>
                                                <button class="btn btn-sm red filter-cancel">
                                                    <i class="fa fa-times"></i> Reset</button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover" id="datatable_credit_memos">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="5%"> Credit&nbsp;Memo&nbsp;# </th>
                                            <th width="15%"> Bill To </th>
                                            <th width="15%"> Created&nbsp;Date </th>
                                            <th width="10%"> Status </th>
                                            <th width="10%"> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_4">
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover" id="datatable_shipment">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="5%"> Shipment&nbsp;# </th>
                                            <th width="15%"> Ship&nbsp;To </th>
                                            <th width="15%"> Shipped&nbsp;Date </th>
                                            <th width="10%"> Quantity </th>
                                            <th width="10%"> Actions </th>
                                        </tr>
                                        <tr role="row" class="filter">
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="order_shipment_no"> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="order_shipment_ship_to"> </td>
                                            <td>
                                                <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_shipment_date_from" placeholder="From">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_shipment_date_to" placeholder="To">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <input type="text" class="form-control form-filter input-sm" name="order_shipment_quantity_from" placeholder="From" /> </div>
                                                <input type="text" class="form-control form-filter input-sm" name="order_shipment_quantity_to" placeholder="To" /> </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <button class="btn btn-sm yellow filter-submit margin- bottom">
                                                        <i class="fa fa-search"></i> Search</button>
                                                </div>
                                                <button class="btn btn-sm red filter-cancel">
                                                    <i class="fa fa-times"></i> Reset</button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_5">
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover" id="datatable_history">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="25%"> Datetime </th>
                                            <th width="55%"> Description </th>
                                            <th width="10%"> Notification </th>
                                            <th width="10%"> Actions </th>
                                        </tr>
                                        <tr role="row" class="filter">
                                            <td>
                                                <div class="input-group date datetime-picker margin-bottom-5" data-date-format="dd/mm/yyyy hh:ii">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_history_date_from" placeholder="From">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default date-set" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="input-group date datetime-picker" data-date-format="dd/mm/yyyy hh:ii">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_history_date_to" placeholder="To">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default date-set" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="order_history_desc" placeholder="To" /> </td>
                                            <td>
                                                <select name="order_history_notification" class="form-control form-filter input-sm">
                                                    <option value="">Select...</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="notified">Notified</option>
                                                    <option value="failed">Failed</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <button class="btn btn-sm yellow filter-submit margin-bottom">
                                                        <i class="fa fa-search"></i> Search</button>
                                                </div>
                                                <button class="btn btn-sm red filter-cancel">
                                                    <i class="fa fa-times"></i> Reset</button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
<!-- </div>
END CONTENT BODY
</div> -->
<!-- END CONTENT -->
@endsection
@section('scripts')
{!! HTML::script(asset('assets/js/editOrderStatus.js')) !!}
@endsection