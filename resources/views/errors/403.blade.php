@extends('layouts.PublicTemplate2')

@section('preTitle') Error 403 @endsection

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            
            <div class="span2">
            </div>

            <div class="span8">
                <h3>Error 403! Forbidden</h3>

                <div class="row-fluid">
                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>Error 403! Forbidden</strong>
                            <p>{{ $exception->getMessage() ?: 'Forbidden' }}</p>
                            <p>You do not have access rights to the content, i.e. you are unauthorized to access the content, so the server is rejecting giving you proper response.</p>
                        </span>
                    </div>
                </div>
        	</div>
            
            <div class="span2">
            </div>

        </div>
    </section>
@endsection
