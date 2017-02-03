$(document).ready(function(){
	$('.delete_collections').click(function(){
		var id = $('.coll_id').text();
		window.content = $('.coll_check'+id);
		var count = $(this).data('count');
		var collArr = new Array();
		for(var i=1; i <= count; i++ )
		{
			var checked = $('.coll_check'+i).parent().attr('class');
			if(checked == "checked")
			{
				var collection = $('.coll_check'+i).val();
				collArr.push(collection);
				$('.coll_check'+i).closest("tr").remove();
			}else{
				continue;
			}
		}
		$.ajax({
			url:"/admin/collection/delete-collections",
			method:"GET",
			data:{collArr:collArr},
			success:function(data){ 
				$('#check_all').parent().attr('class', "");
			}
		})
	})
})