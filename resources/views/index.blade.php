
@extends('layouts.PublicTemplate1')

@section('preTitle') Home @endsection

@section('content')
    <!--Slider-->
    <section id="slide-show">
        <div id="slider" class="sl-slider-wrapper">
            <!--Slider Items-->    
            <div class="sl-slider">
                <!--Slider Item1-->
                <div class="sl-slide item1" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                    <div class="sl-slide-inner" style="background-color: green;">
                        <div class="container" style="background-color: green;">
                            <img class="pull-right" src="{{ asset('images/sample/slider/img1.png') }}" alt="" />
                            <h2>We care about your choice car</h2>
                            <h3 class="gap">So we keep top-of-the-range luxury cars in stock.</h3>
                        </div>
                    </div>
                </div>
                <!--/Slider Item1-->

                <!--Slider Item2-->
                <div class="sl-slide item2" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                    <div class="sl-slide-inner" style="background-color: green;">
                        <div class="container" style="background-color: green;">
                            <img class="pull-right" src="{{ asset('images/sample/slider/img2.png') }}" alt="" />
                            <h2>We know high-performance engines matter to you</h2>
                            <h3 class="gap">That's why we keep the best high-performance cars in stock.</h3>
                        </div>
                    </div>
                </div>
                <!--Slider Item2-->

                <!--Slider Item3-->
                <div class="sl-slide item3" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner" style="background-color: green;">
                        <div class="container" style="background-color: green;">
                            <img class="pull-right" src="{{ asset('images/sample/slider/img3.png') }}" alt="" />
                            <h2>We know you care about class</h2>
                            <h3 class="gap">So we have cars with class available for you.</h3>
                        </div>
                    </div>
                </div>
                <!--Slider Item3-->
            </div>
            <!--/Slider Items-->
        
            <!--Slider Next Prev button-->
            <nav id="nav-arrows" class="nav-arrows">
                <span class="nav-arrow-prev"><i class="icon-angle-left"></i></span>
                <span class="nav-arrow-next"><i class="icon-angle-right"></i></span> 
            </nav>
            <!--/Slider Next Prev button-->
        </div>
        <!-- /slider-wrapper -->           
    </section>
    <!--/Slider-->

<?php /*    <!-- Main-info --><!--
    <section class="main-info">
        <div class="container">
            <div class="row-fluid">
                <div class="span9">
                    <h4>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos</h4>
                    <p class="no-margin">Ut ultrices eu nunc vitae scelerisque. Praesent sollicitudin accumsan diam, sed tristique diam sodales ut. Ut volutpat tempor dignissim.</p>
                </div>
                <div class="span3">
                    <a class="btn btn-success btn-large pull-right" href="#">Nulla ornare varius</a>
                </div>
            </div>
        </div>
    </section>-->
    <!-- /Main-info -->
*/ ?>
    <!--Services-->
    <section id="services">
        <div class="container">
            <div class="center gap">
                <h3>Why buy from us</h3>
                <p class="lead">Well.. we don't like to blow our horn.. but...</p>
            </div>
            <div class="row-fluid">
                <div class="span4">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-globe icon-medium"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Delivery</h4>
                            <p>We deliver to your door step if you can't come in to pick up your choice car.</p>
                        </div>
                    </div>
                </div>            
                <div class="span4">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-thumbs-up-alt icon-medium"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Good conditions</h4>
                            <p>We only sell cars that run. So you can be rest assured you're driving off your choice car right after purchase.</p>
                        </div>
                    </div>
                </div>            
                <div class="span4">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-shopping-cart icon-medium"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">E-transaction</h4>
                            <p>There's no need to worry about carrying enormous cash around. We've provisions for electronic payment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/Services-->

    <!--Work-->
    <section id="recent-works">
        <div class="container">
            <div class="center">
                <h3>Most recent additions</h3>
                <p class="lead">Check our Vehicle stock from the link above for all available vehicles.</p>
            </div>  
            <div class="gap"></div>
            <ul class="gallery col-4">

                @if (count($recents) > 0)
                @foreach($recents as $recent)
                <!--Item--><?php 
$imageFilename = (new \App\Models\Logic\Images)->topImage($recent->id);

if( count($imageFilename) < 1 )
{
    $imageFilename = 'defaultImage.jpg';
}

?>
                <!--Item-->
                <li>
                    <div class="preview">
                        <?php /*<img src="{{ asset('VehiclesInStock/images') . '/' . ( $imageFilename->disk_image_filename ? $imageFilename->disk_image_filename : 'defaultImage.jpg') }}" alt="{{ ucfirst($imageFilename->caption) . ' | ' . $recent->title }}">*/ ?>
                        @if ($imageFilename->disk_image_filename != 'defaultImage.jpg')
                        <img src="{{ asset('VehiclesInStock/images') . '/' . ( $imageFilename->disk_image_filename ? $imageFilename->disk_image_filename : 'defaultImage.jpg') }}" alt="{{ ucfirst($imageFilename->caption) . ' | ' . $recent->title }}">
                        @else<img src="{{ asset('VehiclesInStock/images') . '/' . $imageFilename }}" alt="{{ ucfirst($imageFilename->caption) . ' | ' . $recent->title }}">
                        @endif
                    </div>
                    <div class="desc">
                        <h5>{{ str_limit($recent->title, 60, '...') }}</h5>
                    </div>
                    <div id="modal-1" class="modal hide fade">
                        <a class="close-modal" href="javascript:;" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></a>
                        <div class="modal-body">
                            <img src="{{ asset('VehiclesInStock/images') . '/' .  $imageFilename }}" alt="{{ str_limit($recent->title, 60, '...') }}" width="100%" style="max-height:400px">
                        </div>
                    </div>                 
                </li>
                <!--/Item-->
                @endforeach
                @endif
            </ul>
        </div>
    </section>
    <!--/Work-->    
@endsection