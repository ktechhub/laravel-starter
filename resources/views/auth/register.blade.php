@extends('auth.components.layout')

@section('title', 'Register')

@section('page-title', 'Create an Account')
@section('page-desc', 'Enter your personal details to create account')

@section('content')
    <form class="row g-3 needs-validation" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="col-12">
            <label for="name" class="form-label">Your Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-12">
            <label for="yourEmail" class="form-label">Your Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-12">
            <label for="username" class="form-label">Username</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" name="username" class="form-control" id="username" @error('username') is-invalid
                    @enderror required value="{{ old('username') }}">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
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
            <div class="form-check">
                <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                <label class="form-check-label" for="acceptTerms">I agree and accept the
                    <a href="#">terms and conditions</a></label>
                <div class="invalid-feedback">You must agree before submitting.</div>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Create Account</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">{{ __('Already have an account?') }} <a href="{{ route('login') }}">Log in</a></p>
        </div>
    </form>
@endsection
