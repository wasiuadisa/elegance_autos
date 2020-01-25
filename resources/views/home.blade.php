
@extends('layouts.AdminTemplate')

@section('preTitle') Dashboard @endsection

@section('content')

<div class="container">

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{ route('AdminIndex') }}">Administration</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
      @if (session('infoStatus'))
      <!-- Message -->
      <div class="alert  alert-success alert-dismissible fade show" role="alert">
          {{ session('infoStatus') }}.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <hr>
      {{ session()->forget('infoStatus') }}
      @endif
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

    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!------------->

                <div class="content mt-3">
<!-------------------------------------------------------------------->
<!-------------------------------------------------------------------->
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one text-center">
                    <div class="stat-icon dib"><i class="ti-car text-success border-success"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Categories</div>
                        <div class="stat-digit">{{ (new \App\Models\Logic\Posts)->countPosts() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>@foreach($vehicletypes as $vehicleType)

    <div class="col-lg-2 col-md-2">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-car text-primary border-primary"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">{{ $vehicleType->name }}</div>
                        <div class="stat-digit">{{ (new \App\Models\Logic\Posts)->countPostTypes($vehicleType->id) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>@endforeach

    <div class="col-lg-12 col-md-12">
        <div class="stat-widget-one">
            <hr>
        </div>
    </div>

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one text-center">
                    <div class="stat-icon dib">
                        <i class="ti-car text-success border-success"></i>
                    </div>
                    <div class="stat-content dib">
                        <div class="stat-text">Brands</div>
                        <div class="stat-digit">{{ count($vehiclebrands) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="list-inline">
                @foreach($vehiclebrands as $brandName)    <li class="list-inline-item" style="margin-right: 10px; margin-bottom: 10px;"><a href="{{ route('home') }}" class="btn btn-lg border-secondary text-primary">{{ $brandName->name }}</a></li>@endforeach
                </ul>
            </div>
        </div>
    </div>
<!--
    <div class="col-lg-4 col-md-6">
        <section class="card">
            <div class="twt-feed blue-bg">
                <div class="fa fa-user wtt-mark"></div>
                <div class="media">
                    <div class="media-body">
                        <h2 class="text-white display-6">Create Administrator</h2>
                    </div>
                </div>
            </div>
            <div class="twt-write col-sm-12">
                <div class="form-group">
                    <label class=" form-control-label">Fullname</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                        <input class="form-control" placeholder="" name="adminFullname" type="text">
                    </div>
                    <small class="form-text text-muted">ex. Collin Pharrel</small>
                </div>
                <div class="form-group">
                    <label class=" form-control-label">Position</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                        <input class="form-control" value="Proprietor" disabled="">
                    </div>
                    <small class="form-text text-muted">ex. Sales Manager</small>
                </div>
                <div class="form-group">
                    <label class=" form-control-label">Facebook URL</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
                        <input class="form-control" name="adminFacebook" type="text">
                    </div>
                    <small class="form-text text-muted">ex. https://web.facebook.com/WasiuAdisaDotCom</small>
                </div>
                <div class="form-group">
                    <label class=" form-control-label">Twitter URL</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
                        <input class="form-control" name="adminTwitter" type="text">
                    </div>
                    <small class="form-text text-muted">ex. https://twitter.com/WasiuAdisaDotCom</small>
                </div>
            </div>
        </section>
    </div>

    <div class="col-lg-4 col-md-6">
        <section class="card">
            <div class="twt-feed blue-bg">
                <div class="fa fa-users wtt-mark"></div>
                <div class="media">
                    <div class="media-body">
                        <h2 class="text-white display-6">Create Employee</h2>
                    </div>
                </div>
            </div>
            <div class="twt-write col-sm-12">
                <div class="form-group">
                    <label class=" form-control-label">Fullname</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                        <input class="form-control" placeholder="" type="text" name="employeeFullname">
                    </div>
                    <small class="form-text text-muted">ex. Collin Pharrel</small>
                </div>
                <div class="form-group">
                    <label class=" form-control-label">Position</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                        <input class="form-control" placeholder="" type="text" name="employeePosition">
                    </div>
                    <small class="form-text text-muted">ex. Sales Manager</small>
                </div>
                <div class="form-group">
                    <label class=" form-control-label">Facebook URL</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
                        <input class="form-control" name="adminFacebook" type="text">
                    </div>
                    <small class="form-text text-muted">ex. https://web.facebook.com/WasiuAdisaDotCom</small>
                </div>
                <div class="form-group">
                    <label class=" form-control-label">Twitter URL</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
                        <input class="form-control" name="adminTwitter" type="text">
                    </div>
                    <small class="form-text text-muted">ex. https://twitter.com/WasiuAdisaDotCom</small>
                </div>
            </div>
        </section>
    </div>-->
<?php /*
    <div class="col-lg-4 col-md-6">
        <section class="card">
            <div class="twt-feed blue-bg">
                <div class="fa fa-user wtt-mark"></div>
                <div class="media">
                    <div class="media-body text-center">
                        <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#scrollmodalAdmin">
                            Create Admin
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section class="card">
            <div class="twt-feed blue-bg">
                <div class="fa fa-users wtt-mark"></div>
                <div class="media">
                    <div class="media-body text-center">
                        <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#scrollmodalEmployee">
                            Create Employee
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>

        <!---------------------------------------------------------------------->
        <div class="modal fade" id="scrollmodalAdmin" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollmodalLabel">
                            Create Administrator
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="twt-write col-sm-12">
                            <div class="form-group">
                                <label class=" form-control-label">Fullname</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <input class="form-control" placeholder="" name="adminFullname" type="text">
                                </div>
                                <small class="form-text text-muted">ex. Collin Pharrel</small>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Position</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <input class="form-control" value="Proprietor" disabled="">
                                </div>
                                <small class="form-text text-muted">ex. Sales Manager</small>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Facebook URL</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
                                    <input class="form-control" name="adminFacebook" type="text">
                                </div>
                                <small class="form-text text-muted">ex. https://web.facebook.com/WasiuAdisaDotCom</small>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Twitter URL</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
                                    <input class="form-control" name="adminTwitter" type="text">
                                </div>
                                <small class="form-text text-muted">ex. https://twitter.com/WasiuAdisaDotCom</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------->

        <!---------------------------------------------------------------->
        <div class="modal fade" id="scrollmodalEmployee" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scrollmodalLabel">
                                    Create Employee
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="twt-write col-sm-12">
                                    <div class="form-group">
                                        <label class=" form-control-label">Fullname</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                            <input class="form-control" placeholder="" type="text" name="employeeFullname">
                                        </div>
                                        <small class="form-text text-muted">ex. Collin Pharrel</small>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Position</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                            <input class="form-control" placeholder="" type="text" name="employeePosition">
                                        </div>
                                        <small class="form-text text-muted">ex. Sales Manager</small>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Facebook URL</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
                                            <input class="form-control" name="adminFacebook" type="text">
                                        </div>
                                        <small class="form-text text-muted">ex. https://web.facebook.com/WasiuAdisaDotCom</small>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Twitter URL</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
                                            <input class="form-control" name="adminTwitter" type="text">
                                        </div>
                                        <small class="form-text text-muted">ex. https://twitter.com/WasiuAdisaDotCom</small>
                                    </div>
                                </div>              
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
        <!----------------------------------------------------------------->

    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title mb-3">Administrator Profile</strong>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                    <a href="#" class="btn btn-primary btn-sm">Delete</a>
                    <img class="rounded-circle mx-auto d-block" src="{{ asset('OtherImages/admin3.jpg') }}" alt="Card image cap">
                    <h5 class="text-sm-center mt-2 mb-1">Steven Lee</h5>
                    <div class="location text-sm-center">
                        <i class="fa fa-user"></i> Proprietor
                        <hr>
                        <i class="fa fa-bullhorn btn btn-lg btn-primary"></i> Intro
                    </div>
                </div>
                <hr>
                <div class="card-text text-sm-center">
                    <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                    <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title mb-3">Employee Profile</strong>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                    <a href="#" class="btn btn-primary btn-sm">Delete</a>
                    <img class="rounded-circle mx-auto d-block" src="{{ asset('OtherImages/admin3.jpg') }}" alt="Card image cap">
                    <h5 class="text-sm-center mt-2 mb-1">Steven Lee</h5>
                    <div class="location text-sm-center">
                        <i class="fa fa-user"></i> Manager
                        <hr>
                        <i class="fa fa-bullhorn btn btn-lg btn-primary"></i> Intro
                    </div>
                </div>
                <hr>
                <div class="card-text text-sm-center">
                    <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                    <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title mb-3">Employee Profile</strong>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                    <a href="#" class="btn btn-primary btn-sm">Delete</a>
                    <img class="rounded-circle mx-auto d-block" src="{{ asset('OtherImages/admin3.jpg') }}" alt="Card image cap">
                    <h5 class="text-sm-center mt-2 mb-1">Steven Lee</h5>
                    <div class="location text-sm-center">
                        <i class="fa fa-user"></i> Manager
                        <hr>
                        <i class="fa fa-bullhorn btn btn-lg btn-primary"></i> Intro
                    </div>
                </div>
                <hr>
                <div class="card-text text-sm-center">
                    <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                    <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title mb-3">Employee Profile</strong>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                    <a href="#" class="btn btn-primary btn-sm">Delete</a>
                    <img class="rounded-circle mx-auto d-block" src="{{ asset('OtherImages/admin3.jpg') }}" alt="Card image cap">
                    <h5 class="text-sm-center mt-2 mb-1">Steven Lee</h5>
                    <div class="location text-sm-center">
                        <i class="fa fa-user"></i> Manager
                        <hr>
                        <i class="fa fa-bullhorn btn btn-lg btn-primary"></i> Intro
                    </div>
                </div>
                <hr>
                <div class="card-text text-sm-center">
                    <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                    <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title mb-3">Employee Profile</strong>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                    <a href="#" class="btn btn-primary btn-sm">Delete</a>
                    <img class="rounded-circle mx-auto d-block" src="{{ asset('OtherImages/admin3.jpg') }}" alt="Card image cap">
                    <h5 class="text-sm-center mt-2 mb-1">Steven Lee</h5>
                    <div class="location text-sm-center">
                        <i class="fa fa-user"></i> Manager 
                        <hr>
                        <i class="fa fa-bullhorn btn btn-lg btn-primary"></i> Intro
                    </div>
                </div>
                <hr>
                <div class="card-text text-sm-center">
                    <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                    <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                </div>
            </div>
        </div>
    </div>

*/ ?>
<!-------------------------------------------------------------------->
<!-------------------------------------------------------------------->
<!--                    <div class="animated fadeIn">
                    </div><!-- .animated -->
                </div><!-- .content -->

                <!------------->
            </div>
        </div>
    </div>

</div>
<!-- .container -->
@endsection
