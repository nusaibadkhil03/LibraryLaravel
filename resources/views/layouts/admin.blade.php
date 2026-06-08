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
        }

        .sidebar h2 {
            font-size: 28px;
            margin-bottom: 30px;
            text-align: center;
            color: #fff;
            font-weight: bold;
        }

        .sidebar a,
.sidebar-dropdown-btn {
    display: block;
    width: 100%;
    color: white;
    text-decoration: none;
    padding: 14px 16px;
    border-radius: 12px;
    margin-bottom: 10px;
    font-size: 18px;
    background: transparent;
    border: none;
    text-align: right;
    cursor: pointer;
    transition: 0.3s;
}

.sidebar a:hover,
.sidebar a.active,
.sidebar-dropdown.open > .sidebar-dropdown-btn,
.sidebar-dropdown.active > .sidebar-dropdown-btn {
    background: rgba(255, 255, 255, 0.22);
}

.sidebar-dropdown-btn {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.sidebar-dropdown-content {
    display: none;
    padding-right: 15px;
    margin-bottom: 10px;
}

.sidebar-dropdown.open .sidebar-dropdown-content {
    display: block;
}

.sidebar-dropdown-content a {
    font-size: 15px;
    padding: 10px 14px;
    margin-bottom: 6px;
    background: rgba(255,255,255,0.08);
}

.sidebar-dropdown-content a:hover,
.sidebar-dropdown-content a.active {
    background: #fff;
    color: #e67e22;
    font-weight: bold;
}

.arrow {
    transition: 0.3s;
}

.sidebar-dropdown.open .arrow {
    transform: rotate(180deg);
}

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #ffffff;
            padding: 18px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h1 {
            font-size: 24px;
            color: #e67e22;
            font-weight: bold;
        }

        .admin-info {
            color: #374151;
            font-size: 15px;
        }

        .admin-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-logout-btn {
            background-color: #e67e22;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .admin-logout-btn:hover {
            background-color: #cf711f;
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
        }

        .btn:hover,
        button:hover {
            background: #cf711f;
        }
        .container {
    padding: 20px;
}

.table {
    width: 100%;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
}

.table th {
    background: #e67e22;
    color: white;
}

.table td, .table th {
    padding: 10px;
    text-align: center;
}

.btn {
    padding: 6px 12px;
    border-radius: 6px;
}

.admin-search-container {
    position: relative;
    width: 360px;
    max-width: 100%;
    display: flex;
    align-items: center;
    background: #f8f9fc;
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: visible;
}

.admin-search-container input {
    width: 100%;
    border: none;
    background: transparent;
    padding: 12px 15px;
    outline: none;
    font-family: inherit;
}

.admin-search-container button {
    background: #e67e22;
    color: white;
    border: none;
    padding: 12px 15px;
    border-radius: 8px;
}

.admin-live-search-results {
    position: absolute;
    top: 52px;
    right: 0;
    width: 100%;
    background: white;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
    z-index: 99999;
    display: none;
    overflow: hidden;
}

.admin-live-search-item {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 12px 15px;
    color: #333;
    text-decoration: none;
    border-bottom: 1px solid #f1f1f1;
}

.admin-live-search-item:hover {
    background: #fff4ec;
}

.admin-live-search-item small {
    color: #e67e22;
    font-weight: bold;
}

.admin-live-search-empty {
    padding: 15px;
    color: #999;
    text-align: center;
}

.admin-table-card {
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
}

.admin-table th {
    background: #e67e22;
    color: #fff;
    padding: 14px;
    text-align: center;
    font-weight: bold;
}

.admin-table td {
    padding: 14px;
    text-align: center;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

.admin-table tr:hover {
    background: #fff7ed;
}

.success-message {
    background: #eaf8ee;
    color: #218838;
    padding: 12px 18px;
    border-radius: 12px;
    margin-bottom: 18px;
    font-weight: bold;
}

.admin-filter-form {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}

.admin-filter-form input,
.admin-filter-form select {
    padding: 11px 15px;
    border: 1px solid #ddd;
    border-radius: 12px;
    background: white;
    min-width: 180px;
    font-family: inherit;
}

.admin-filter-form input:focus,
.admin-filter-form select:focus {
    border-color: #e67e22;
    outline: none;
}

.student-actions {
    display: flex;
    justify-content: center;
    gap: 7px;
    flex-wrap: wrap;
}

.btn-active,
.btn-warning,
.btn-danger {
    color: white;
    border: none;
    padding: 7px 13px;
    border-radius: 18px;
    cursor: pointer;
    font-weight: bold;
}

.btn-active {
    background: #16a34a;
}

.btn-warning {
    background: #f59e0b;
}

.btn-danger {
    background: #dc3545;
}

.status-active,
.status-inactive,
.status-suspended {
    padding: 6px 14px;
    border-radius: 18px;
    font-weight: bold;
    font-size: 14px;
}

.status-active {
    background: #dcfce7;
    color: #166534;
}

.status-inactive {
    background: #fef3c7;
    color: #92400e;
}

.status-suspended {
    background: #fee2e2;
    color: #991b1b;
}
    </style>
</head>

<body>

<div class="admin-wrapper">

   <aside class="sidebar">
    <h2>لوحة الأدمن</h2>

    <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
       href="{{ route('admin.dashboard') }}">الرئيسية</a>

    <a class="{{ request()->routeIs('admin.departments.*') ? 'active' : '' }}"
       href="{{ route('admin.departments.index') }}">الأقسام</a>

    <a class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}"
       href="{{ route('admin.books.index') }}">الكتب</a>

    <a class="{{ request()->routeIs('admin.borrows.*') ? 'active' : '' }}"
       href="{{ route('admin.borrows.index') }}">الاستعارات</a>
    

    <a class="{{ request()->routeIs('admin.curriculum.*') ? 'active' : '' }}"
      href="{{ route('admin.curriculum.index') }}">الخطة الدراسية</a>

   

    <div class="sidebar-dropdown {{ request()->routeIs(
        'admin.digital-books.*',
        'admin.curriculum.*',
        'admin.syllabuses.*',
        'admin.past-exams.*',
        'admin.projects.*',
        'admin.researches.*',
        'admin.journals.*',
        'admin.educational-channels.*'
    ) ? 'open active' : '' }}">

        <button type="button" class="sidebar-dropdown-btn">
            <span>المحتوى الرقمي</span>
            <span class="arrow">▼</span>
        </button>

        <div class="sidebar-dropdown-content">
            <a class="{{ request()->routeIs('admin.digital-books.*') ? 'active' : '' }}"
               href="{{ route('admin.digital-books.index') }}">الكتب الرقمية</a>


            <a class="{{ request()->routeIs('admin.syllabuses.*') ? 'active' : '' }}"
               href="{{ route('admin.syllabuses.index') }}">المناهج</a>

            <a class="{{ request()->routeIs('admin.past-exams.*') ? 'active' : '' }}"
               href="{{ route('admin.past-exams.index') }}">أسئلة السنوات</a>

            <a class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"
               href="{{ route('admin.projects.index') }}">مشاريع التخرج</a>

            <a class="{{ request()->routeIs('admin.researches.*') ? 'active' : '' }}"
               href="{{ route('admin.researches.index') }}">البحوث العلمية</a>

            <a class="{{ request()->routeIs('admin.journals.*') ? 'active' : '' }}"
               href="{{ route('admin.journals.index') }}">المجلات</a>

            <a class="{{ request()->routeIs('admin.educational-channels.*') ? 'active' : '' }}"
               href="{{ route('admin.educational-channels.index') }}">القنوات التعليمية</a>
        </div>
    </div>

    <a class="{{ request()->routeIs('admin.students.*') ? 'active' : '' }}"
       href="{{ route('admin.students.index') }}">
          الطلبة
    </a>
    <a class="{{ request()->routeIs('admin.admins.*') ? 'active' : '' }}"
   href="{{ route('admin.admins.index') }}">
    الأدمن
</a>
    
</aside>

    <div class="main-content">

        <div class="topbar">
            <h1>@yield('page_title', 'لوحة التحكم')</h1>
              <div class="admin-search-container">
    <input
        type="text"
        id="adminLiveSearchInput"
        placeholder="ابحث داخل لوحة الأدمن..."
        autocomplete="off"
    >

    <button type="button">🔍</button>

    <div id="adminLiveSearchResults" class="admin-live-search-results"></div>
</div>
            <div class="admin-actions">
                <div class="admin-info">
                    مرحبًا، {{ auth()->user()->name }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="admin-logout-btn">
                        تسجيل الخروج
                    </button>
                </form>
            </div>
        </div>

        <main class="content">
            @yield('content')
        </main>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdownButtons = document.querySelectorAll('.sidebar-dropdown-btn');

    dropdownButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const dropdown = button.closest('.sidebar-dropdown');
            dropdown.classList.toggle('open');
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('adminLiveSearchInput');
    const box = document.getElementById('adminLiveSearchResults');

    if (!input || !box) return;

    input.addEventListener('input', function () {
        const q = this.value.trim();

        if (q.length < 2) {
            box.innerHTML = '';
            box.style.display = 'none';
            return;
        }

        fetch(`/admin/live-search?q=${encodeURIComponent(q)}`)
            .then(res => res.json())
            .then(data => {
                box.innerHTML = data.length
                    ? data.map(item => `
                        <a href="${item.url}" class="admin-live-search-item">
                            <span>${item.title}</span>
                            <small>${item.type}</small>
                        </a>
                    `).join('')
                    : '<div class="admin-live-search-empty">لا توجد نتائج</div>';

                box.style.display = 'block';
            });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.admin-search-container')) {
            box.style.display = 'none';
        }
    });
});
</script>
</body>

</html>