$(document).ready(function(){
	$('.delete_selected_items').click(function(){
		var id = $('.item_id').val();
		// window.content =  $('.item_check'+id);
		var count = $(this).data('count');
		var itemArr = new Array();
		for(var i = 1; i <= count; i++)
		{
			var item = $('.item_check'+i).parent().attr('class')
			if(item == 'checked')
			{	
				checkedItem = $('.item_check'+i).val();			
				itemArr.push(checkedItem);
			}else{
				continue;
			}
		}
		$.ajax({
			url:"/admin/item/delete-items",
			method:"GET",
			data:{itemArr:itemArr},
			success:function(data){
				for(var j=0; j<itemArr.length; j++)
				{
					$('.item_check'+itemArr[j]).closest("tr").remove();

				}
				$('#check_all').parent().attr('class', "");
			}
		})
		
	})
})