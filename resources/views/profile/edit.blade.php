@extends('layouts.form_layout')

@section('title', __('messages.profile_page_title'))

@section('form_body')

<h2>{{ __('messages.profile') }}</h2>

<p class="note">
        {{ __('messages.edit_profile_note') }}

</p>

@if (session('status') === 'profile-updated')
    <p style="color: green; text-align: center; margin-bottom: 15px;">
        {{ __('messages.profile_updated') }}
    </p>
@endif

<!-- ✅ البيانات الشخصية -->
<div class="form-section">
    <h3>{{ __('messages.personal_information') }}</h3>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <label>{{ __('messages.student_name') }}</label>

        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>{{ __('messages.email') }}</label>

        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>{{ __('messages.student_number') }}</label>

        <input type="text"
               value="{{ $user->student_number ?? __('messages.not_specified') }}"
               readonly
               style="background:#f8f8f8; cursor:not-allowed;">

        <label>{{ __('messages.department') }}</label>
        <input type="text"
               value="{{ $user->department->name ?? __('messages.not_specified') }}"
               readonly
               style="background:#f8f8f8; cursor:not-allowed;">

<button type="submit" class="login-btn">
    {{ __('messages.save_changes') }}
</button>
    </form>
</div>

<!-- 🔐 تغيير كلمة المرور -->
<div class="form-section">
    <h3>{{ __('messages.change_password') }}</h3>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <label>{{ __('messages.current_password') }}</label>
        <input type="password" name="current_password">

        @error('current_password', 'updatePassword')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>{{ __('messages.new_password') }}</label>
        <input type="password" name="password">

        @error('password', 'updatePassword')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>{{ __('messages.confirm_new_password') }}</label>
        <input type="password" name="password_confirmation">

        <button type="submit" class="login-btn">
            {{ __('messages.update_password') }}
        </button>
    </form>
</div>

<!-- 🗑️ حذف الحساب -->
<div class="form-section">
    <h3 style="color:#c0392b;">{{ __('messages.delete_account') }}</h3>

    <p class="note">
    {{ __('messages.delete_account_warning') }}
</p>

    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')

    <label>
       {{ __('messages.enter_password_to_delete') }}
    </label>        <input type="password" name="password" required>

        @error('password', 'userDeletion')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit"
        class="login-btn"
        style="background:#c0392b;">
    {{ __('messages.delete_account') }}
</button>
    </form>
</div>

<p style="text-align:center; margin-top:15px;">
    <a href="{{ url('/') }}">
    {{ __('messages.back_home') }}
</a>
</p>

@endsection