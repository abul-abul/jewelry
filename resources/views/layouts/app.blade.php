<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- <meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" /> -->

<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

    <meta charset="utf-8">
    <meta name="keywords" content="{{$meta_keywords}}" />
    <meta name="description" content="{{$meta_description}}" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:type" content="website" />
    <meta property="og:title" content="Oh scarlett" />
    <meta property="og:description" content="Some description" />
    @if(isset($shareImage))
    <meta property="og:url" content="{{$shareUrl}}" />
    <meta property="og:image" content="{{asset('assets/uploads/'.$shareImage)}}" />
    @endif

    <meta name="twitter:card" content="photo" />
    <meta name="twitter:site" content="@flickr" />
    <meta name="twitter:title" content="OhScarlett" />
    @if(isset($shareImage))
    <meta name="twitter:image" content="{{asset('assets/uploads/'.$shareImage)}}" />
    <meta name="twitter:url" content="{{$shareUrl}}" />
    @endif

    <title>{{$title}}</title>
    @if($title != 'Create an Account | Jewelry Shop')
    {{Session::forget('_old_input')}}
    @endif


    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
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
    @yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Theme Responsive-->
<!--     <link href="assets/css/theme-responsive.css" rel="stylesheet"> -->

        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->



</head>
<body >

        <div id="page">
            @include ('users.header')            
            @yield('content')
        </div>
   
        
    
@include('users.footer')


         <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <!-- <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
        <!-- <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script> -->
        <!-- <script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> -->
        <!-- <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> -->
        <!-- <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script> -->
        <!-- <script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> -->
        <!-- <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> -->
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <!-- <script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script> -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <!-- <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script> -->
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- <script src="../assets/pages/scripts/profile.min.js" type="text/javascript"></script> -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script> -->
        <!-- <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script> -->
        <!-- <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
        <!-- END THEME LAYOUT SCRIPTS -->




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! HTML::script( asset('assets/vendor/jquery.min.js')) !!} 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script> -->
    {!! HTML::script( asset('assets/global/plugins/js.cookie.min.js')) !!}
    {!! HTML::script( asset('assets/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')) !!}
    {!! HTML::script( asset('assets/bootstrap/js/bootstrap.min.js')) !!}
    {!! HTML::script( asset('assets/bootstrap/js/bootstrap-hover-dropdown.min.js')) !!}
    {!! HTML::script( asset('assets/vendor/owl-carousel/owl.carousel.js')) !!}
    {!! HTML::script( asset('assets/vendor/modernizr.custom.js')) !!}
    {!! HTML::script( asset('assets/vendor/jquery.stellar.js')) !!}
    {!! HTML::script( asset('assets/vendor/imagesloaded.pkgd.min.js')) !!}
    {!! HTML::script( asset('assets/vendor/masonry.pkgd.min.js')) !!}
    {!! HTML::script( asset('assets/vendor/jquery.pricefilter.js')) !!}
    {!! HTML::script( asset('assets/vendor/bxslider/jquery.bxslider.min.js')) !!}
    {!! HTML::script( asset('assets/vendor/mediaelement-and-player.js')) !!}
    {!! HTML::script( asset('assets/vendor/waypoints.min.js')) !!}
    {!! HTML::script( asset('assets/vendor/flexslider/jquery.flexslider-min.js')) !!}
    {!! HTML::script( asset('assets/vendor/jquery.validation/jquery.validation.js')) !!}
    {!! HTML::script( asset('assets/bootstrap/datetimepicker/js/moment.js')) !!}
    {!! HTML::script( asset('assets/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js')) !!}

    {!! HTML::script( asset('assets/js/showitem.js')) !!}
    {!! HTML::script( asset('assets/js/addtocart.js')) !!}
    {!! HTML::script( asset('assets/js/deletecart.js')) !!}
    {!! HTML::script( asset('assets/js/counter.js')) !!}
    {!! HTML::script( asset('assets/js/addtocartbutton.js')) !!}
    {!! HTML::script( asset('assets/js/updatequantity.js')) !!}
    {!! HTML::script( asset('assets/js/addtofavorites.js')) !!}
    {!! HTML::script( asset('assets/js/remove_from_order_list.js')) !!}
    {!! HTML::script( asset('assets/js/show_last_item.js')) !!}
    {!! HTML::script( asset('assets/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')) !!}
    {!! HTML::script( asset('assets/js/deletefavorite.js')) !!}
    {!! HTML::script( asset('assets/js/currency.js')) !!}
    {!! HTML::script( asset('assets/js/getSession.js')) !!}
    {!! HTML::script( asset('assets/js/collection_style.js')) !!}
    {!! HTML::script( asset('/assets/js/jquery.dotdotdot.js')) !!}
    {!! HTML::script( asset('/assets/js/footer_login.js')) !!}
    {!! HTML::script( asset('assets/js/close_modal.js')) !!}
    {!! HTML::script( asset('assets/js/jquery.query-object.js')) !!}

    
    <!-- Theme Initializer -->
    {!! HTML::script( asset('assets/js/theme.plugins.js')) !!}
    {!! HTML::script( asset('assets/js/theme.js')) !!}

    
    <!-- Style Switcher -->
    {!! HTML::script( asset('assets/style-switcher/js/switcher.js')) !!}
    {!! HTML::script( asset('assets/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')) !!}
    {!! HTML::script( asset('assets/js/scroll_down.js')) !!}
    @if(isset($status))
    <!-- Google Map -->
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    {!! HTML::script( asset('assets/vendor/jquery.gmap.js')) !!}
    <script>

        /*
        Map Settings

            Find the Latitude and Longitude of your address:
                - http://universimmedia.pagesperso-orange.fr/geo/loc.htm
                - http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

        */

        // Map Markers
        var mapMarkers = [{
            address: "1234 Pine Shade Pl, Salt Lake City, UT 84118",
            html: "<strong>Flatize Shop</strong><br>123 Name Ave, Suite 600, Salt Lake City, UT 84118<br><br>",
            popup: false,
            icon: {
                image: "images/maker.png",
                iconsize: [28, 42],
                iconanchor: [28, 32]
            }
        }];

        // Map Initial Location
        var initLatitude = 40.65610;
        var initLongitude = -112.02586;

        // Map Extended Settings
        var mapSettings = {
            controls: {
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: true,
                overviewMapControl: true
            },
            scrollwheel: false,
            markers: mapMarkers,
            latitude: initLatitude,
            longitude: initLongitude,
            zoom: 15
        };

        var map = $("#googlemaps").gMap(mapSettings);

        // Map Center At
        var mapCenterAt = function(options, e) {
            e.preventDefault();
            $("#googlemaps").gMap("centerAt", options);
        }

    </script>
    @endif
    
    @yield('script')
   

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

</body>
</html>