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
                    <div class="caption"><i class="icon-list"></i> Sliders
                    </div>
                    <div class="tools">
                        <a href="{{URL::to('admin/slider/create-slider')}}" style="color: white">  Add</a>
                        <a data-toggle="modal" href="#slidersList" style="color: white">/ Delete</a>
                     </div>      
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($sliders) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Description</th>
                                    <th> Image </th>
                                    <th> Edit</th>
                                    <th> Delete</th>
                                    <th> Select All
                                    <input type="checkbox" id="check_all" />
                                    </th>                               
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $key => $slider)
                                    <tr>
                                        <td class="slider_id" value="{{$slider->id}}">{{ $key + 1}} </td>
                                        <td>{!! $slider->description !!}</td>                                 
                                        <td>
                                            <a href="{{action('Admin\SliderController@getEditSlider', $slider->id)}}"><img src="/uploads/{{ $slider->image }}" width="220" height="70" class="img-rounded show-image" alt="Cinque Terre" width="204" height="136"></a>
                                        </td>
                                        <td>
                                            <a href="{{action('Admin\SliderController@getEditSlider', $slider->id)}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit 
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline btn-circle dark btn-sm red show_modal" data-toggle="modal" href="#small" alt="{{$slider->id}}" >
                                                <i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                        <td>
                                            <span style="margin-left: 65px">
                                                <input type="checkbox" value="{{$slider->id}}" class="slider_check{{$slider->id}} check-list"></input>
                                            </span>
                                        </td>                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Sliders</h3>
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
                    <h4 class="modal-title">Delete Slider </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" id="delete_slider"><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-sm" id="slidersList" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Selected Sliders </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a data-dismiss="modal" class="delete_sliders" @if (count($sliders) > 0) data-count="{{$sliders->last()->id}}" @endif><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
{!! HTML::script(asset('assets/js/delete_sliders.js')) !!}
{!! HTML::script(asset('assets/js/check_all.js')) !!}
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');
            $('#delete_slider').attr('href','/admin/slider/delete-slider/'+id);
        });
    </script>
@endsection