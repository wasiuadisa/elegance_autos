
@extends('layouts.AdminTemplate')

@section('preTitle') {{ $vehicles->title }} @endsection

@section('extraMetaContent') <link rel="canonical" href="{{ $vehicles->url }}"> @endsection

@section('content')
    <!-- Container starts here -->

    <div class="container">

      <!-- Containers
      ================================================== -->
      <div class="bs-docs-section">

        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="card ">
              @if( session('infoStatus') )
              <!-- Errors for Description -->
              <ul class="alert alert-success text-center list-unstyled">
                  <li>{{ session('infoStatus') }}</li>
              </ul>
              <hr>
              @endif
            </div>
          </div>
        </div>

        <div class="row" style="margin-top: 10px;">
          <div class="col-lg-12 card-header">
            <h1 class="card-header">{{ $vehicles->title }}</h1>
            <ul class="list-inline">
              <li class=list-inline-item">
              @if($vehicles->sold == 0)
                <a href="{{ route('postSold2', [$vehicles->id,]) }}">
                  <button type="button" class="btn btn-success btn-md">
                    Mark Vehicle as Sold
                  </button>
                </a>
              @else
                <button type="button" class="btn btn-success btn-md">
                  Sold Vehicle
                </button>
              @endif
                <a href="{{ route('editCarForm', [$vehicles->id,]) }}">
                  <button type="button" class="btn btn-success btn-md">
                    Edit Vehicle
                  </button>
                </a>
                <a href="{{ route('postDelete', [$vehicles->id, 'posts']) }}">
                  <button type="button" class="btn btn-danger btn-md">
                    Delete Vehicle
                  </button>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" style="margin-top: 30px;">
            <div class="card col-md-offset-1 col-md-10">
              <h4 class="card-header">Selling price @ ₦{{ number_format($vehicles->price) }}</h4>
              <div class="card-body">
                <h5 class="card-title">Created on {{ date("l, F jS, Y. g:ia", strtotime($vehicles->created_at)) }}</h5>
              </div>

              <div class="card-body">
                <p class="card-text">{{ $vehicles->description }}</p>
              </div>
              <ul class="list-group list-group-flush">
                @if($vehicles->used = 'Yes')
                <li class="list-group-item"><h3 class="text-danger">Status: Used vehicle</h3></li>
                @else
                <li class="list-group-item"><h3 class="text-danger">Status: New vehicle</h3></li>
                @endif
                <li class="list-group-item"><b>Viewed {{ number_format($vehicles->view_count) }} times</b></li>

                <li class="list-group-item"><b>Category:</b> {{ (new \App\Models\Logic\Types)->typeName($vehicles->vehicletypes_id) }}</li>

                <li class="list-group-item"><b>Brand:</b> {{ (new \App\Models\Logic\Brands)->brandName($vehicles->vehiclebrands_id) }}</li>

                <li class="list-group-item"><b>Vehicle model:</b> {{ $vehicles->model }}</li>
                
                <li class="list-group-item"><b>Engine change:</b> {{ $vehicles->engine_change }}</li>
                @if($vehicles->modifications != 'No modification')
                <li class="list-group-item"><b>Modifications:</b> {{ $vehicles->modifications }}</li>
                @endif
                @if($vehicles->customizations == 'Yes')
                <li class="list-group-item"><b>Customizations:</b> {{ $vehicles->customizations }}</li>
                @endif
                <li class="list-group-item"><b>Mileage:</b> {{ number_format($vehicles->mileage) }} kilometers</li>
                <li class="list-group-item"><b>Condition:</b> {{ (new \App\Models\Logic\Miscellaneous\ExplodeAndImplode)->explodeThenImplode($vehicles->condition, '-', ' ') }}</li>

                <li class="list-group-item"><b>Transmission:</b> {{ $vehicles->transmission }}</li>
                
                <li class="list-group-item"><b>Year of manufacture:</b> {{ $vehicles->manufacture_date }}</li>
                
                <li class="list-group-item"><b>Maintenance history:</b> {{ $vehicles->maintenance_history }}</li>

                <li class="list-group-item"><b>Exterior paint:</b> {{ (new \App\Models\Logic\Miscellaneous\ExplodeAndImplode)->explodeThenImplode($vehicles->exterior_finish, '-', ' ') }}</li>
                <li class="list-group-item"><b>Paint colour:</b> {{ (new \App\Models\Logic\Miscellaneous\ExplodeAndImplode)->explodeThenImplode($vehicles->exterior_colour, '-', ' ') }}</li>
                <li class="list-group-item"><b>Interior:</b> {{ $vehicles->interior_finish }}</li>
                <li class="list-group-item"><b>Vehicle roof:</b> {{ (new \App\Models\Logic\Miscellaneous\ExplodeAndImplode)->explodeThenImplode($vehicles->roof, '-', ' ') }}</li>
                <li class="list-group-item"><b>Available accessory:</b> {{ (new \App\Models\Logic\Miscellaneous\ExplodeAndImplode)->explodeThenImplode($vehicles->accessories, '-', ' ') }}</li>
                <li class="list-group-item"><b>Last edit date :</b> {{ date("l, F jS, Y. g:ia", strtotime($vehicles->updated_at)) }}</li>
                <li class="list-group-item"><b>Post's tags:</b> {{ $vehicles->tags }}</li>
              <div class="row">
                <h2 class="col-md-12 card-header" style="margin-top: 35px;">Image gallery</h2>
                <hr>
                <?php $vehiclesImages = (new \App\Models\Logic\Images)->images($vehicles->id); ?>
              @if(count($vehiclesImages) > 0)
                @foreach($vehiclesImages as $vehiclesImage)
                  <img class="img-thumbnail" src="{{ asset('VehiclesInStock/images') .  '/' . $vehiclesImage->disk_image_filename }}" alt="{{ $vehicles->title }}">
                  <br>
                  <a href="{{ route('deleteImage2', [$vehiclesImage->id, $vehicles->id]) }}">
                    <button type="button" class="btn btn-danger btn-md">
                      Delete "<b>{{ $vehiclesImage->caption }}</b>"
                    </button>
                  </a>
                  <a href="{{ route('editCarImageForm', [$vehiclesImage->id]) }}">
                    <button type="button" class="btn btn-success btn-md">
                      Edit "<b>{{ $vehiclesImage->caption }}</b>"
                    </button>
                  </a>
                  <br><br>
                  <hr>
                @endforeach
              @else
                <h3 style="margin-left: 15px;">
                  There no images for this post.
                </h3>
              @endif
              </div>
            </div>
          </ul>
        </div>
        </div><!-- End of row -->
      </div>    

    <!-- Container ends here -->
@endsection
