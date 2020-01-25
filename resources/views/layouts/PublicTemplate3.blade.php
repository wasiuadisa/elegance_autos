<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('preTitle') | {{ config('app.name') }} - {{ config('app.slogan') }}</title>
    <meta name="description" content="@yield('metaDescription') {{ config('app.name') }}">
    <meta name="keywords" content="@yield('metaKeywords')">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Wasiu Adisa = aowasiu@gmail.com">
    <link rel="shortcut icon" href="{{ asset('publicAssets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('publicAssets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('publicAssets/css/bootstrap-responsive.min.css') }}">
    <link rel="stylesheet" href="{{ asset('publicAssets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('publicAssets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('publicAssets/css/sl-slide.css') }}">
    <script src="{{ asset('publicAssets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
    @yield('contentCSS')
    @yield('extraHeadContent')
</head>

<body>
    <!--Header-->
    <header class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a id="logo" class="pull-left" href="{{ route('landingPage') }}"></a>
                <div class="nav-collapse collapse pull-right">
                    <ul class="nav">
                        <li class="active"><a href="{{ route('landingPage') }}">Home</a></li>
                        <li><a href="{{ route('publicAbout') }}">About Us</a></li>
                        <li><a href="{{ route('publicInstock') }}">Vehicles in stock</a></li>
                        <li><a href="{{ route('publicNews') }}">News & Events</a></li>
                        <li><a href="{{ route('publicContact') }}">Contact us</a></li>
                    </ul>        
                </div>
            </div>
        </div>
    </header>
    <!-- / .title -->
    <!-- / .PAGE CONTENT BEGINS HERE -->
    
    @yield('content')

    <!-- / .PAGE CONTENT ENDS HERE -->
    <!--Bottom-->
    <section id="bottom" class="main">
        <!--Container-->
        <div class="container">
            <!--row-fluids-->
            <div class="row-fluid">
                <!--Contact Info-->
                <div class="span6">
                    <h4>CONTACT US</h4>
                    <ul class="unstyled address">
                        <li>
                            <i class="icon-home"></i><strong>Address:</strong>{{ config('app.address') }}
                        </li>
                        <li>
                            <i class="icon-envelope"></i>
                            <strong>Email: </strong> <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>
                        </li>
                        <li>
                            <i class="icon-globe"></i>
                            <strong>Website:</strong> <a href="{{ config('app.full_domain') }}">{{ config('app.short_domain') }}</a>
                        </li>
                        <li>
                            <i class="icon-phone"></i>
                            <strong>Telephone:</strong> {{ config('app.phone') }}
                        </li>
                    </ul>
                </div>
                <!--End Contact Info-->
                <!--Important Links-->
                <div id="tweets" class="span6">
                    <h4>{{ config('app.name') }}</h4>
                    <div>
                        <ul class="arrow">
                            <li><a href="{{ route('publicAbout') }}">About Us</a></li>
                            <li><a href="{{ route('publicInstock') }}">Vehicles in stock</a></li>
                            <li><a href="{{ route('publicNews') }}">News & Events</a></li>
                            <li><a href="{{ route('publicContact') }}">Contact Us</a></li>
                            <li><a href="{{ route('login') }}">Administration</a></li>
                        </ul>
                    </div>  
                </div>
            </div>
            <!--/row-fluid-->
        </div>
        <!--/container-->
    </section>
    <!--/bottom-->

    <!--Footer-->
    <footer id="footer">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 cp">
                    © <?php
             if( date('Y') > 2017 )
             {
                printf( '2017 - ' . date('Y') );
             }
             else {
                printf( date('Y') );
             }
             ?> <a target="_blank" href="http://www.eleganceautos.com/">{{ config('app.name') }}</a>. All Rights Reserved.
                </div>
                <div class="span5">
                    <ul class="social pull-right">
                        <li><a href="{{ config('app.facebook') }}"><i class="icon-facebook"></i></a></li>
                        <li><a href="{{ config('app.twitter') }}"><i class="icon-twitter"></i></a></li>
                        <li><a href="{{ config('app.google') }}"><i class="icon-google-plus"></i></a></li>
                    </ul>
                </div>
                <div class="span1">
                </div>
            </div>
        </div>
        <div class="container" style="background-color: #232323; border-top: 10px;">
            <div class="row-fluid">
                <div class="span4">
                </div>
                <div class="span7">
                    <ul class="social text-center">
                        <li style="color: white;">{{ config('app.name') }} is powered by <a href="http://www.wasiuadisa.com" style="color: white;">WasiuAdisa.com</a></li>
                    </ul>
                </div>
                <div class="span1">
                    <a id="gototop" class="gototop pull-right" href="#"><i class="icon-angle-up"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->

    <script src="{{ asset('publicAssets/js/vendor/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('publicAssets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('publicAssets/js/main.js') }}"></script>
    <script src="{{ asset('publicAssets/js/jquery.ba-cond.min.js') }}"></script>
    <script src="{{ asset('publicAssets/js/jquery.slitslider.js') }}"></script>
    <!-- Slider -->
    <script type="text/javascript"> 
    $(function() {
        var Page = (function() {
            var $navArrows = $( '#nav-arrows' ),
            slitslider = $( '#slider' ).slitslider( {
                autoplay : true
            } ),
            init = function() {
                initEvents();
            },
            initEvents = function() {
                $navArrows.children( ':last' ).on( 'click', function() {
                    slitslider.next();
                    return false;
                });
                $navArrows.children( ':first' ).on( 'click', function() {
                    slitslider.previous();
                    return false;
                });
            };
            return { init : init };
        })();
        Page.init();
    });
    </script>
    <!-- /Slider -->
</body>
</html>