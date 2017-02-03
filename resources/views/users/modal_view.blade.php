<div class="row">
    <div class="col-sm-6">
        <div class="product-preview">
                <ul class="bxslider" id="slider1">
                    @if($imageCount != 0)
                    <li><img alt=""  style="width:100%; height:500px;" class="main_image" src="{{URL::asset('/uploads/'.$main_image)}}"></li>
                    @else
                        <li>
                        <a ><img src="{{URL::asset('/default/default_img.jpg')}}" class="img-responsive" alt="" style="width:100%; height:500px;"></a>
                        </li>
                    @endif  
                </ul>

                <ul class="list-inline bx-pager">
                    @foreach($item->images as $image)
                        <li><a data-slide-index="0">
                            <img alt="" class="img-responsive" src="{{URL::asset('/uploads/'.$image->name)}}" style="width:80px;height:80px">
                        </a></li>
                    @endforeach
                        
                </ul>
            </div>
    </div>
    <div class="col-sm-6">
        <div class="summary entry-summary">

            <h3 class="my-title">{{$item->title}}</h3>
            
            <div class="reviews-counter clearfix">
                <div class="rating five-stars pull-left">
                    <!-- <input type="number" class="rating" id="test" name="test" data-min="1" data-max="5" value="{{$item->rating}}">
                    <input type="hidden" id="it_id" data-id="{{$item->id}}">
                    <div class="star-bg"></div> -->
                </div>
            </div>

            <p class="price">
                <span class="amount">${{$item->price}}</span>
            </p>
                <div class="quantity pull-left">
                    {!! csrf_field() !!}
                    <input type="button" onclick="counter(-1)" class="minus xxxx" data-id="xx{{$item->id}}" value="-">
                    <input type="text" class="input-text qty xxxx" id="xx{{$item->id}}" title="Qty" value="1" name="quantity" min="1" step="1">
                    <input type="button" onclick="counter(1)" class="plus xxxx" data-id="xx{{$item->id}}" value="+">
                    <input type="hidden" value="1" name="user_id">
                    <input type="hidden" value="1" name="item_id">
                </div>
@if($cart)
                <button data-id="{{$item->id}}" data-title = "{{$item->title}}" data-category = "{{$item->category->category}}" data-price = "{{$item->new_price}}" class="btn-danger btn-lg btn-icon  add_cart"><i class="fa fa-shopping-cart"></i> Added</button>
                @else
                <button data-id="{{$item->id}}" data-title = "{{$item->title}}" data-category = "{{$item->category->category}}" data-price = "{{$item->new_price}}" class="btn btn-primary btn-icon  add_cart"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                @endif
            <br />
            <br />
            <ul class="list-unstyled product-meta">
                <li>Price:&nbsp;<span class="amount" >{{$item->price}} </span></li>
                <li>Discount:&nbsp;<span class="discount">{{$item->discount}} </span></li>
                <li>Collection:&nbsp;<span class="collection">{{$item->collection->name}} </span></li>
                <li>Category:&nbsp;<span class="category">{{$item->category->category}}</span></li>
            </ul>
            
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            @if ($errors->has())
                            <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#collapseOne">
                            @else
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            @endif
                                Description
                            </a> 
                        </h4>
                    </div>
                    @if ($errors->has())
                    <div id="collapseOne" class="panel-collapse collapse">
                    @else
                    <div id="collapseOne" class="panel-collapse collapse in">
                    @endif
                        <div class="panel-body"> 
                            <p>{{$item->description}}</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Reviews ({{$count}})</a> </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body post-comments">
                            <ul class="comments">
                                                @foreach($reviews as $review)
                                                <li>
                                                    <div class="comment">
                                                        <div class="comment-block">
                                                            <span class="comment-by"> <strong>{{$review->user->first_name}} {{$review->user->last_name}}</strong></span>
                                                            <span class="date"><small><i class="fa fa-clock-o"></i>{{$review->date}}</small></span>
                                                            <p>{{$review->review}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                                @if(Auth::user())
                                                {!! Form::open(['action' => ['User\ItemController@postAddReview',$item->id], 'class' => 'form-horizontal', 'role' => 'form' ]) !!}
                                                    {!! Form::textarea('review', null, ['class' => 'form-control','style'=>'height:100px' ]) !!}
                                                    <button class="btn btn-primary">Save</button>
                                                {!! Form::close() !!}
                                                @endif
                            </ul>
                            @if(Auth::user())
                                {!! Form::open(['action' => ['User\ItemController@postAddReview',$item->id], 'class' => 'form-horizontal', 'role' => 'form' ]) !!}
                                    {!! Form::textarea('review', null, ['class' => 'form-control','style'=>'height:100px' ]) !!}
                                    <button class="btn btn-primary">Save</button>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    @if(!Auth::user())
        <script type="text/javascript">
            setTimeout(function(){
                $('#test').parent().addClass("disabledbutton");
            },100)
        </script>
    @endif
{!! HTML::script( asset('/assets/js/rating.main.js')) !!}
{!! HTML::script( asset('/assets/js/item-rate.js')) !!}
@endsection
