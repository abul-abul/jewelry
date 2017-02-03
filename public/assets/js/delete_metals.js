$(document).ready(function(){
	$('.delete_selected_metals').click(function(){
		var count = $(this).data('count');
		var metalArr = new Array();
		for(var i=1; i <= count; i++)
		{
			var checked = $('.metal_check'+i).parent().attr('class');
			if(checked == 'checked')
			{
				var metal = $('.metal_check'+i).val(); 
				metalArr.push(metal);
				// console.log($('.metal_check'+i).parent().parent().parent().parent().attr('class'));
				$('.metal_check'+i).closest("tr").remove();

			}else{
				continue;
			}
		}
		$.ajax({
			url:"/admin/metal/delete-metals",
			method:"GET",
			data:{metalArr:metalArr},
			success:function(data){
				$('#check_all').parent().attr('class', "");
			}
		})
	})
})