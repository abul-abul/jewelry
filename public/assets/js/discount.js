$(function(){
	$(document).on('click', '#discount_button', function(){
        if ($('.icheck').is(':checked') == false) {
            $('#discount').fadeIn();
            setTimeout(function(){ 
                $('#delete_content_false').fadeOut(); },1000);
        } else {
            $('#discount').fadeIn(100);
            window.checks = [];
            $('.icheck').each(function(){
                if(($(this).prop('checked') == true)){
                    var checked = $(this).val();
                    checks.push(checked);
                    $('p').append($(this).attr('data-title'))
                }
            })
        }    
    })

	$('.modal_close').click(function(){
		window.checks = [];
        $('p').empty();
		$('#discount').fadeOut();
	})

	$('#set_discount').click(function(){
		$("#item-ids").val(window.checks);
		$("#item-from").submit();
	})
})