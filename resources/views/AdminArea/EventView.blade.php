
@extends('layouts.AdminTemplate')

@section('preTitle') {{ $events->title }} @endsection

@section('extraMetaContent') <link rel="canonical" href="{{ $events->url }}"> @endsection

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
            <h1 class="card-header">{{ $events->title }}</h1>
            <ul class="list-inline">
              <li class=list-inline-item">
                <a href="{{ route('newEventImageForm', [$events->id,]) }}">
                  <button type="button" class="btn btn-primary btn-md">
                    Add photo
                  </button>
                </a>
                <a href="{{ route('editEventForm', [$events->id,]) }}">
                  <button type="button" class="btn btn-primary btn-md">
                    Edit event
                  </button>
                </a><?php /*
              @if($events->blocked == 0)
                <a href="{{ route('eventBlock', [$events->id, 'events']) }}">
                  <button type="button" class="btn btn-danger btn-md">
                    Block event
                  </button>
                </a>
              @else
                <a href="{{ route('eventUnBlock', [$events->id, 'events']) }}">
                  <button type="button" class="btn btn-primary btn-md">
                    UnBlock event
                  </button>
                </a>
              @endif */ ?>
              @if($events->deleted == 0)
                <a href="{{ route('eventDelete', [$events->id, 'events']) }}">
                  <button type="button" class="btn btn-danger btn-md">
                    Delete event
                  </button>
                </a>
              @endif
              </li>
            </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" style="margin-top: 30px;">
            <div class="card col-md-offset-1 col-md-10">
              <div class="card-body">
                <h5 class="card-title">Created on {{ date("l, F jS, Y. g:ia", strtotime($events->created_at)) }}</h5>
                <h5 class="card-title">Edited on {{ date("l, F jS, Y. g:ia", strtotime($events->updated_at)) }}</h5>
              </div>

              <div class="card-body">
                <p class="card-text">{{ $events->description }}</p>
              </div>
              <ul class="list-group list-group-flush">
              <div class="row">
                <h2 class="col-md-12 card-header" style="margin-top: 35px;">Image gallery</h2>
                <hr>
                <?php $eventsImages = (new \App\Models\Logic\Eventimages)->images($events->id); ?>
              @if(count($eventsImages) > 0)
                @foreach($eventsImages as $eventImage)
                <div class="card">
                  <img class="img-thumbnail" src="{{ asset('Events') .  '/' . ($eventImage->disk_image_filename ? $eventImage->disk_image_filename : 'defaultImage.jpg') }}" alt="{{ $events->title }}">
                    <div class="card-title">
                      <a href="{{ route('deleteEventImage2', [$eventImage->id, $events->id]) }}">
                        <button type="button" class="btn btn-danger btn-md">
                          Delete "<b>{{ $eventImage->caption }}</b>"
                        </button>
                      </a>
                      <a href="{{ route('editEventImageForm', [$eventImage->id]) }}">
                        <button type="button" class="btn btn-success btn-md">
                          Edit "<b>{{ $eventImage->caption }}</b>"
                        </button>
                      </a>
                    </div>
                  </div>
                @endforeach
              @else
                <h3 style="margin-left: 15px;">
                  There no images for this event.
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
