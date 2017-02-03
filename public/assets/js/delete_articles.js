$(document).ready(function(){
	$('.delete_articles').click(function(){
		var count = $(this).data('count');
		var articleArr = new Array();
		for(var i = 1; i <=count; i++)
		{
			var checked = $('.article_check'+i).parent().attr('class');
			if(checked == 'checked')
			{
				var article = $('.article_check'+i).attr('id');
				articleArr.push(article);
				// $('.article_check'+i).parent().parent().parent().parent().remove();
			}else{
				continue;
			}
		}
		$.ajax({
			url:"/admin/blog/delete-articles",
			method:"GET",
			data:{articleArr:articleArr},
			success:function(data){
				for(var j=0; j<articleArr.length; j++ )
				{
					$('.article_check'+articleArr[j]).closest("tr").remove();
				}
				$('#check_all').parent().attr('class', "");
			}
		})
	})
})