
@section('preTitle') Vehicle Editing Form @endsection

@section('content')

@extends('layouts.AdminTemplate')

<div class="container">

    <div class="breadcrumbs">
        <div class="col-sm-6">
            <div class="page-header float-left">
                <div class="page-title">
                    <h2>Vehicle Editing Form</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{ route('AdminIndex') }}">Administration</a></li>
                        <li class="active">Vehicle Editing Form</li>
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
        @endif
    </div>

    <div class="col-sm-12">
        @if( count($errors) > 0 )
            <p class="alert alert-danger text-center">Your vehicle data could not be changed:</p>
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
                                    <form action="{{ route('editCarFormData', [$vehicles->id,]) }}" method="post" class="form-horizontal">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class=" form-control-label">
                                                    {{ __('Title of post') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="Title" type="text" class="form-control{{ $errors->has('Title') ? ' is-invalid' : '' }}" name="Title" value="@if(count($errors) > 0){{ old('Title') }}@else{{ $vehicles->title }}@endif" required autofocus>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Description" class=" form-control-label">
                                                    {{ __('Description') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea id="Description" class="form-control{{ $errors->has('Description') ? ' is-invalid' : '' }}" name="Description" required>@if(count($errors) > 0){{ old('Description') }}@else{{ $vehicles->description }}@endif</textarea>
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

                                                  @if( count($errors) > 0 )
                                                  <option value="{{ (new \App\Models\Logic\Types)->typeId(old('VehicleType')) }}">{{ old('VehicleType') }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->vehicletypes_id }}" selected>{{ (new \App\Models\Logic\Types)->typeName($vehicles->vehicletypes_id) }}</option>
                                                  @endif
                                                  
                                                  @foreach( $vehicletypes as $vehicletype )
                                                  <option value="@if(count($errors) > 0){{ old('VehicleType') }}@else{{ $vehicletype->id }}@endif">{{ $vehicletype->name }}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Transmission" class=" form-control-label">
                                                    {{ __('Transmission system') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="Transmission" class="form-control{{ $errors->has('Transmission') ? ' is-invalid' : '' }}" name="Transmission" required>
                                                  <option value=""> -- Select transmission -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('Transmission') }}" selected>{{ ucfirst(old('Transmission')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->transmission }}" selected>{{ ucfirst($vehicles->transmission) }}</option>
                                                  @endif
                                                  <option value="Automatic" @if(old('Transmission') == 'Automatic'){{ 'selected' }} @endif>Automatic</option>
                                                  <option value="Manual" @if(old('Transmission') == 'Manual'){{ 'selected' }} @endif>Manual</option>
                                                  <option value="Hybrid" @if(old('Transmission') == 'Hybrid'){{ 'selected' }} @endif>Hybrid</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="ManufactureDate" class=" form-control-label">
                                                    {{ __('Year of manufacture') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="ManufactureDate" class="form-control{{ $errors->has('ManufactureDate') ? ' is-invalid' : '' }}" name="ManufactureDate" required>
                                                    <option value=""> -- Select year -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('ManufactureDate') }}" selected>{{ ucfirst(old('ManufactureDate')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->manufacture_date }}" selected>{{ ucfirst($vehicles->manufacture_date) }}</option>
                                                  @endif
                                                   @for($i=1930;$i<(date('Y')+1);$i++)
                                                   <option value="{{ $i }}" @if(old('ManufactureDate') == $i){{ 'selected' }} @endif>{{ $i }}</option>
                                                   @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="MaintenanceHistory" class=" form-control-label">
                                                    {{ __('Availability of maintenance history') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="MaintenanceHistory" class="form-control{{ $errors->has('MaintenanceHistory') ? ' is-invalid' : '' }}" name="MaintenanceHistory" required>
                                                  <option value=""> -- Select answer -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('MaintenanceHistory') }}" selected>{{ ucfirst(old('MaintenanceHistory')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->maintenance_history }}" selected>{{ ucfirst($vehicles->maintenance_history) }}</option>
                                                  @endif
                                                  <option value="Yes" @if(old('MaintenanceHistory') == 'Yes'){{ 'selected' }} @endif>Yes</option>
                                                  <option value="No" @if(old('MaintenanceHistory') == 'No'){{ 'selected' }} @endif>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="Price" class=" form-control-label">
                                                    {{ __('Enter price') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input id="Price" type="number" class="form-control{{ $errors->has('Price') ? ' is-invalid' : '' }}" name="Price" value="@if(count($errors) > 0){{ old('Price') }}@else{{ $vehicles->price }}@endif" required autofocus>
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
                                                <select id="Brand" class="form-control{{ $errors->has('Brand') ? ' is-invalid' : '' }}" name="Brand" required>
                                                  <option value=""> -- Select brand -- </option>

                                                  @if( count($errors) > 0 )
                                                  <option value="{{ (new \App\Models\Logic\Brands)->brandId(old('Brand')) }}">{{ old('Brand') }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->vehiclebrands_id }}" selected>{{ (new \App\Models\Logic\Brands)->brandName($vehicles->vehiclebrands_id) }}</option>
                                                  @endif
                                                  
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
                                                <input id="Model" type="text" class="form-control{{ $errors->has('Model') ? ' is-invalid' : '' }}" name="Model" value="@if(count($errors) > 0){{ old('Model') }}@else{{ $vehicles->model }}@endif" required autofocus>
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
                                                 <select id="UsedOrNew" class="form-control{{ $errors->has('UsedOrNew') ? ' is-invalid' : '' }}" name="UsedOrNew" required>
                                                  <option value=""> -- Used or new -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('UsedOrNew') }}" selected>{{ ucfirst(old('UsedOrNew')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->used }}" selected>{{ ucfirst($vehicles->used) }}</option>
                                                  @endif
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
                                                <select id="Condition" class="form-control{{ $errors->has('Condition') ? ' is-invalid' : '' }}" name="Condition" required>
                                                  <option value=""> -- Select state -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('Condition') }}" selected>{{ ucfirst(old('Condition')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->condition }}" selected>{{ ucfirst($vehicles->condition) }}</option>
                                                  @endif
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
                                                <input id="Mileage" type="number" class="form-control{{ $errors->has('Mileage') ? ' is-invalid' : '' }}" name="Mileage" value="@if(count($errors) > 0){{ old('Mileage') }}@else{{ $vehicles->mileage }}@endif" required autofocus>
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
                                                <select id="Customizations" class="form-control{{ $errors->has('Customizations') ? ' is-invalid' : '' }}" name="Customizations" required>
                                                  <option value=""> -- Is the vehicle customized or not -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('Customizations') }}" selected>{{ ucfirst(old('Customizations')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->customizations }}" selected>{{ ucfirst($vehicles->customizations) }}</option>
                                                  @endif
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
                                                <textarea id="Modifications" class="form-control{{ $errors->has('Modifications') ? ' is-invalid' : '' }}" name="Modifications">@if(count($errors) > 0){{ old('Modifications') }}@else{{ $vehicles->modifications }}@endif</textarea>
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
                                                <select id="EngineChange" class="form-control{{ $errors->has('EngineChange') ? ' is-invalid' : '' }}" name="EngineChange" required>
                                                  <option value=""> -- Has the vehicle's engine been changed -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('EngineChange') }}" selected>{{ ucfirst(old('EngineChange')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->engine_change }}" selected>{{ ucfirst($vehicles->engine_change) }}</option>
                                                  @endif
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
                                                <select id="ExteriorFinish" class="form-control{{ $errors->has('ExteriorFinish') ? ' is-invalid' : '' }}" name="ExteriorFinish" required>
                                                  <option value=""> -- Select exterior paint -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('ExteriorFinish') }}" selected>{{ ucfirst(old('ExteriorFinish')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->exterior_finish }}" selected>{{ ucfirst($vehicles->exterior_finish) }}</option>
                                                  @endif
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
                                                <input id="ExteriorColour" type="text" class="form-control{{ $errors->has('ExteriorColour') ? ' is-invalid' : '' }}" name="ExteriorColour" value="@if(count($errors) > 0){{ old('ExteriorColour') }}@else{{ ucfirst($vehicles->exterior_colour) }}@endif" required autofocus>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="InteriorFinish" class=" form-control-label">
                                                    {{ __('Interior furnishing') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select id="InteriorFinish" class="form-control{{ $errors->has('InteriorFinish') ? ' is-invalid' : '' }}" name="InteriorFinish" required>
                                                  <option value=""> -- Select interior furnishing -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('InteriorFinish') }}" selected>{{ ucfirst(old('InteriorFinish')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->interior_finish }}" selected>{{ ucfirst($vehicles->interior_finish) }}</option>
                                                  @endif
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
                                                <select id="Roof" class="form-control{{ $errors->has('Roof') ? ' is-invalid' : '' }}" name="Roof" required>
                                                  <option value=""> -- Select interior furnishing -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('Roof') }}" selected>{{ ucfirst(old('Roof')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->roof }}" selected>{{ ucfirst($vehicles->roof) }}</option>
                                                  @endif
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
                                                 <select id="Accessories" class="form-control{{ $errors->has('Accessories') ? ' is-invalid' : '' }}" name="Accessories" required>
                                                  <option value=""> -- Select avaialable accessories -- </option>
                                                  @if( count($errors) > 0 )
                                                  <option value="{{ old('Accessories') }}" selected>{{ ucfirst(old('Accessories')) }}</option>
                                                  @else
                                                  <option value="{{ $vehicles->accessories }}" selected>{{ ucfirst($vehicles->accessories) }}</option>
                                                  @endif
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
                                                <input id="Tags" type="text" class="form-control{{ $errors->has('Tags') ? ' is-invalid' : '' }}" name="Tags" value="@if(count($errors) > 0){{ old('Tags') }}@else{{ $vehicles->tags }}@endif" required autofocus>
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
                                                    {{ __('Update post') }}
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
