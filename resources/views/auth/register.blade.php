@section('preTitle') Registration @endsection

@extends('layouts.PublicTemplate2')

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            <div class="span2">
            </div>
            <div class="span8">
                <h3>Register</h3>
                <div class="row-fluid">
                    @error('name')
                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                    @error('email')
                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                    @error('password')
                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                </div>
                <form method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="row-fluid form-group-row">
                        <div class="span6">
                            <label>{{ __('Name') }}</label>
                            <input id="name" name="name" type="text" class="input-block-level form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required focus>
                        </div>
                        <div class="span6">
                            <label>Email Address</label>
                            <input id="email" name="email" type="email" class="input-block-level form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required focus>
                        </div>
                    </div>
                    <div class="row-fluid form-group-row">
                        <div class="span6">
                            <label>{{ __('Password') }}</label>
                            <input id="password" name="password" type="password" class="input-block-level form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" required focus>
                        </div>
                        <div class="span6">
                            <label>{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" name="password_confirmation" type="password" class="input-block-level form-control" value="{{ old('password_confirmation') }}" required>
                        </div>
                    </div>
                    <div class="row-fluid form-group-row">
                        <div class="span12">
                            <button type="submit" class="btn btn-primary btn-large">    {{ __('Register') }}
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
