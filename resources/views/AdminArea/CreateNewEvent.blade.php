
@extends('layouts.AdminTemplate')

@section('preTitle') New Event Form @endsection

@section('content')

<div class="container">

    <div class="breadcrumbs">
        <div class="col-sm-6">
            <div class="page-header float-left">
                <div class="page-title">
                    <h2>New event form</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{ route('AdminIndex') }}">Administration</a></li>
                        <li class="active">New event post</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        @if (session('status'))
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-success">Success</span> 
            {{ session('status') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <div class="col-sm-12">
        @if( count($errors) > 0 )
            <p class="alert alert-danger text-center">Your new event post could not be saved due to the following:</p>
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            @foreach( $errors->all() as $error )
            <span class="badge badge-pill badge-danger">Error</span>
            {{ $error }}.<br>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @endforeach
        </div>
        @endif
    </div>

    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!------------->
                <!------------->
                <!------------->

                <div class="content mt-3">
                    <div class="animated fadeIn">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body card-block">
                                    <form action="{{ route('newEventFormData') }}" method="post" class="form-horizontal">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class=" form-control-label">
                                                    {{ __('Title Of Event') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="Title" type="text" class="form-control" name="Title" value="{{ old('Title') }}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Description" class=" form-control-label">
                                                    {{ __('Event') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="Description" id="Description" rows="9" class="form-control">{{ old('Description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-3">
                                                <button type="submit" name="submit"  class="btn btn-primary">
                                                    <i class="fa fa-dot-circle-o"></i>
                                                    {{ __('Submit Event') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- .animated -->
                </div><!-- .content -->
                
                <!------------->
                <!------------->
                <!------------->
            </div>
        </div>
    </div>

</div>
@endsection
