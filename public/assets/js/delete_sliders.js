$(document).ready(function(){
	$('.delete_sliders').click(function(){
		var count = $(this).data('count');
		var sliderArr = new Array();
		for(var i=1; i<=count; i++) 
		{
			checked = $('.slider_check'+i).parent().attr('class');
			if(checked == 'checked')
			{
				slider = $('.slider_check'+i).val();
				sliderArr.push(slider);
				$('.slider_check'+i).closest("tr").remove();
			}
		}
		console.log($('.slider_check1').parent().attr('class'));
		$.ajax({
			url:"/admin/slider/delete-sliders",
			method:"GET",
			data:{sliderArr:sliderArr},
			success:function(data){
				$('#check_all').parent().attr('class', "");
			}
		})
	})
})