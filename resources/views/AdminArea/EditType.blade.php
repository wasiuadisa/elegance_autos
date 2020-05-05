
@extends('layouts.AdminTemplate')

@section('preTitle') Edit vehicle type @endsection

@section('content')

<div class="container">

    <div class="breadcrumbs">
        <div class="col-sm-6">
            <div class="page-header float-left">
                <div class="page-title">
                    <h2>Edit Vehicle Type</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="active">Edit vehicle type</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
      @if (session('infoStatus'))
      <!-- Message -->
      <div class="alert  alert-success alert-dismissible fade show" role="alert">
          <span class="badge badge-pill badge-success">Success</span> 
          {{ session('infoStatus') }}.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <hr>
      {{ session()->forget('infoStatus') }}
      @endif
    </div>

    @if( count($errors) > 0 )
      @foreach( $errors->all() as $error )
      <!-- Error(s) -->
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-danger">Error</span> 
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <hr>
      @endforeach
    @endif

    <div class="justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <form method="post" action="{{ route('editCarTypeFormData', [$types->id,]) }}">
                <table class="table">
                  <tbody>
                    <tr style="background-color: White;" class="col-lg-12">
                      @csrf
                      <td class="col-md-7">
                        <input id="type" type="text" class="form-control" name="type" value="@if(count($errors) > 0){{ old('type') }}@else{{ ucfirst(htmlspecialchars_decode($types->name)) }}@endif" required autofocus>
                      </td>
                      <td class="col-md-5" style="padding-top: -10px;">
                        <button type="submit" name="submit"  class="btn btn-primary">
                          {{ __('Change Type') }}
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
          <!------------->

          <div class="content mt-3">
              <div class="animated fadeIn">
              </div><!-- .animated -->
          </div><!-- .content -->

          <!------------->
        </div>
      </div>
    </div>

  </div>
<!-- .container -->
@endsection
