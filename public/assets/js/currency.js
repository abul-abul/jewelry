$(document).ready(function(){
	$('#currency').change(function(){
		var currency = $("#currency option:selected").val();
		$.ajax({
			url:"/item/change-currency",
			method:"GET",
			data:{currency:currency},
			success:function(data){
			}
		})

	})
})