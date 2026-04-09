@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')
    <div class="auth-card">
        <div class="auth-card-header">
            <div class="auth-icon">
                <i class="bi bi-envelope-check"></i>
            </div>
            <h2>Verify your email</h2>
            <p>We've sent a verification link to your inbox</p>
        </div>

        {{-- Success Message --}}
        @if (session('resent'))
            <div class="auth-alert auth-alert-success">
                <i class="bi bi-check-circle alert-icon"></i>
                <span>{{ __('A fresh verification link has been sent to your email address.') }}</span>
            </div>
        @endif

        <div style="text-align: center; color: var(--text-secondary); font-size: 0.9rem; line-height: 1.7; margin-bottom: 1.5rem;">
            <i class="bi bi-mailbox" style="font-size: 2.5rem; color: var(--nd-primary); display: block; margin-bottom: 1rem;"></i>
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            click the button below to request a new one.
        </div>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn-auth-primary">
                <i class="bi bi-arrow-repeat"></i>
                {{ __('Resend Verification Email') }}
            </button>
        </form>
    </div>

    <div class="auth-bottom-text">
        <a href="{{ route('login') }}">Back to sign in</a>
    </div>
@endsection
