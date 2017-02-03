$(document).ready(function(){
	$('.hide_text').on('click', function(){
		console.log(1);
	},function(){
		$(this).attr('style', 'display: inline;'); 
	})
})