@extends('layouts.PublicTemplate2')

@section('preTitle') Error 404 @endsection

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            
            <div class="span2">
            </div>

            <div class="span8">
                <h3>Error 404! Page not found</h3>

                <div class="row-fluid">
                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>Error 404! Page not found</strong>
                            <p>The Page you are looking for doesn't exist.</p>
                        </span>
                    </div>
                </div>
        	</div>
            
            <div class="span2">
            </div>

        </div>
    </section>
@endsection
