$(document).ready(function(){
	$('#status').change(function(){
		var status = $(this).val();
		var id = $(this).find(":selected").attr('id');
		$.ajax({
			url:"/admin/order/edit-order-status",
			type: "post",
			data: {
			    status:status,
                id:id
			},
			dataType: 'JSON',
			success:function(data){
				console.log(data);
			}
		})
	})
});