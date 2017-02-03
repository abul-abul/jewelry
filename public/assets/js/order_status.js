$(document).ready(function(){
	var status = $('.orderStatus').val();
	if(status == 'success')
	{
		$('#modalText').text('Thank You, Your Purchase Was Successful!');
		$('#orderStatus').modal('show');

	}
	if(status == 'error')
	{
		$('#modalText').text('Your balance is insufficient.');
		$('#orderStatus').modal('show');
	}
})