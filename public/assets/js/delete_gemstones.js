$(document).ready(function(){
	$('.delete_selected_gemstones').click(function(){
		var count = $(this).data('count');
		var gemstoneArr = new Array();
		for(var i=1; i<=count; i++)
		{
			var checked = $('.gemstone_check'+i).parent().attr('class');
			if(checked == 'checked')
			{
				var gemstone = $('.gemstone_check'+i).val();
				gemstoneArr.push(gemstone);
				$('.gemstone_check'+i).closest("tr").remove();
			} else{
				continue 
			}
		}
		$.ajax({
			url:"/admin/gemstone/delete-selected-gemstones",
			method:"GET",
			data:{gemstoneArr:gemstoneArr},
			success:function(){ 
				$('#check_all').parent().attr('class', "");
			}
		})
	})
})