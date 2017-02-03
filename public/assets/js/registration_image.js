$('.registration-image').on('click', function(e){
	e.preventDefault;
	$('.show-image').attr('src', 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image');
	$(this).attr('style', 'display:none');
})

$('.profile-pic-upload').on('click', function(e){
	e.preventDefault;
	setTimeout(function(){ 
               $('.registration-image').attr('style', ''); },1000);

	
})