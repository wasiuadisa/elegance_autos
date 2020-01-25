@section('preTitle') Password reset @endsection

@extends('layouts.PublicTemplate2')

@section('content')
    <section id="contact-page" class="container">
        <div class="row-fluid">
            <div class="span2">
            </div>
            <div class="span8">
                <h3>Reset Password</h3>
                <div class="row-fluid">
                    @if (session('status'))
                    <div class="span12 text-center alert alert-success">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                    @endif
                    @if ($errors->has('email'))
                    <div class="span12 text-center alert alert-danger">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    </div>
                    @endif
                </div>
                <form method="post" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row-fluid">
                        <div class="span12">
                            <label>Email Address</label>
                            <input id="email" type="email" class="input-block-level form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required focus>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <button type="submit" class="btn btn-primary btn-large">    {{ __('Send Password Reset Link') }}
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
