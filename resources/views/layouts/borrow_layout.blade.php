<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="borrow-page">

    <div class="borrow-overlay">
        <div class="borrow-box">
            @yield('content')
        </div>
    </div>
     @yield('scripts')
</body>
</html>