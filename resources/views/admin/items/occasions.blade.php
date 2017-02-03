@extends('admin.dashboard')

@section('content')
<!-- BEGIN PAGE BAR -->

    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <!-- END PAGE TITLE-->
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title"> 
                    <div class="caption">
                        <i class="icon-list"></i> <a href="/admin/item/occasions/1" style="color:white"> Items </a>
                        <form action="{{action('Admin\ItemController@getSearchItems', ['occasions', 1])}}">
                        <input style="height: 25px; font-size:13px; margin-top: 5px; color: black!important;" class=" search-input" type="text" name="search" id="search" size="17" placeholder="Search ... " required="required"  >
                        <button style="" type="submit" class="button-search btn-xs"><i style="color:black" class='fa fa-search header-search'></i></button>
                        </form>
                    </div> 
                    <div class="tools">
                        <a href="{{URL::to('admin/item/create-item')}}" style="color: white">  Add </a>
                        <a class="delete_occasions" @if(count($items) > 0) data-count ="{{$items->first()->id}}" @endif style="color: white">/ Remove from Occasions </a>
                        
                    </div>         
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($items) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Title</th>
                                    <th> Main Image</th>
                                    <th> Edit</th>
                                    <th> Delete</th>
                                    <th> Select All
                                    <input type="checkbox" id="check_all" />
                                    </th>                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemArr[$page-1] as $key => $item)
                                    <tr class="item">
                                        <td class="item_id" value="{{$item->id}}"> {{($page-1)*20 + $key + 1}}</td>
                                        <td>
                                            <a href="{{URL::to('admin/item/edit-item',$item->slug)}}">{{$item->title}}</a>
                                        </td>
                                        <td>
                                            <a href="{{URL::to('admin/item/edit-item',$item->slug)}}">                                         
                                                @if($item->mainImages != '')
                                                    <img alt="" class="img-responsive" style="width:150px;" src="{{URL::asset('/uploads/'.$item->mainImages->name)}}">
                                                @elseif(count($item->images) > 0)
                                                    <img alt="" class="img-responsive" style="width:150px;" src="{{URL::asset('/uploads/'.$item->images[0]->name)}}">
                                                @else
                                                    <img alt="" class="img-responsive" style="width:150px;" src="{{URL::asset('/default/default_img.jpg')}}">
                                                @endif
                                            </a>                                         
                                        </td>
                                        <td>
                                            <a href="{{URL::to('admin/item/edit-item',$item->slug)}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline btn-circle dark btn-sm red show_modal" data-toggle="modal" href="#small" alt="{{$item->id}}" >
                                                <i class="fa fa-trash-o"></i> Delete Item</a>
                                        </td>
                                        <td>
                                        <input type="checkbox" class="item_check{{$item->id}} check-list" value="{{$item->id}}"></input>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                        @if($page-1 > 0)
                        <a href="/admin/item/occasions/{{$page-1}}"><button>Previous</button></a>
                        @endif
                        <button>{{$page}}</button>
                        @if($page < $maxPage)
                        <a href="/admin/item/occasions/{{$page+1}}"><button>Next</button></a>
                        @endif
                        </div>
                    @else
                        <h3>No Items</h3>
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
                    <h4 class="modal-title">Delete Item </h4>
                </div>
                <div class="modal-body">  </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" class="delete_item" id="delete_item"><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
{!! HTML::script(asset('assets/js/delete_items.js')) !!}
{!! HTML::script(asset('assets/js/delete_from_occasions.js')) !!}
{!! HTML::script(asset('assets/js/check_all.js')) !!}
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');
            $('#delete_item').attr('href', '/admin/item/delete-item/'+id+'/1');

            
        });
    </script>
@endsection