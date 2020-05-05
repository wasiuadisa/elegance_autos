
@extends('layouts.AdminTemplate')

@section('preTitle') {{ $categoryName }} vehicles in stock @endsection

@section('content')

<div class="container">

    <div class="breadcrumbs">
        <div class="col-sm-6">
            <div class="page-header float-left">
                <div class="page-title">
                    <h2>{{ $categoryName }} vehicles in stock</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                      <li><a href="{{ route('home') }}">Dashboard</a></li>
                      <li class="active">{{ $categoryName }} vehicles in stock</li>
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
                  <?php /*<th scope="col">Category</th>
                  */ ?><th scope="col">Brand name</th>
                  <th scope="col">Title</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
              @if (count($vehicles) > 0)
              <form method="post" action="{{-- route('vehiclesManySelect') --}}">
              @foreach ($vehicles as $auto)
                @if ($auto->sold == 0)
                <tr style="background-color: White;">
                @else
                <tr style="background-color: LightGray;">
                @endif
                  <?php /*<td class="col-md-1">
                    <a href="{{ route('postView', [$auto->id,]) }}">
                      {{ (new \App\Models\Logic\Types)->typeName($auto->vehicletypes_id) }}
                    </a>
                  </td>*/ ?>
                  <td class="col-md-3">
                    <a href="{{ route('postView', [$auto->id,]) }}">
                      {{ (new \App\Models\Logic\Brands)->brandName($auto->vehiclebrands_id) }}
                    </a>
                  </td>
                  <td class="col-md-5">
                    <a href="{{ route('postView', [$auto->id,]) }}">
                      {{ str_limit($auto->title, 150, '...') }}
                    </a>
                  </td>
                  <td class="col-md-3" style="padding-top: -10px;">
                    <a href="{{ route('editCarForm', [$auto->id,]) }}" class="btn btn-success btn-sm">
                      Edit
                    </a>
                  @if($auto->sold == 0)
                    <a href="{{ route('postSoldForCategories', [$auto->id, $categoryName]) }}" class="btn btn-success btn-sm">{{-- route('categoryList', [$categoryName]) --}}
                      Mark as Sold
                    </a>
                  @else
                    <a href="#" class="btn btn-success btn-sm">
                      Sold
                    </a>
                  @endif
                  @if($auto->delete == 0)
                    <a href="{{ route('postDeleteForCategories', [$auto->id, $categoryName]) }}" class="btn btn-danger btn-sm">
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
              {{ $vehicles->links() }}
            </ul>
          </div>
          
        </div><!-- End of row -->
    </div>

</div>
<!-- .container -->
@endsection
