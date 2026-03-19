@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <div class="auth-card">
        <div class="auth-card-header">
            <div class="auth-icon">
                <i class="bi bi-key"></i>
            </div>
            <h2>Reset password</h2>
            <p>Enter your new password below</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email --}}
            <div class="form-field">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <div class="input-group-auth">
                    <input id="email" type="email"
                           class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                           name="email"
                           value="{{ $email ?? old('email') }}"
                           placeholder="Enter your email address"
                           required autocomplete="email" autofocus>
                    <i class="bi bi-envelope input-icon"></i>
                </div>
                @error('email')
                    <span class="invalid-feedback-auth">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-field">
                <label for="password">{{ __('New Password') }}</label>
                <div class="input-group-auth">
                    <input id="password" type="password"
                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                           name="password"
                           placeholder="Enter new password"
                           required autocomplete="new-password">
                    <i class="bi bi-lock input-icon"></i>
                    <button type="button" class="toggle-password" tabindex="-1">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>
                <div style="margin-top: 0.4rem; font-size: 0.75rem; color: #6b7280; line-height: 1.6;">
                    Must contain: uppercase, lowercase, number, special character, min 8 chars
                </div>
                @error('password')
                    <span class="invalid-feedback-auth">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-field">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <div class="input-group-auth">
                    <input id="password-confirm" type="password"
                           name="password_confirmation"
                           placeholder="Confirm new password"
                           required autocomplete="new-password">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <button type="button" class="toggle-password" tabindex="-1">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-2">
                <button type="submit" class="btn-auth-primary">
                    <i class="bi bi-check-circle"></i>
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>

    <div class="auth-bottom-text">
        Remember your password? <a href="{{ route('login') }}">Back to sign in</a>
    </div>
@endsection
