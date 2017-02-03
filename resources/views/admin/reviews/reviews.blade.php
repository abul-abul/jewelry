@extends('admin.dashboard')
@section('content')

    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i>Reviews</div>          
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($reviews) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Item Title </th>
                                    <th> Item Image </th>    
                                    <th> New Reviews </th>
                                    <th> View </th>                             
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemsArr[$page-1] as $key =>  $item) 
                                    <tr>
                                        <td> {{($page-1)*20 + $key + 1}} </td>                                                             
                                        <td> 
                                            <a href="{{URL::to('admin/item/edit-item',$item->slug)}}">{{$item->title}}</a>
                                        </td>
                                        <td>
                                            <a href="{{URL::to('admin/item/edit-item',$item->slug)}}">
                                                @if($item->image)
                                                    <img style="width:100px;height: auto" src="{{URL::asset('/uploads/'.$item->image)}}">
                                                @else
                                                    <img style="width:100px;height: auto" src="{{URL::asset('/default/default_img.jpg')}}">
                                                @endif
                                            </a>
                                        </td>   
                                        <td>
                                            @if(count($item->unseenReviews) == 0)
                                            <a href="{{ action('AdminController@getItemReviews', $item->id) }}" class="btn btn-outline btn-circle dark btn-sm red">
                                                No reviews </a>
                                            @else
                                            <a href="{{ action('AdminController@getItemReviews', $item->id) }}" class="btn btn-outline btn-circle dark btn-sm red" style="color:white; background-color: #f64243;">
                                                {{count($item->unseenReviews)}} </a>
                                            @endif
                                        </td> 
                                        <td>
                                        <!-- @if(count($item->unseenReviews) == 0)
                                            <a href="{{ action('AdminController@getItemReviews', $item->id) }}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> View </a>
                                            @else
                                            <a href="{{ action('AdminController@getItemReviews', $item->id) }}" class="btn btn-outline btn-circle dark btn-sm red" style="color:white; background-color: #f64243;">
                                                <i class="fa fa-edit"></i> {{count($item->unseenReviews)}} new</a>
                                            @endif -->
                                            <a href="{{ action('AdminController@getItemReviews', $item->id) }}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> View </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                        <div style="text-align: center">
                        @if($page-1 > 0)
                        <a href="/admin/reviews/{{$page-1}}"><button>Previous</button></a>
                        @endif
                        <button>{{$page}}</button>
                        @if($page < $maxPage)
                        <a href="/admin/reviews/{{$page+1}}"><button>Next</button></a>
                        @endif
                        </div>
                    @else
                        <h3>No Reviews</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/js/reviews.js"></script>
@endsection
