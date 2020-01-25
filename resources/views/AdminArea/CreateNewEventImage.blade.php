
@section('preTitle') New Event Image Form @endsection

@section('customScript') 
@endsection

@extends('layouts.AdminTemplate')

@section('content')

<div class="container">

  <div class="breadcrumbs">
      <div class="col-sm-6">
          <div class="page-header float-left">
              <div class="page-title">
                  <h2>New Event image</h2>
              </div>
          </div>
      </div>
      <div class="col-sm-6">
          <div class="page-header float-right">
              <div class="page-title">
                  <ol class="breadcrumb text-right">
                      <li><a href="{{ route('home') }}">Dashboard</a></li>
                      <li class="active">New Event image</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>

  <div class="col-sm-12">
    @if (session('infoStatus'))
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        <span class="badge badge-pill badge-success">Success</span> 
        {{ session('infoStatus') }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <hr>
    @endif
  </div>
  <div class="col-sm-12">
    @if (session('message'))
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        <span class="badge badge-pill badge-success">Success</span> 
        {{ session('message') }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <hr>
    {{ session()->forget('message') }}
    @endif
  </div>

  <div class="justify-content-center">

    <div class="col-lg-12">
  @if( count($errors) > 0 )
      <!-- Errors for Description -->
      <p class="alert alert-danger text-center">Your photo could not be uploaded:</p>
      <ul class="alert alert-danger text-center list-unstyled">
    @foreach( $errors->all() as $error )
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
          <span class="badge badge-pill badge-danger">Error</span> 
          {{ $error }}.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endforeach
      </ul>
  @endif
    </div>

    <form class="form-group" enctype="multipart/form-data" method="post" action="{{ route('newEventImageFormData') }}">
      <table class="table">
        <tbody>
          <tr style="background-color: White;">
            <td colspan="2">
              <h3>Upload one image at a time</h3>
            </td>
          </tr>
          <tr class="form-group" style="background-color: White;">
            @csrf
            <td class="col-lg-6">
              <input class="form-control col-lg-12 col-md-12 col-sm-12 btn btn-lg " type="file" id="file" name="file" value="{{ old('file') }}" required>
            </td>
            <td class="col-lg-6">
              <input class="form-control col-lg-12 col-md-12 col-sm-12 btn btn-lg" type="text" name="Caption" placeholder="{{ null !== old('Caption') ? old('Caption') : 'Click here to enter photo caption' }}">
            </td>
          </tr>
          <tr class="form-group" style="background-color: White;">
            <td colspan="2" class="col-lg-12" style="padding-top: -10px;">
              <input type="hidden" name="PostID" value="{{ $post_id }}">
              <button type="submit" name="submit"  class="form-control btn btn-primary">
                {{ __('Upload photo') }}
              </button>
            </td>
          </tr>
        @if( session('infoStatus') == 'Good Job! The new event photo has been uploaded, successfully.' )
          <tr class="form-group" style="background-color: White;">
            <td colspan="2">
              <a href="{{ route('eventView', [ $post_id,]) }}" class="btn btn-primary">
                  <b>I'm done uploading photos! View this post</b>  
              </a>
              <a href="{{ route('events') }}" class="btn btn-primary">
                  <b>All {{ config('app.name') }} events</b>  
              </a>
            </td>
          </tr>
        @endif
        {{ session()->forget('infoStatus') }}
        </tbody>
      </table>
    </form>
  </div>

</div>
<!-- .container -->
@endsection
