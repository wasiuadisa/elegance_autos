
@extends('layouts.AdminTemplate')

@section('preTitle') New Vehicle Form @endsection

@section('content')

<div class="container">

    <div class="breadcrumbs">
        <div class="col-sm-6">
            <div class="page-header float-left">
                <div class="page-title">
                    <h2>New car post form</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{ route('AdminIndex') }}">Administration</a></li>
                        <li class="active">New car post</li>
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
            <p class="alert alert-danger text-center">Your new vehicle data could not be posted due to the following:</p>
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
                                    <form action="{{ route('newCarFormData') }}" method="post" class="form-horizontal">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class=" form-control-label">
                                                    {{ __('Title of post') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="Title" type="text" class="form-control" name="Title" value="{{ old('Title') }}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Description" class=" form-control-label">
                                                    {{ __('Description') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="Description" id="Description" rows="9" class="form-control">{{ old('Description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="VehicleType" class=" form-control-label">
                                                    {{ __('Category') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="VehicleType" class="form-control" name="VehicleType" required>
                                                  <option value=""> -- Select {{ config('app.name') }} category -- </option>
                                                  @foreach( $vehicletypes as $vehicletype )<option value="{{ $vehicletype->id }}" @if(old('VehicleType') == $vehicletype->id){{ 'selected' }} @endif>{{ $vehicletype->name }}</option>
                                                  @endforeach
                                                </select>
                                                <small class="form-text text-muted">Select vehicle category</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Transmission" class=" form-control-label">
                                                    {{ __('Transmission system') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="Transmission" class="form-control" name="Transmission" required>
                                                  <option value=""> -- Select transmission -- </option>
                                                  <option value="Automatic" @if(old('Transmission') == 'Automatic'){{ 'selected' }} @endif>Automatic</option>
                                                  <option value="Manual" @if(old('Transmission') == 'Manual'){{ 'selected' }} @endif>Manual</option>
                                                  <option value="Hybrid" @if(old('Transmission') == 'Hybrid'){{ 'selected' }} @endif>Hybrid</option>
                                                </select>
                                                <small class="form-text text-muted">Select vehicle transmission</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="ManufactureDate" class=" form-control-label">
                                                    {{ __('Year of manufacture') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="ManufactureDate" class="form-control" name="ManufactureDate" required>
                                                    <option value=""> -- Select year -- </option>
                                                   @for($i=1930;$i<(date('Y')+1);$i++)
                                                   <option value="{{ $i }}" @if(old('ManufactureDate') == $i){{ 'selected' }} @endif>{{ $i }}</option>
                                                   @endfor
                                                </select>
                                                <small class="form-text text-muted">Select year of vehicle manufacture</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="MaintenanceHistory" class=" form-control-label">
                                                    {{ __('Availability of maintenance history') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="MaintenanceHistory" class="form-control" name="MaintenanceHistory" required>
                                                  <option value=""> -- Select answer -- </option>
                                                  <option value="Yes" @if(old('MaintenanceHistory') == 'Yes'){{ 'selected' }} @endif>Yes</option>
                                                  <option value="No" @if(old('MaintenanceHistory') == 'No'){{ 'selected' }} @endif>No</option>
                                                </select>
                                                <small class="form-text text-muted">Select for proof of vehicle maintenance history</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Price" class=" form-control-label">
                                                    {{ __('Enter price') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="Price" type="number" class="form-control" name="Price" value="{{ old('Price') }}" required autofocus>
                                                <small class="form-text text-muted">Enter price (E.g. 200500)</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Brand" class=" form-control-label">
                                                    {{ __('Vehicle brand') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="Brand" class="form-control" name="Brand" required>
                                                  <option value=""> -- Select brand -- </option>
                                                   @foreach ($vehiclebrands as $vehiclebrand)
                                                  <option value="{{ $vehiclebrand->id }}" @if(old('Brand') == $vehiclebrand->id){{ 'selected' }} @endif>{{ $vehiclebrand->name }}</option>
                                                  @endforeach
                                                </select>
                                                <small class="form-text text-muted">Select brand of vehicle</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Model" class=" form-control-label">
                                                    {{ __('Vehicle model') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="Model" type="text" class="form-control" name="Model" value="{{ old('Model') }}" required autofocus>
                                                <small class="form-text text-muted">Enter model of vehicle</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="UsedOrNew" class=" form-control-label">
                                                    {{ __('Used or new vehicle') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                 <select id="UsedOrNew" class="form-control" name="UsedOrNew" required>
                                                  <option value=""> -- Used or new -- </option>
                                                  <option value="Used" @if(old('UsedOrNew') == 'Used'){{ 'selected' }} @endif>Used</option>
                                                  <option value="New" @if(old('UsedOrNew') == 'New'){{ 'selected' }} @endif>New</option>
                                                </select>
                                                <small class="form-text text-muted">Select newness of vehicle</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Condition" class=" form-control-label">
                                                    {{ __('Vehicle condition') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="Condition" class="form-control" name="Condition" required>
                                                  <option value=""> -- Select state -- </option>
                                                  <option value="Drive-off" @if(old('Condition') == 'Drive-off'){{ 'selected' }} @endif>Drive off</option>
                                                  <option value="Tow-away" @if(old('Condition') == 'Tow-away'){{ 'selected' }} @endif>Tow away</option>
                                                </select>
                                                <small class="form-text text-muted">Select condition of vehicle</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Mileage" class=" form-control-label">
                                                    {{ __('Mileage in Km') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="Mileage" type="number" class="form-control" name="Mileage" value="{{ old('Mileage') }}" required autofocus>
                                                <small class="form-text text-muted">Enter vehicle Mileage in Km (e.g. 123789)</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Customizations" class=" form-control-label">
                                                    {{ __('Customized vehicle') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="Customizations" class="form-control" name="Customizations" required>
                                                  <option value=""> -- Is the vehicle customized or not -- </option>
                                                  <option value="Yes" @if(old('Customizations') == 'Yes'){{ 'selected' }} @endif>Yes</option>
                                                  <option value="No" @if(old('Customizations') == 'No'){{ 'selected' }} @endif>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Modifications" class=" form-control-label">
                                                    {{ __('Modifications (Customization detail)') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                 <textarea id="Modifications" class="form-control" name="Modifications">{{  null !== old('Modifications') ? old('Modifications') : 'No modification'  }}</textarea>
                                                <small class="form-text text-muted">Enter modification of vehicle</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="EngineChange" class=" form-control-label">
                                                    {{ __('Engine change?') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="EngineChange" class="form-control" name="EngineChange" required>
                                                  <option value=""> -- Has the vehicle's engine been changed -- </option>
                                                  <option value="Yes" @if(old('EngineChange') == 'Yes'){{ 'selected' }} @endif>Yes</option>
                                                  <option value="No" @if(old('EngineChange') == 'No'){{ 'selected' }} @endif>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="ExteriorFinish" class=" form-control-label">
                                                    {{ __('Exterior paint') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="ExteriorFinish" class="form-control" name="ExteriorFinish" required>
                                                  <option value=""> -- Select exterior paint -- </option>
                                                  <option value="Factory-paint" @if(old('ExteriorFinish') == 'Factory-paint'){{ 'selected' }} @endif>Factory paint</option>
                                                  <option value="Repaint" @if(old('ExteriorFinish') == 'Repaint'){{ 'selected' }} @endif>Repaint</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="ExteriorColour" class=" form-control-label">
                                                    {{ __('Paint colour') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="ExteriorColour" type="text" class="form-control" name="ExteriorColour" value="{{ old('ExteriorColour') }}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="InteriorFinish" class=" form-control-label">
                                                    {{ __('Interior furnishing') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="InteriorFinish" class="form-control" name="InteriorFinish" required>
                                                  <option value=""> -- Select interior furnishing -- </option>
                                                  <option value="Leather" @if(old('InteriorFinish') == 'Leather'){{ 'selected' }} @endif>Leather</option>
                                                  <option value="Fabric" @if(old('InteriorFinish') == 'Fabric'){{ 'selected' }} @endif>Fabric</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Roof" class=" form-control-label">
                                                    {{ __('Vehicle Roof') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="Roof" class="form-control" name="Roof" required>
                                                  <option value=""> -- Select interior furnishing -- </option>
                                                  <option value="Covered" @if(old('Roof') == 'Covered'){{ 'selected' }} @endif>Covered</option>
                                                  <option value="Sun-roof" @if(old('Roof') == 'Sun-roof'){{ 'selected' }} @endif>Sun-roof</option>
                                                  <option value="Moon-roof" @if(old('Roof') == 'Moon-roof'){{ 'selected' }} @endif>Moon roof</option>
                                                  <option value="Convertible" @if(old('Roof') == 'Convertible'){{ 'selected' }} @endif>Convertible</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Accessories" class=" form-control-label">
                                                    {{ __('Accessory') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                 <select id="Accessories" class="form-control" name="Accessories" required>
                                                  <option value=""> -- Select avaialable accessories -- </option>
                                                  <option value="Tool-box" @if(old('Accessories') == 'Tool-box'){{ 'selected' }} @endif>Tool box</option>
                                                  <option value="Jack" @if(old('Accessories') == 'Jack'){{ 'selected' }} @endif>Jack</option>
                                                  <option value="Caution-signs" @if(old('Accessories') == 'Caution-signs'){{ 'selected' }} @endif>Caution signs</option>
                                                  <option value="Manual" @if(old('Accessories') == 'Manual'){{ 'selected' }} @endif>Manual</option>
                                                </select>
                                                <small class="form-text text-muted">Choose one vital accessory included</small>
                                            </div>
                                        </div>


                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Tags" class=" form-control-label">
                                                    {{ __('Tags') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="Tags" type="text" class="form-control" name="Tags" value="{{ old('Tags') }}" required autofocus>
                                                <small class="form-text text-muted">Enter tags (separate the tags with comma and space, e.g.: mercedes, c-class, used)</small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="disabledSelect" class=" form-control-label">Currency</label></div>
                                            <div class="col-12 col-md-9">
                                                <select name="disabledSelect" id="disabledSelect" disabled="" class="form-control">
                                                    <option value="1" selected>Naira</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-3">
                                                <button type="submit" name="submit"  class="btn btn-primary">
                                                    <i class="fa fa-dot-circle-o"></i>
                                                    {{ __('Submit post') }}
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
