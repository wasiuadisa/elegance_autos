@extends('layouts.PublicTemplate2')

@section('preTitle') Error 429 @endsection

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            
            <div class="span2">
            </div>

            <div class="span8">
                <h3>Error 429! Too Many Requests</h3>

                <div class="row-fluid">
                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>Error 429! Too Many Requests</strong>
                            <p>You have sent too many requests to the server.</p>
                        </span>
                    </div>
                </div>
        	</div>
            
            <div class="span2">
            </div>

        </div>
    </section>
@endsection