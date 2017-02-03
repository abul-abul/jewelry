$('.gemstone_checkbox').click(function() {
    if($(this).attr('data-checked') == "unchecked"){
        $(this).attr('data-checked', 'checked');
    }else{
        $(this).attr('data-checked', 'unchecked');
    }
    if($(this).attr('data-checked') == 'checked'){
    if($('#gemstone_check').val() == "unchecked")
    {
        $('#gemstone_check').val('checked');
    }
    }
    if($('.gemstone_checkbox').attr('data-checked') == 'unchecked')
{
    $('#gemstone_check').val('unchecked');
}	
})


$('.metal_checkbox').click(function() {
    if($(this).attr('data-checked') == "unchecked"){
        $(this).attr('data-checked', 'checked');
    }else{
        $(this).attr('data-checked', 'unchecked');
    }
    if($(this).attr('data-checked') == 'checked'){
    if($('#metal_check').val() == "unchecked")
    {
        $('#metal_check').val('checked');
    }
    }
    if($('.metal_checkbox').attr('data-checked') == 'unchecked')
{
    $('#metal_check').val('unchecked');
}
})


$('.size_checkbox').click(function() {
    if($('#size_check').val() == "unchecked")
    {
        $('#size_check').val('checked');
    }else{
        $('#size_check').val('unchecked');
    }
})
