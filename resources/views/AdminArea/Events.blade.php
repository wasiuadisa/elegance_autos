
@extends('layouts.AdminTemplate')

@section('preTitle') All Events @endsection

@section('content')

<div class="container">

    <div class="breadcrumbs">
        <div class="col-sm-6">
            <div class="page-header float-left">
                <div class="page-title">
                    <h2>Events</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                      <li><a href="{{ route('home') }}">Dashboard</a></li>
                      <li class="active">Events</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="row">
          @if( session('infoStatus') )
          <!-- Message -->
          <ul class="alert alert-success text-center col-md-12 list-unstyled">
            <li>{{ session('infoStatus') }}</li>
          </ul>
          <hr>
          {{ session()->forget('infoStatus') }}
          @endif
          <hr>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col"><h3>Event Title</h3></th>
                  <th scope="col"><h3>Actions</h3></th>
                </tr>
              </thead>
              <tbody>
              @if (count($events) > 0)
              <form method="post" action="{{-- route('vehiclesManySelect') --}}">
              @foreach ($events as $list)<?php /*
                @if ($list->blocked == 0)
                <tr style="background-color: White;">
                @else
                <tr style="background-color: LightGray;">
                @endif */ ?>
                  <td class="col-md-8">
                    <a href="{{ route('eventView', [$list->id,]) }}">
                      {{ str_limit($list->title, 150, '...') }}
                    </a>
                  </td>
                  <td class="col-md-4" style="padding-top: -10px;">
                    <a href="{{ route('editEventForm', [$list->id,]) }}" class="btn btn-success btn-sm">
                      Edit
                    </a><?php /*
                  @if($list->block == 0)
                    <a href="{{ route('eventBlock', [$list->id, 'events']) }}" class="btn btn-danger btn-sm">
                      Block 
                    </a>
                  @endif
                  @if($list->block == 1)
                    <a href="{{ route('eventUnBlock', [$list->id, 'events']) }}" class="btn btn-primary btn-sm">
                      Unblock 
                    </a>
                  @endif */ ?>
                  @if($list->delete == 0)
                    <a href="{{ route('eventDelete', [$list->id, 'events']) }}" class="btn btn-danger btn-sm">
                      Delete 
                    </a>
                  @endif
                  </td>
                </tr>
              @endforeach

              </form>
              @else
                  <td colspan="4">
                    <p>There're no entries</p>
                  </td>
                </tr>
              @endif
              </tbody>
            </table> 

          <div class="col-lg-12">
            <br><br>
            <ul class="pagination pagination-lg">
              {{ $events->links() }}
            </ul>
          </div>
          
        </div><!-- End of row -->
    </div>

</div>
<!-- .container -->
@endsection
