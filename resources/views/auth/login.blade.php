@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="auth-card">
        <div class="auth-card-header">
            <div class="auth-icon">
                <i class="bi bi-box-arrow-in-right"></i>
            </div>
            <h2>Welcome back</h2>
            <p>Sign in to {{ Env('APP_NAME') }}</p>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="auth-alert auth-alert-danger">
                <i class="bi bi-exclamation-circle alert-icon"></i>
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="auth-alert auth-alert-danger">
                <i class="bi bi-exclamation-circle alert-icon"></i>
                <span>{{ session()->get('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Login (Username / Email / Phone) --}}
            <div class="form-field">
                <label for="login">{{ __('Username, Email or Phone') }}</label>
                <div class="input-group-auth">
                    <input id="login" type="text"
                           class="{{ $errors->has('login') ? 'is-invalid' : '' }}"
                           name="login"
                           value="{{ old('login') }}"
                           placeholder="Enter username, email or phone"
                           required autocomplete="username" autofocus>
                    <i class="bi bi-person input-icon"></i>
                </div>
                @error('login')
                    <span class="invalid-feedback-auth">{{ $message }}</span>
                @enderror
            </div>

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

            {{-- Remember & Forgot --}}
            <div class="auth-form-footer mb-0">
                <div class="form-check-auth">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">{{ __('Remember me') }}</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            {{-- Submit --}}
            <div class="mt-3">
                <button type="submit" class="btn-auth-primary">
                    <i class="bi bi-arrow-right-circle"></i>
                    {{ __('Sign In') }}
                </button>
            </div>
        </form>
    </div>

    {{-- Register Link --}}
    @if (Route::has('register'))
        <div class="auth-bottom-text">
            Don't have an account? <a href="{{ route('register') }}">Create one</a>
        </div>
    @endif
@endsection
