@foreach($images as $image)
<tr>    
    <td>
        <a href="#" class="fancybox-button" data-rel="fancybox-button">
            <img class="img-responsive" src="{{URL::asset('/uploads/'.$image->name)}}" alt="">
        </a>
    </td>
    <td>                                            
        <label class="radio-inline">
        @if($image->id == $item->main_image_id)
            <input checked="checked" class="main_image_radio" type="radio" name="main_image_id" value="{{$image->id}}"   style="cursor:pointer">
        @else
            <input type="radio" class="main_image_radio" name="main_image_id" value="{{$image->id}}"   style="cursor:pointer">
        @endif
        </label>
        
    </td>
    <td>
        <a class="red delete-image" data-id = "{{$image->id}}" data-name = "{{$image->name}}"><i class="glyphicon glyphicon-trash red"></i></a>
    </td>
</tr>
@endforeach