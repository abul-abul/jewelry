@extends('admin.dashboard')
@section('content')

<div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i>Reviews</div>          
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($item->reviews) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> User Name</th>
                                    <th> User Email</th>
                                    <th> Review </th>
                                    <th> Status</th>
                                    <th> Remove </th>                               
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($item->reviews as $key =>  $review) 
                                    <tr>
                                        <td> {{$key + 1}} </td>                                                             
                                        <td> {{$review->user->first_name}} {{$review->user->last_name}} </td>
                                        <td> 
                                            {{$review->user->email}}
                                        </td>   
                                        <td style="width: 30%; ">
                                        	<span style="width: 15px; "> {{$review->review}} </span>
                                        </td> 
                                        <td>
                                        @if($review->status == "approved")
                                            <a class="btn green-jungle button-approved" data-status = "{{$review->status}}" >
                                                <span class="fa fa-check approved" alt="{{$review->id}}"></span>
                                            </a>
                                            <a class="btn default button-unapproved" data-status = "{{$review->status}}">
                                                <span class="glyphicon glyphicon-remove unapproved" alt="{{$review->id}}"></span>
                                            </a>
                                        @elseif($review->status == "unapproved")
                                            <a class="btn default button-approved" data-status = "{{$review->status}}">
                                                <span class="fa fa-check approved" alt="{{$review->id}}"></span>
                                            </a>
                                            <a class="btn red-thunderbird button-unapproved" data-status = "{{$review->status}}">
                                                <span class="glyphicon glyphicon-remove unapproved" alt="{{$review->id}}"></span>
                                            </a>
                                        @else
                                            <a class="btn default button-approved review-unseen" data-status = "{{$review->status}}">
                                                <span class="fa fa-check approved" alt="{{$review->id}}"></span>
                                            </a>
                                            <a class="btn default button-unapproved review-unseen" data-status = "{{$review->status}}">
                                                <span class="glyphicon glyphicon-remove unapproved" alt="{{$review->id}}"></span>
                                            </a>
                                        @endif                                       
                                        </td>
                                        <td>
                                            <a class="btn btn-outline btn-circle dark btn-sm red show_modal" data-toggle="modal" href="#small" alt="{{$review->id}}" >
                                                <i class="fa fa-trash-o"></i> Delete </a>
                                        </td>                               
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 

                    @else
                        <h3>No Reviews</h3>
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
                    <h4 class="modal-title">Delete review </h4>
                </div>
                <div class="modal-body">  </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" class="delete_review" id="delete_review"><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@section('scripts')
{!! HTML::script(asset('assets/js/delete_collections.js')) !!}
    <script src="/assets/js/reviews.js"></script>
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');
            $('#delete_review').attr('href','/admin/delete-review/'+id);
        });
    </script>
@endsection

@endsection