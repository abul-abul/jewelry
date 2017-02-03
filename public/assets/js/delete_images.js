$(document).ready(function(){
	$('.delete_images').click(function(){
		var count = $(this).data('count');
		var imageArr = new Array();
		for(var i = 1; i <=200; i++)
		{
			var checked = $('.image_check'+i).parent().attr('class');
			
			if(checked == 'checked')
			{
				var article = $('.image_check'+i).val();
				imageArr.push(article);
			}else{
				continue;
			}
		}
		$.ajax({
			url:"/admin/item/delete-images",
			method:"GET",
			data:{imageArr:imageArr},
			success:function(data){
				for(var j=0; j<imageArr.length; j++ )
				{
					$('.image_check'+imageArr[j]).closest("tr").remove();
				}
				$('#check_all').parent().attr('class', "");
			}
		})
	})
})