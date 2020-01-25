@section('preTitle') Login @endsection

@section('extraHeadContent')
    <!-- reCaptcha Version 2 -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@extends('layouts.PublicTemplate2')

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            <div class="span2">
            </div>
            <div class="span8">
                <h3>Login</h3>
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="row-fluid">
                        @if ($errors->has('email'))
                        <div class="span12 text-center alert alert-danger">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        </div>
                        @endif
                        @if ($errors->has('password'))
                        <div class="span12 text-center alert alert-danger">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <label>Email Address</label>
                            <input id="email" name="email" type="email" class="input-block-level form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required focus>
                        </div>
                        <div class="span6">
                            <label>Password</label>
                            <input id="password" name="password" type="password" class="input-block-level {{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                        @if($_SERVER['HTTP_HOST'] == config('app.domainUrl'))
                            <!-- reCaptcha Version 2 -->
                            <div class="g-recaptcha" data-sitekey="{{ config('app.recaptcha_genuine_site') }}"></div>
                        @else
                            <!-- reCaptcha Version 2 -->
                            <div class="g-recaptcha" data-sitekey="{{ config('app.recaptcha_sample_site') }}"></div>
                        @endif
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span2">
                            <label class="form-check-label" for="remember">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="span2">
                            <button type="submit" class="btn btn-primary btn-large">    {{ __('Login') }}
                            </button>
                        </div>
                        <div class="span8">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                <button class="btn btn-primary btn-large">
                                    {{ __('Forgot Your Password?') }}
                                </button>
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="span2">
            </div>
        </div>
    </section>
@endsection
