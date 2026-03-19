@extends('layouts.auth')

@section('title', 'Confirm Password')

@section('content')
    <div class="auth-card">
        <div class="auth-card-header">
            <div class="auth-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            <h2>Confirm password</h2>
            <p>Please confirm your password before continuing</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            {{-- Password --}}
            <div class="form-field">
                <label for="password">{{ __('Password') }}</label>
                <div class="input-group-auth">
                    <input id="password" type="password"
                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                           name="password"
                           placeholder="Enter your password"
                           required autocomplete="current-password">
                    <i class="bi bi-lock input-icon"></i>
                    <button type="button" class="toggle-password" tabindex="-1">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>
                @error('password')
                    <span class="invalid-feedback-auth">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="mt-2">
                <button type="submit" class="btn-auth-primary">
                    <i class="bi bi-check-circle"></i>
                    {{ __('Confirm Password') }}
                </button>
            </div>

            @if (Route::has('password.request'))
                <div class="text-center mt-2">
                    <a class="auth-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
@endsection
