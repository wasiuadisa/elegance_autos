@extends('layouts.PublicTemplate2')

@section('preTitle') Error 500 @endsection

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            
            <div class="span2">
            </div>

            <div class="span8">
                <h3>Error 500! Server Error</h3>

                <div class="row-fluid">
                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>Error 500! Server Error</strong>
                            <p>The Page you are looking for won't load because the server has encountered an error while processing your requested page.</p>
                        </span>
                    </div>
                </div>
        	</div>
            
            <div class="span2">
            </div>

        </div>
    </section>
@endsection
