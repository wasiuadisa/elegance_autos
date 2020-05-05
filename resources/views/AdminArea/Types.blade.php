
@extends('layouts.AdminTemplate')

@section('preTitle') All vehicles types @endsection

@section('content')

<div class="container">

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h2>Vehicles Types </h2>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{ route('AdminIndex') }}">Administration</a></li>
                        <li class="active">Vehicles Types </li>
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
                  <th scope="col">Type name</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
              @if (count($vehicles) > 0)
              <form method="post" action="{{-- route('vehiclesManySelect') --}}">
              @foreach ($vehicles as $auto)
                <tr style="background-color: White;">
                  <td class="col-md-3">
                    <a href="{{ route('editCarTypeForm', [$auto->id,]) }}">
                      {{ ucfirst(htmlspecialchars_decode($auto->name)) }}
                    </a>
                  </td>
                  <td class="col-md-3" style="padding-top: -10px;">
                    <a href="{{ route('editCarTypeForm', [$auto->id,]) }}" class="btn btn-success btn-sm">
                      Edit
                    </a>
                  @if($auto->delete == 0)
                    <a href="{{ route('typeDelete', [$auto->id,]) }}" class="btn btn-danger btn-sm">
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
          <br>
          <br>
            <ul class="pagination pagination-lg">
              {{ $vehicles->links() }}
            </ul>
          </div>
          
        </div><!-- End of row -->
    </div>

</div>
<!-- .container -->
@endsection
