
@extends('layouts.PublicTemplate2')

@section('preTitle') Vehicles In Stock @endsection

@section('content')
    <section id="portfolio" class="container main">    
        <ul class="gallery col-6">
@if (count($recents) > 0)
    @foreach($recents as $recent)
<?php $imageFilename = (new \App\Models\Logic\Images)->topImage($recent->id) ?>
            <li>
                <div class="preview">
                    <img alt="{{ ucfirst($imageFilename->caption) . ' | ' . $recent->title }}" src="{{ asset('VehiclesInStock/images') . '/' .  $imageFilename->disk_image_filename }}">
                    <div class="overlay">
                    </div>
                    <div class="links">
                        <a data-toggle="modal" href="#modal-{{ $recent->id }}">
                            <i class="icon-eye-open"></i>
                        </a><!--
                        <a href="#">
                            <i class="icon-link"></i>
                        </a>-->
                    </div>
                </div>
                <div class="desc text-center">
                    <h5>{{ $recent->title }}</h5>
                </div>
                <div id="modal-{{ $recent->id }}" class="modal hide fade">
                    <a class="close-modal" href="javascript:;" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></a>
                    <div class="modal-body">
                        <h3 class="card-header">{{ $recent->title }}</h3>
                        <h3 class="card-header text-center">@ ₦{{ number_format($recent->price) }}</h3>
                        <img src="{{ asset('VehiclesInStock/images') . '/' .  $imageFilename->disk_image_filename }}" alt="{{ ucfirst($imageFilename->caption) . ' | ' . $recent->title }}" width="100%" style="max-height:400px">
                        <div class="card col-md-12">
                          <div class="card-body">
                            <h2 class="card-title"></h2>
                            <h4>{{ $recent->description }}</h4>
                          </div>
                          <div class="card-body">
                            <h4 class="card-title"><b>Viewed:</b> {{ $recent->view_count }} times</h4>
                            <h4 class="card-title"><b>Category:</b> {{ (new \App\Models\Logic\Types)->typeName($recent->vehicletypes_id) }}</h4>
                            <h4 class="card-title"><b>Brand:</b> {{ (new \App\Models\Logic\Brands)->brandName($recent->vehiclebrands_id) }}</h4>
                            <h4 class="card-title"><b>Vehicle model:</b> {{ $recent->model }}</h4>
                            <h4 class="card-title"><b>Engine change:</b> {{ $recent->engine_change }}</h4>
                            <h4 class="card-title"><b>Modifications:</b> {{ $recent->modifications }}</h4>
                            <h4 class="card-title"><b>Customizations:</b> {{ $recent->customizations }}</h4>
                            <h4 class="card-title"><b>Mileage:</b> {{ $recent->mileage }} kilometers</h4>
                            <h4 class="card-title"><b>Condition:</b> {{ title_case($recent->condition) }}</h4>
                            <h4 class="card-title"><b>Transmission:</b> {{ $recent->transmission }}</h4>
                            <h4 class="card-title"><b>Year of manufacture:</b> {{ $recent->manufacture_date }}</h4>
                            <h4 class="card-title"><b>Maintenance history:</b> {{ $recent->maintenance_history }}</h4>
                            <h4 class="card-title"><b>Exterior paint:</b> {{ title_case($recent->exterior_finish) }}</h4>
                            <h4 class="card-title"><b>Paint colour:</b> {{ $recent->exterior_colour }}</h4>
                            <h4 class="card-title"><b>Interior:</b> {{ $recent->interior_finish }}</h4>
                            <h4 class="card-title"><b>Vehicle roof:</b> {{ title_case($recent->roof) }}</h4>
                            <h4 class="card-title"><b>Available accessory:</b> {{ title_case($recent->accessories) }}</h4>
                            <h4 class="card-title"><b>Last edit date:</b> {{ $recent->updated_at }}</h4>
                            <h4 class="card-title"><b>Post's tags:</b> {{ $recent->tags }}</h4>
                          </div>
                        </div>
                    </div>
                </div>                 
            </li>
    @endforeach
@endif
        </ul>
    </section>
    
    <section class="container main" style="margin-top: -80px;">
        <ul class="gallery col-12">
            <li class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="pagination pagination-lg">
                            <ul class="pagination" role="navigation">
                                <li class="page-item" aria-disabled="true">
                                    <a class="page-link" href="{{ $recents->previousPageUrl() }}" rel="previous">Previous »</a>
                                </li><?php /*
                                <li class="page-item disabled">
                                    <a class="page-link" href="{{ $recents->currentPage() }}">Current page</a>
                                </li>*/ ?>
                                <li class="page-item">
                                    <a class="page-link" href="{{ $recents->nextPageUrl() }}" rel="next">Next »</a>
                                </li>
                            </ul>
                        </ul>
                    </div>
                </div>                 
            </li>

        </ul>
    </section>
@endsection


