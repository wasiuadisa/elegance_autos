
@extends('layouts.PublicTemplate2')

@section('preTitle') Contact Us @endsection

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            <div class="span8">
                <h3>Contact Form</h3>
                @if (session('infoStatus'))
                <div class="row-fluid">
                    <div class="span12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="badge badge-pill badge-success">Success</span> 
                            {{ session('infoStatus') }}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                @if( count($errors) > 0 )
                <div class="row-fluid">
                    <div class="span12">
                        <p class="alert alert-danger text-center">Your message could not be sent due to the following:</p>
                        @foreach( $errors->all() as $error )
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="badge badge-pill badge-danger">Error</span> {{ $error }}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <form method="post" action="{{ route('publicContactData') }}">
                    @csrf
                    <div class="row-fluid">
                        <div class="span5">
                            <label>Full Name</label>
                            <input type="text" class="input-block-level" required="required" placeholder="Your Full Name" id="name" name="name">
                            <label>Email Address</label>
                            <input type="text" class="input-block-level" required="required" placeholder="Your Email Address" id="email" name="email">
                            <label>Telephone</label>
                            <input type="text" class="input-block-level" required="required" placeholder="Your Telephone" id="phone" name="phone">
                        </div>
                        <div class="span7">
                            <label>Message</label>
                            <textarea name="message" id="message" required="required" class="input-block-level" rows="8"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-large pull-right">Send Message</button>
                </form>
            </div>
            <div class="span3">
                <div style="height:60px"></div>
                <h4>Elegance Autos</h4>
                <p>
                    <i class="icon-home"></i> 1, Afolabi Lawal street, Off Olawani street, Itele road<br>
                    Ayetoro-Itele, Ogun state.
                </p>
                <p>
                    <i class="icon-envelope"></i> <a href="mailto:info@eleganceautos.com">info@eleganceautos.com</a>
                </p>
                <p>
                    <i class="icon-phone"></i> +234-7056-8755-52
                </p>
                <p>
                    <i class="icon-globe"></i> <a href="http://www.domain.com">www.eleganceautos.com</a>
                </p>
            </div>
        </div>
    </section>
@endsection
