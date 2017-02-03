$('.non-logged-in-like').on("click", function(){
	$('.login-wrapper').addClass('open');
    $('.header_fac').removeClass('open');
    $('.navbar-toggle').addClass('collapsed');
    $('.navbar-collapse1').removeClass('in');
	$('html, body').animate({
          scrollTop: $('.login-wrapper').offset().top
      }, 'slow');
});

