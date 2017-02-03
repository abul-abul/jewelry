function counter(val)
{
	window.id = '';
	$('.xxxx').click(function(){
		id = $(this).attr('data-id');
		
	})
	
	setTimeout(function(){
		var qty = $("#"+id).val();
		var new_qty = parseInt(qty, 10) + val;
		count = parseInt( $("#"+id).attr('maxquantity'));
		if(new_qty < 1)
		{ 
			new_qty = 1;
		}
		if(new_qty > count)
		{
			new_qty = count;
		}
		
		$("#"+id).val(new_qty);
		return new_qty;
	},1)
}