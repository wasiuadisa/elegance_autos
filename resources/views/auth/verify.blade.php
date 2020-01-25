
@section('preTitle') Email reset @endsection

@extends('layouts.PublicTemplate2')

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            <div class="span2">
            </div>
            <div class="span8">
                <h3>{{ __('Verify Your Email Address') }}</h3>
                <div class="row-fluid">
                    @if (session('resent'))
                    <div class="span12 text-center alert alert-danger">
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    </div>
                    @endif

                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                            </strong>
                            <strong>
                                {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                            </strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="span2">
            </div>
        </div>
    </section>
@endsection
