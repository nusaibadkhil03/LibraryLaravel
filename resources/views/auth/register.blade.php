@extends('layouts.form_layout')

@section('title', __('messages.register_page_title'))

@section('form_body')

<h2>{{ __('messages.create_account') }}</h2>

<p class="note">
    {{ __('messages.university_email_note') }}
</p>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="name">{{ __('messages.student_name') }}</label>
    <input
        id="name"
        type="text"
        name="name"
        value="{{ old('name') }}"
        placeholder="{{ __('messages.full_name') }}"
        required
        autofocus
        autocomplete="name"
    >
    @error('name')
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="email">{{ __('messages.university_email') }}</label>
    <input
        id="email"
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="xxxxxxx@libyanuniv.edu.ly"
        required
        autocomplete="username"
    >
    @error('email')
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="student_number">{{ __('messages.student_number') }}</label>
    <input
        id="student_number"
        type="text"
        name="student_number"
        value="{{ old('student_number') }}"
        placeholder="{{ __('messages.enter_student_number') }}"
        required
    >
    @error('student_number')
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="phone">{{ __('messages.phone_number') }}</label>
    <input
        id="phone"
        type="text"
        name="phone"
        value="{{ old('phone') }}"
        placeholder="{{ __('messages.phone_number') }}"
        required
    >
    @error('phone')
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="department_id">{{ __('messages.department') }}</label>
    <select
        id="department_id"
        name="department_id"
        required
        style="width:100%; padding:12px; margin-bottom:18px; border-radius:10px; border:1px solid #ddd;"
    >
        <option value="">{{ __('messages.select_department') }}</option>

        @foreach($departments as $department)
            <option value="{{ $department->id }}"
                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                {{ app()->getLocale() == 'en'
                    ? ucwords(str_replace('-', ' ', $department->slug))
                    : $department->name }}
            </option>
        @endforeach
    </select>
    @error('department_id')
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
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
        autocomplete="new-password"
    >
    @error('password')
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="password_confirmation">{{ __('messages.confirm_password') }}</label>
    <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        placeholder="{{ __('messages.confirm_password_placeholder') }}"
        required
        autocomplete="new-password"
    >
    @error('password_confirmation')
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            {{ $message }}
        </p>
    @enderror

    <button type="submit" class="login-btn">
        {{ __('messages.create_account') }}
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    {{ __('messages.have_account') }}
    <a href="{{ route('login') }}">
        {{ __('messages.login') }}
    </a>
</p>

@endsection