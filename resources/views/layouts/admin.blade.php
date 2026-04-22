<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الأدمن</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: "Tahoma", sans-serif;
    }

    body {
        background: #f8f9fc;
        direction: rtl;
        color: #1f2937;
    }

    .admin-wrapper {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 260px;
        background: linear-gradient(180deg, #e67e22 0%, #cf711f 100%);
        color: white;
        padding: 20px;
        flex-shrink: 0;
        box-shadow: -2px 0 12px rgba(0, 0, 0, 0.08);
    }

    .sidebar h2 {
        font-size: 28px;
        margin-bottom: 30px;
        text-align: center;
        color: #fff;
        font-weight: bold;
    }

    .sidebar a {
        display: block;
        color: rgba(255, 255, 255, 0.92);
        text-decoration: none;
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 10px;
        transition: 0.3s ease;
        font-size: 18px;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background: rgba(255, 255, 255, 0.18);
        color: #fff;
        transform: translateX(-3px);
    }

    .main-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .topbar {
        background: #ffffff;
        padding: 20px 30px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .topbar h1 {
        font-size: 22px;
        color: #e67e22;
        font-weight: bold;
    }

    .topbar .admin-info {
        color: #374151;
        font-size: 15px;
    }

    .content {
        padding: 30px;
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card {
        background: #ffffff;
        padding: 25px;
        border-radius: 18px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        border-top: 5px solid #e67e22;
        transition: 0.3s ease;
    }

    .card:hover {
        transform: translateY(-4px);
    }

    .card h3 {
        font-size: 18px;
        margin-bottom: 12px;
        color: #374151;
    }

    .card p {
        font-size: 34px;
        font-weight: bold;
        color: #e67e22;
    }

    .section-box {
        background: #ffffff;
        padding: 25px;
        border-radius: 18px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .section-box h2 {
        margin-bottom: 15px;
        color: #e67e22;
        font-size: 24px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        background: white;
        border-radius: 12px;
        overflow: hidden;
    }

    table th,
    table td {
        padding: 14px;
        border-bottom: 1px solid #f1f1f1;
        text-align: right;
    }

    table th {
        background: #fff4ec;
        color: #a04e0f;
        font-weight: bold;
    }

    table tr:hover {
        background: #fffaf6;
    }

    .btn,
    button {
        background: #e67e22;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .btn:hover,
    button:hover {
        background: #cf711f;
    }
</style>
</head>
<body>

<div class="admin-wrapper">
    <aside class="sidebar">
        <h2>لوحة الأدمن</h2>

        <a href="{{ route('admin.dashboard') }}">الرئيسية</a>
        <a href="{{ route('admin.departments.index') }}">الأقسام</a>
        <a href="{{ route('admin.books.index') }}">الكتب</a>
        <a href="{{ route('admin.digital-books.index') }}">الكتب الرقمية</a>
        <a href="{{ route('admin.borrows.index') }}">الاستعارات</a>
        <a href="{{ route('admin.syllabuses.index') }}">المناهج</a>
        <a href="{{ route('admin.past-exams.index') }}">أسئلة السنوات</a>
        <a href="{{ route('admin.projects.index') }}">مشاريع التخرج</a>
        <a href="{{ route('admin.students.index') }}">الطلبة</a>
        <a href="{{ route('admin.admins.index') }}">الأدمنات</a>
        <a href="#">الإعدادات</a>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <h1>@yield('page_title', 'لوحة التحكم')</h1>
            <div class="admin-info">
                مرحبًا، {{ auth()->user()->name }}
            </div>
        </div>

        <main class="content">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>