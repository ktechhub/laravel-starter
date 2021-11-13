@extends('auth.components.layout')

@section('title', 'Reset Password')

@section('page-title', 'Reset Password')
@section('page-desc', 'Reset Your Password')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form class="row g-3 needs-validation" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="col-12">
            <label for="email" class="form-label">Your Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
@endsection
