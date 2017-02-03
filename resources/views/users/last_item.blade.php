 {!! HTML::style( asset('/new-css/last-item.css')) !!}
<h3>Recently added item</h3>
<ul class="list-unstyled list-thumbs-pro">
   
    <li class="product">
    @if($last_item)
        <div class="product-thumb-info last_item" style="border: none;">
            <div class="product-thumb-info-image col-md-6"> 
                @if($main_image)
                    <a href="{{URL::to('item/item',[$last_item->category->category, $last_item->slug])}}"><img id="last_item_main_image" src="{{URL::asset('/uploads/'.$main_image->name)}}" class="img-responsive last-item-main-image" alt="{{$last_item->alt}}" width="120%" height="120%"></a>
                @else
                    <a href="{{URL::to('item/item',[$last_item->category->category, $last_item->slug])}}"><img id="last_item_main_image" src="{{URL::asset('/default/default_img.jpg')}}" class="img-responsive last-item-no-image" alt="{{$last_item->alt}}"></a>

                @endif
            </div>
            
            <div class="product-thumb-info-content">
                <h4><a href="{{URL::to('item/item',[$last_item->category->category, $last_item->slug])}}" id="last_item_title">{{$last_item->title}}</a></h4>
                <span class="item-cat"><small><a href="{{URL::to('item/items',['category', $last_item->category->category, 'noSort'])}}" id="last_item_category">{{$last_item->category->category}}</a></small></span>
<!--                 @if($last_item->new_price) -->
                <span class="item_price" id="last_item_price">{{rtrim(rtrim(Currency::format($last_item->new_price, $currency), 0), '.')}}</span>
<!--                 @else
                <span class="price" id="last_item_price">${{$last_item->price}}</span>
                @endif -->
            </div>
        </div>
    @else
        <div class="product-thumb-info empty" style="border: none;">
            <span>Your cart is empty.</span>
        </div>
    @endif
    </li>
   
</ul>
<ul class="list-inline cart-subtotals text-right">
    <li class="cart-subtotal"><strong>Subtotal :</strong></li>
    <li ><span class="amount"><strong id="header_subtotal">{{rtrim(rtrim(Currency::format($subtotal, $currency), 0), '.')}}</strong></span></li>
</ul>


<div class="cart-buttons text-right">
@if(Auth::user())
    <a href = "{{URL::to('order/ordered-items')}}" class="btn btn-white btn-order-history">Order History</a>     
@endif                   
  <a href = "{{URL::to('cart/shopping-cart')}}" class="btn btn-white btn-view-cart">View Cart</a>
</div>