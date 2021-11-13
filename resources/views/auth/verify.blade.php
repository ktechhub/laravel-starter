@extends('auth.components.layout')

@section('title', 'Email Verification')

@section('page-title', 'Email Verification')
@section('page-desc', 'Verify Your Email Address')

@section('content')

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <br><br>


    <form class="row g-3 needs-validation" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">{{ __('click here to request another') }}</button>
        </div>
    </form>
@endsection
