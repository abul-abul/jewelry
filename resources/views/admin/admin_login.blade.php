<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        {!! HTML::style( asset('assets/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css')) !!}
        {!! HTML::style( asset('assets/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')) !!}
        {!! HTML::style( asset('assets/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css')) !!}
        {!! HTML::style( asset('assets/metronic/assets/global/plugins/uniform/css/uniform.default.css')) !!}
        {!! HTML::style( asset('assets/metronic/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')) !!}
        {!! HTML::style( asset('assets/metronic/assets/global/plugins/select2/css/select2.min.css')) !!}
        {!! HTML::style( asset('assets/metronic/assets/global/css/components.min.css')) !!}
        {!! HTML::style( asset('assets/metronic/assets/global/css/plugins.min.css')) !!}

        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        {!! HTML::style( asset('assets/metronic/assets/pages/css/login.min.css')) !!}
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <div class="menu-toggler sidebar-toggler"></div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="../assets/pages/img/logo-big.png" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            {!! Form::open(['action' => ['AdminController@postLogin'],'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
                <h3 class="form-title font-green">Sign In</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">E-mail</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="E-mail" name="email" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">Login</button>
                </div>
            {!!Form::close()!!}
            <!-- END LOGIN FORM -->
            
        </div>
        <div class="copyright"> 2014 © Metronic. Admin Dashboard Template. </div>
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/jquery.min.js')) !!}
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js')) !!}
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/js.cookie.min.js')) !!}
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')) !!}
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')) !!}
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/jquery.blockui.min.js')) !!}
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/uniform/jquery.uniform.min.js')) !!}
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')) !!}
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')) !!}
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/jquery-validation/js/additional-methods.min.js')) !!}
        {!! HTML::script( asset('assets/metronic/assets/global/plugins/select2/js/select2.full.min.js')) !!}

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        {!! HTML::script( asset('assets/metronic/assets/global/scripts/app.min.js')) !!}
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {!! HTML::script( asset('assets/metronic/assets/pages/scripts/login.min.js')) !!}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>