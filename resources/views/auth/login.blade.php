@extends('layouts.form_layout')

@section('title', __('messages.login_page_title'))

@section('form_body')

<h2>{{ __('messages.login') }}</h2>

<p class="note">
    {{ __('messages.login_note') }}
</p>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <label for="email">{{ __('messages.email') }}</label>
    <input
        id="email"
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="example@libyanuniv.edu.ly"
        required
        autofocus
        autocomplete="username"
    >
    @error('email')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="password">{{ __('messages.password') }}</label>
    <input
        id="password"
        type="password"
        name="password"
        placeholder="{{ __('messages.password_placeholder') }}"
        required
        autocomplete="current-password"
    >
    @error('password')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <div style="margin-bottom: 15px;">
        <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
            <input type="checkbox" name="remember" style="width: auto; margin: 0;">
            {{ __('messages.remember_me') }}
        </label>
    </div>

    @if (Route::has('password.request'))
        <p style="text-align: center; margin-bottom: 15px;">
            <a href="{{ route('password.request') }}">
                {{ __('messages.forgot_password') }}
            </a>
        </p>
    @endif

    <button type="submit" class="login-btn">
        {{ __('messages.login') }}
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    {{ __('messages.no_account') }}
    <a href="{{ route('register') }}">
        {{ __('messages.create_account') }}
    </a>
</p>

@endsection