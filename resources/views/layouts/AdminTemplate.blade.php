<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->

<head>
    <!-- Hey search engines! Don't index this page -->
    <meta name="robots" content="noindex">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('preTitle') | {{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/selectFX/css/cs-skin-elastic.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">
                    <img src="{{ asset('OtherImages/logo.png') }}" alt="Logo">
                </a>
                <a class="navbar-brand hidden" href="./">
                    <img src="{{ asset('images/logo2.png') }}" alt="{{ config('app.name') }}">
                </a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('AdminIndex') }}"@if(isset($dashboardLink)){{ ' class="active"' }} @endif> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title"></h3><!-- /.menu-title -->
                    <li>
                        <a href="{{ route('newCarForm') }}"@if(isset($newCarPostLink)){{ ' class="active"'}} @endif> <i class="menu-icon fa fa-th"></i>Create new car post </a>
                    </li><?php /*
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Categories of Vehicles</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{ route('types') }}"@if(isset($vehicleTypesLink)){{ ' class="active"'}} @endif>List of Vehicle Categories</a></li>
                        </ul>
                    </li>*/ ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Types of Vehicles</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{ route('types') }}"@if(isset($vehicleTypesLink)){{ ' class="active"'}} @endif>List of Vehicle Types</a></li>
                            <li><i class="fa fa-table"></i><a href="{{ route('newCarTypeForm') }}"@if(isset($newVehicleTypeLink)){{ ' class="active"'}} @endif>Create Vehicle Type</a></li>{{--
                            <li><i class="fa fa-table"></i><a href="#"@if(isset($activeTypeEdit)){{ 'class="active"' }} @endif>Edit Vehicle Type</a></li>--}}
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Brands of Vehicles</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{ route('brands') }}"@if(isset($vehicleBrandsLink)){{ 'class="active"' }} @endif>List of Vehicle Brands</a></li>
                            <li><i class="fa fa-table"></i><a href="{{ route('newCarBrandForm') }}"@if(isset($newVehicleBrandLink)){{ 'class="active"' }} @endif>Create Vehicle Brand</a></li>{{--
                            <li><i class="fa fa-table"></i><a href="#"@if(isset($activeBrandEdit)){{ 'class="active"' }} @endif>Edit Vehicle Brand</a></li>--}}
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-id-card-o"></i>Vehicles</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-card-o"></i><a href="{{ route('newCarForm') }}"@if(isset($newVehicleLink)){{ 'class="active"' }} @endif>Create Vehicle</a></li>{{--
                            <li><i class="fa fa-id-card-o"></i><a href="#"@if(isset($activeVehicleEdit)){{ 'class="active"' }} @endif>Edit Vehicle</a></li>--}}
                            <li><i class="fa fa-table"></i><a href="{{ route('posts') }}"@if(isset($vehiclesLink)){{ 'class="active"' }} @endif>List of Vehicles</a></li>
                            <li><i class="fa fa-table"></i><a href="{{ route('soldCars') }}"@if(isset($vehicleSoldsLink)){{ 'class="active"' }} @endif>List of Sold Vehicles</a></li>
                            <li><i class="fa fa-table"></i><a href="{{ route('usedCars') }}"@if(isset($vehicleUsedsLink)){{ 'class="active"' }} @endif>List of Used Vehicles</a></li>
                            <li><i class="fa fa-table"></i><a href="{{ route('newCars') }}"@if(isset($vehicleNewLink)){{ 'class="active"' }} @endif>List of New Vehicles</a></li>
                        </ul>
                    </li>
<?php /*
                    <h3 class="menu-title"></h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-id-badge"></i>Images</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-tasks"></i><a href="{{ route('images') }}"@if(isset($vehicleImagesLink)){{ 'class="active"' }} @endif>List of images</a></li>
                            <li><i class="menu-icon fa fa-id-badge"></i><a href="#"@if(isset($vehicleImagesEditLink)){{ 'class="active"' }} @endif>Editing image</a></li>
                        </ul>
                    </li>
*/ ?>
                    <h3 class="menu-title"></h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-id-card-o"></i>News & Events</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-card-o"></i><a href="{{ route('newEventForm') }}"@if(isset($newEventLink)){{ 'class="active"' }} @endif>Create Event</a></li>
                            <li><i class="fa fa-table"></i><a href="{{ route('events') }}"@if(isset($eventsLink)){{ 'class="active"' }} @endif>List of Events</a></li>
                        </ul>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left">
                        <i class="fa fa fa-tasks"></i>
                    </a>
                    <div class="header-left">
                        <div class="dropdown for-notification">
                            <a href="{{ route('landingPageRedirect') }}" style="color: black;">
                                {{ config('app.name') }} Home
                            </a>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                        </div>

                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </a>

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('images/favicon.png') }}" alt="">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>
                            <a class="nav-link" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <p>{{-- Auth::user()->name --}}</p>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <!-- Respective page's content here -->
        @yield('content')

    </div><!-- /#right-panel -->
    <!-- Right Panel -->

    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="{{ asset('vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>
</html>