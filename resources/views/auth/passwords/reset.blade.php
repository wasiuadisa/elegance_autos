
@section('preTitle') Reset Password @endsection

@extends('layouts.PublicTemplate2')

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            <div class="span2">
            </div>
            <div class="span8">
                <h3>Reset Password</h3>
                <div class="row-fluid">
                    @if ($errors->has('email'))
                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
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
                <form method="post" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row-fluid">
                        <div class="span6">
                            <label>{{ __('E-Mail Address') }}</label>
                            <input id="email" name="email" type="email" class="input-block-level form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $email ?? old('email') }}" required focus>
                        </div>
                        <div class="span6">
                            <label>{{ __('Password') }}</label>
                            <input type="password" id="password" name="password" class="input-block-level form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required focus>
                        </div>
                        <div class="span6">
                            <label>{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" name="password_confirmation" type="password" class="input-block-level" required>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <button type="submit" class="btn btn-primary btn-large">    {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="span2">
            </div>
        </div>
    </section>
@endsection
