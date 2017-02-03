@extends('admin.dashboard')
@section('content')
<style type="text/css">
    .delete-category-impossible:focus {
        border-color: #e7505a!important;
        color: #e7505a!important;
        background: 0 0!important;
    }
    .tools >a:focus{
        text-decoration: none;
    }
</style>
<!-- BEGIN PAGE BAR -->

    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->

    <!-- END PAGE TITLE-->

    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i> Categories
                    </div>  
                    <div class="tools">
                        <a href="{{URL::to('admin/category/create-category')}}" style="color: white">  Add</a>
                        <a class="confirm_modal" @if (count($categories) > 0) data-count="{{$categories->last()->id}}" @endif style="color: white">/ Delete</a>
                    </div>
                </div>

                <div class="portlet-body no-more-tables">
                    @if (count($categories) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Image </th>
                                    <th> Edit </th>
                                    <th> Delete</th>
                                    <th> Select All
                                    <input type="checkbox" id="check_all" /></th>                             
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{$key + 1}}</td>                                 
                                        <td>
                                            <a href="{{URL::to('admin/category/edit-category',$category->id)}}">{{$category->category}}</a>
                                        </td>
                                        
                                        @if($category->image)
                                        <td>
                                            <a href="{{URL::to('admin/category/edit-category',$category->id)}}"><img src="{{URL::asset('/uploads/'.$category->image)}}" style="width: 100px; height: 100px" ></a>
                                        </td>
                                        @else
                                        <td>
                                            <a href="{{URL::to('admin/category/edit-category',$category->id)}}"><img alt="" class="img-responsive" src="{{URL::asset('/default/default_img.jpg')}}" style="width: 100px; height: 100px"></a>
                                        </td>
                                        @endif
                                        
                                        <td>
                                            <a href="{{URL::to('admin/category/edit-category',$category->id)}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit 
                                            </a>
                                        </td>
                                        <td> 
                                            <a class="btn btn-outline btn-circle dark btn-sm red show_modal delete-category-impossible" data-toggle="modal" href="#small" alt="{{$category->id}}" data-status="{{$category->status}}" item-status="{{$category->itemStatus}}">
                                                <i class="fa fa-trash-o"></i> Delete
                                            </a>
                                        </td>
                                        <td>
                                            <span style="margin-left: 65px">
                                                <input type="checkbox" class="category_check{{$category->id}} check-list" value="{{$category->id}}" data-category="{{$category->category}}"></input>
                                            </span>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Categories</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="small" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 ><b class="modal-title"> </b></h4>
                </div>
                
                <div class="warning"></div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" id="delete_categories" data-array=""><button type="button" class="btn red">Delete</button></a> 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
{!! HTML::script(asset('assets/js/delete_categories.js')) !!}
{!! HTML::script(asset('assets/js/check_all.js')) !!}
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');
            var status = $(this).data('status');
            var itemStatus = $(this).attr('item-status');
            if(status != 0 && itemStatus != 1)
            {
                $('.modal-title').text('Delete Category?');
                $('#delete_categories').attr('href','/admin/category/delete-category/'+id);
            }else{
                if(status == '0'){
                $('.modal-title').text("You can not delete this category!");                
                }
                if(itemStatus == '1')
                {
                    $('.modal-title').text("You have items with this category! Please delete items first.");
                }
                $('#delete_categories').attr('style','display: none;');
            }
        })

    </script>
@endsection