@extends('admin.dashboard')
@section('content')
<style type="text/css">
    .delete-article:focus {
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
                    <div class="caption"><i class="icon-list"></i>Articles
                    </div>   
                    <div class="tools">
                        <a href="{{URL::to('admin/blog/create-article')}}" style="color:white">Add </a>
                        <a href="#articlesList" data-toggle="modal" style="color:white">/ Delete</a>
                    </div>

                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($articles) > 0)
                    <table class="table table-bordered table-hover"> 
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Title</th>
                                    <th> Image </th>
                                    <th> Video </th> 
                                    <th> Edit </th>
                                    <th> Delete </th>
                                    <th> Select All
                                    <input type="checkbox" id="check_all" />
                                    </th>                            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articleArr[$page-1] as $key => $article)
                                    <tr>
                                        <td>{{($page-1)*10 + $key + 1}}</td>
                                        <td>
                                            <a href="/admin/blog/edit-article/{{$article->id}}">{{$article->title}}</a>
                                        </td>
                                        <td>
                                        @if($article->image)
                                        <a href="/admin/blog/edit-article/{{$article->id}}"><img src="/uploads/{{$article->image}}" alt="Photo" width="220" height="auto" class="img-rounded show-image"></a>
                                        @else
                                        <a href="/admin/blog/edit-article/{{$article->id}}"><img class="img-rounded show-image"  src="{{URL::asset('/default/default_img.jpg')}}" alt="Photo" width="220" height="100"/></a>
                                        @endif
                                        </td>
                                        <td>
                                        @if($article->video)
                                        <iframe width="220" height="100" src='https://www.youtube.com/embed/{{$article->video}}'></iframe>
                                        @endif</td>
                                        <td>
                                            <a href="/admin/blog/edit-article/{{$article->id}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline btn-circle dark btn-sm red show_modal delete-article" data-toggle="modal" href="#small" alt="{{$article->id}}" >
                                                <i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                        <td>
                                            <span style="margin-left: 65px">
                                                <input class="article_check{{$article->id}} check-list" id="{{$article->id}}" type="checkbox"></input>
                                            </span>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                        @if($page-1 > 0)
                        <a href="/admin/blog/articles/{{$page-1}}"><button>Previous</button></a>
                        @endif
                        <button>{{$page}}</button>
                        @if($page < $maxPage)
                        <a href="/admin/blog/articles/{{$page+1}}"><button>Next</button></a>
                        @endif
                        </div>
                    @else
                        <h3>No Articles</h3>
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
                    <h4 class="modal-title">Delete Article </h4>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" id="delete_article"><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-sm" id="articlesList" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete selected Articles </h4>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a class="delete_articles" data-dismiss="modal" @if (count($articles) > 0) data-count="{{$articles->first()->id}}" @endif ><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('scripts')
{!! HTML::script(asset('assets/js/delete_articles.js')) !!}
{!! HTML::script(asset('assets/js/check_all.js')) !!}
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');
            $('#delete_article').attr('href','/admin/blog/delete-article/'+id);
        });
    </script>
@endsection