@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
    <div class="auth-card">
        <div class="auth-card-header">
            <div class="auth-icon">
                <i class="bi bi-envelope-paper"></i>
            </div>
            <h2>Forgot password?</h2>
            <p>Enter your email and we'll send you a reset link</p>
        </div>

        {{-- Success Message --}}
        @if (session('status'))
            <div class="auth-alert auth-alert-success">
                <i class="bi bi-check-circle alert-icon"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Email --}}
            <div class="form-field">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <div class="input-group-auth">
                    <input id="email" type="email"
                           class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Enter your email address"
                           required autocomplete="email" autofocus>
                    <i class="bi bi-envelope input-icon"></i>
                </div>
                @error('email')
                    <span class="invalid-feedback-auth">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="mt-2">
                <button type="submit" class="btn-auth-primary">
                    <i class="bi bi-send"></i>
                    {{ __('Send Reset Link') }}
                </button>
            </div>
        </form>
    </div>

    <div class="auth-bottom-text">
        Remember your password? <a href="{{ route('login') }}">Back to sign in</a>
    </div>
@endsection
