@extends('layouts.base')

@section('content')

<section class="section">
    <div class="container">
        <header class="section-header">
            <small>VERIFICATION</small>
            <h2>{{ __('Verify Your Email Address') }}</h2>

            @if (session('resent'))

                <div class="alert alert-success" style="color: white; background-color: #46da60" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            <hr>
            <p class="lead">
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>
            </p>
        </header>
    </div>
</section>
@endsection
