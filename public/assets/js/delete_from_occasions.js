$(document).ready(function(){
	$('.delete_occasions').click(function(){
		var id = $('.item_id').val();
		window.content =  $('.item_check'+id);
		var count = $(this).data('count');
		var itemArr = new Array();
		for(var i = 1; i <= count; i++)
		{
			var item = $('.item_check'+i).parent().attr('class')
			if(item == 'checked')
			{	
				checkedItem = $('.item_check'+i).val()			
				itemArr.push(checkedItem);
				$('.item_check'+i).parent().parent().parent().parent().remove();
			}else{
				continue;
			}
		}
		$.ajax({
			url:"/admin/item/delete-occasions",
			method:"GET",
			data:{itemArr:itemArr},
			success:function(data){
				$('#check_all').parent().attr('class', "");
			}
		})
		
	})
})