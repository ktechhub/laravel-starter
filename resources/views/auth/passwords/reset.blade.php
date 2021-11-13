@extends('auth.components.layout')

@section('title', 'Reset Password')

@section('page-title', 'Reset Password')
@section('page-desc', 'Reset Password')

@section('content')
    <form class="row g-3 needs-validation" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="col-12">
            <label for="yourEmail" class="form-label">Your Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-12">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Reset Password</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">{{ __('Remembered your password?') }} <a href="{{ route('login') }}">Log in</a></p>
        </div>
    </form>
@endsection
