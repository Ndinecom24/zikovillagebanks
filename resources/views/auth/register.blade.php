@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="auth-card">
        <div class="auth-card-header">
            <div class="auth-icon">
                <i class="bi bi-person-plus"></i>
            </div>
            <h2>Create an account</h2>
            <p>Register to IPP Management System</p>
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Man Number --}}
            <div class="form-field">
                <label for="staff_no">{{ __('Man Number') }}</label>
                <div class="input-group-auth">
                    <input id="staff_no" type="text"
                           class="{{ $errors->has('staff_no') ? 'is-invalid' : '' }}"
                           name="staff_no"
                           value="{{ old('staff_no') }}"
                           placeholder="Enter your man number"
                           required autocomplete="staff_no" autofocus>
                    <i class="bi bi-person-badge input-icon"></i>
                </div>
                @error('staff_no')
                    <span class="invalid-feedback-auth">{{ $message }}</span>
                @enderror
            </div>

            {{-- Name --}}
            <div class="form-field">
                <label for="name">{{ __('Full Name') }}</label>
                <div class="input-group-auth">
                    <input id="name" type="text"
                           class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Enter your full name"
                           required>
                    <i class="bi bi-person input-icon"></i>
                </div>
                @error('name')
                    <span class="invalid-feedback-auth">{{ $message }}</span>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="form-field">
                <label for="phone">{{ __('Extension / Phone') }}</label>
                <div class="input-group-auth">
                    <input id="phone" type="text"
                           class="{{ $errors->has('phone') ? 'is-invalid' : '' }}"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="Enter your phone or extension"
                           required autocomplete="phone">
                    <i class="bi bi-telephone input-icon"></i>
                </div>
                @error('phone')
                    <span class="invalid-feedback-auth">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-field">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <div class="input-group-auth">
                    <input id="email" type="email"
                           class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Enter your email address"
                           required autocomplete="email">
                    <i class="bi bi-envelope input-icon"></i>
                </div>
                @error('email')
                    <span class="invalid-feedback-auth">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-field">
                <label for="password">{{ __('Password') }}</label>
                <div class="input-group-auth">
                    <input id="reg_password" type="password"
                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                           name="password"
                           placeholder="Create a strong password"
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
                           placeholder="Confirm your password"
                           required autocomplete="new-password">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <button type="button" class="toggle-password" tabindex="-1">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>
            </div>

            {{-- Hidden Fields --}}
            <input type="hidden" name="profile_id" value="{{ config('constants.user_profiles.initiator') }}">
            <input type="hidden" name="type_id" value="{{ config('constants.user_types.normal') }}">

            {{-- Submit --}}
            <div class="mt-2">
                <button type="submit" class="btn-auth-primary">
                    <i class="bi bi-person-check"></i>
                    {{ __('Create Account') }}
                </button>
            </div>
        </form>
    </div>

    <div class="auth-bottom-text">
        Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </div>
@endsection
