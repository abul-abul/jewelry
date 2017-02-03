$('.footer-login').click(function() {
	var wrapper = $('.login-wrapper');
	
	if (wrapper.hasClass('open')) {
	  wrapper.removeClass('open');
	}
	else {
	  wrapper.addClass('open');
	}

	$('html, body').animate({
      scrollTop: $('.about-us').offset().top
  }, 'slow');
});