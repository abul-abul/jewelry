    {!! HTML::style( asset('assets/bootstrap/css/bootstrap.min.css')) !!}
    <!-- Bootstrap datetimepicker -->
    {!! HTML::style( asset('assets/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css')) !!}

    <!-- Icon Fonts -->
    {!! HTML::style( asset('assets/css/fonts/font-awesome-4.6.3/css/font-awesome.css')) !!}

    <!-- Owl Carousel /Assets -->
    {!! HTML::style( asset('assets/vendor/owl-carousel/owl.carousel.css')) !!}
    {!! HTML::style( asset('assets/vendor/owl-carousel/owl.theme.css')) !!}
    {!! HTML::style( asset('assets/vendor/owl-carousel/owl.transitions.css')) !!}

    
    <!-- bxslider -->
    {!! HTML::style( asset('assets/vendor/bxslider/jquery.bxslider.css')) !!}
    <!-- flexslider -->
    <link rel="stylesheet" href="/assets/vendor/flexslider/flexslider.css" media="screen">

    <!-- Theme -->
    {!! HTML::style( asset('assets/css/theme-animate.css')) !!}
    {!! HTML::style( asset('assets/css/theme-elements.css')) !!}
    {!! HTML::style( asset('assets/css/theme-blog.css')) !!}
    {!! HTML::style( asset('assets/css/theme-shop.css')) !!}
    {!! HTML::style( asset('assets/css/theme.css')) !!}
    {!! HTML::style( asset('assets/css/bootstrap-social.css')) !!}


    <!-- Style Switcher-->
    {!! HTML::style( asset('assets/style-switcher/css/style-switcher.css')) !!}
    <link href="/assets/css/colors/red/style.css" rel="stylesheet" id="layoutstyle">

    <!-- Theme Responsive-->
    {!! HTML::style( asset('assets/css/theme-responsive.css')) !!}

<!-- Begin Main -->
<div role="main" class="main">

	<!-- Begin 404 -->
	<div class="page-404">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center">
					<p class="ico-emotion"><i class="fa fa-frown-o"></i></p>
					<h2>404</h2>
					<p>Sorry but we couldn't find the page you are looking for. Please check to make sure you've typed the URL correctly.</p>
					<!-- <form class="form-inline form-search form-search2" class="form-inline" role="form">
						<div class="form-group">
							<label class="sr-only" for="textsearch">Enter text search</label>
							<input type="text" class="form-control input-lg" id="textsearch" placeholder="Enter text search">
						</div>
						<button type="submit" class="btn"><i class="fa fa-search"></i></button>
					</form> -->
					<p><a href="{{action('UserController@getIndex')}}" class="btn btn-primary btn-lg">Return to home</a></p>
				</div>
			</div>
		</div>
	</div>
	<!-- End 404 -->
	
</div>
<!-- End Main -->

