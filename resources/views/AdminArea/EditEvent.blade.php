
@extends('layouts.AdminTemplate')

@section('preTitle') Event Editing Form @endsection

@section('content')

<div class="container">

    <div class="breadcrumbs">
        <div class="col-sm-6">
            <div class="page-header float-left">
                <div class="page-title">
                    <h2>Event editing form</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{ route('AdminIndex') }}">Administration</a></li>
                        <li class="active">Event Editing</li>
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
            <p class="alert alert-danger text-center">Your event data could not be changed:</p>
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
                                    <form action="{{ route('editEventFormData', $events->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class=" form-control-label">
                                                    {{ __('Title Of Event') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="Title" type="text" class="form-control{{ $errors->has('Title') ? ' is-invalid' : '' }}" name="Title" value="@if(count($errors) > 0){{ old('Title') }}@else{{ $events->title }}@endif" required autofocus>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Description" class=" form-control-label">
                                                    {{ __('Event') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea id="Description" class="form-control{{ $errors->has('Description') ? ' is-invalid' : '' }}" name="Description" required>@if(count($errors) > 0){{ old('Description') }}@else{{ $events->description }}@endif</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-3 offset-md-3">
                                                <button type="submit" name="submit"  class="btn btn-primary">
                                                    <i class="fa fa-dot-circle-o"></i>
                                                    {{ __('Change Event') }}
                                                </button>
                                            </div>
                                            <div class="col-md-3 offset-md-3"><?php /*
                                                @if ($events->blocked == 0)<a href="{{ route('eventBlock', [ $events->id, 'events' ]) }}">
                                                    <button class="btn btn-danger">
                                                        {{ __('Block This Event') }}
                                                    </button>
                                                </a>@else<a href="{{ route('eventUnBlock', [ $events->id, 'events' ]) }}">
                                                    <button class="btn btn-primary">
                                                        {{ __('Unblock This Event') }}
                                                    </button>
                                                </a>@endif
                                            </div>*/ ?>
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
