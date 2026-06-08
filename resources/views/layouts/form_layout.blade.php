<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    
</head>
<body>

<div class="auth-wrapper">
    <div class="overlay"></div>

    <div class="login-container">
        @yield('form_body')
    </div>
</div>

</body>
</html>