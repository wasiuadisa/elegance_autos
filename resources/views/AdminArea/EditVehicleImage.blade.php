
@section('preTitle') Edit Vehicle Image Form @endsection

@section('customScript') 
@endsection

@extends('layouts.AdminTemplate')

@section('content')

<div class="container">

  <div class="breadcrumbs">
      <div class="col-sm-6">
          <div class="page-header float-left">
              <div class="page-title">
                  <h2>Edit Car post image</h2>
              </div>
          </div>
      </div>
      <div class="col-sm-6">
          <div class="page-header float-right">
              <div class="page-title">
                  <ol class="breadcrumb text-right">
                      <li><a href="{{ route('home') }}">Dashboard</a></li>
                      <li class="active">Edit Car post image</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>

  @if (session('infoStatus'))
  <div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        <span class="badge badge-pill badge-success">Success</span> 
        {{ session('infoStatus') }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <hr>
  </div>
  @endif

  @if (session('message'))
  <div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        <span class="badge badge-pill badge-success">Success</span> 
        {{ session('message') }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <hr>
    {{ session()->forget('message') }}
  </div>
  @endif

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

    <form class="form-group" enctype="multipart/form-data" method="post" action="{{ route('editCarImageFormData', [ $ImageId ]) }}">
      <table class="table">
        <tbody>
          <tr style="background-color: White;">
            <td colspan="2">
              <h4>Upload one image at a time</h4>
              <h4>Previous photo cannot be recovered when replaced</h4>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="col-lg-offset-2 col-lg-8">
              <img src="{{ asset('VehiclesInStock/images/' . $image->disk_image_filename) }}" class="col-lg-12" />
            </td>
          </tr>
          <tr class="form-group" style="background-color: White;">
            @csrf
            <td class="col-lg-6">
              <input class="col-lg-12 col-md-12 col-sm-12 btn btn-lg" type="file" id="file" name="file" value="{{ old('file') }}">
            </td>
            <td class="col-lg-6">
              <input class="col-lg-12 col-md-12 col-sm-12 btn btn-lg" type="text" name="Caption" placeholder="{{ null !== old('Caption') ? old('Caption') : 'Click here to change photo caption' }}">
            </td>
          </tr>
          <tr class="form-group" style="background-color: White;">
            <td colspan="2" class="col-lg-12" style="padding-top: -10px;">
              <input type="hidden" name="ImageId" value="@if(count($errors) > 0){{ old('ImageId') }}@else{{ $ImageId }}@endif">
              <button type="submit" name="submit"  class="form-control btn btn-primary">
                {{ __('Upload replacement photo') }}
              </button>
            </td>
          </tr>
        @if( session('infoStatus') == 'Good Job! The car post photo has been replaced, successfully.' )
          <tr class="form-group" style="background-color: White;">
            <td colspan="2">  
              <a href="{{ route('postView', [ $post_id,]) }}" class="btn btn-primary">
                  <b>I'm done replacing the photo! View the post</b>  
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
