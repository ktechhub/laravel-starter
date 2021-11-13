@extends('auth.components.layout')

@section('title', 'Confirm Password')

@section('page-title', 'Confirm Password')
@section('page-desc', 'Confirm Password')

@section('content')
    {{ __('Please confirm your password before continuing.') }}
    <form class="row g-3 needs-validation" method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">{{ __('Confirm Password') }}</button>
        </div>

        <div class="col-12">
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>

    </form>
@endsection
