@extends('layouts.admin')

@section('content')

<div class="admin-table-page">

    <div class="admin-table-header">

        <h2>إدارة الأدمن</h2>

        <div style="display:flex; gap:10px; align-items:center;">

            

            <form method="GET" class="admin-filter-form">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="بحث بالاسم أو البريد أو رقم القيد">

                <button type="submit" class="admin-add-btn">
                    بحث
                </button>
            </form>

        </div>

    </div>
     <div style="margin-bottom:20px;">
    <a href="{{ route('admin.users.create') }}"
   style="
        background:#e67e22;
        color:white;
        text-decoration:none;
        padding:8px 14px;
        border-radius:8px;
        font-size:13px;
        font-weight:600;
        display:inline-block;
        margin-top:10px;
   ">
    + إضافة مستخدم
</a>
</div>
    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    {{-- الأدمن الحاليون --}}
    <div class="admin-table-card">

        <h3 style="margin-bottom:20px;color:#e67e22;">
            الأدمن
        </h3>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الدور الحالي</th>
                    <th>الإجراء</th>
                </tr>
            </thead>

            <tbody>

                @forelse($admins as $user)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>
                            <span class="status-active">
                                Admin
                            </span>
                        </td>

                        <td style="display:flex; gap:8px; justify-content:center;">

                            <form method="POST"
                                  action="{{ route('admin.admins.updateRole', [$user->id,'student']) }}"
                                  onsubmit="return confirm('هل أنت متأكد من إزالة صلاحية الأدمن؟')">

                                @csrf
                                @method('PATCH')

                                <button class="btn-warning"
                                        {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                    إزالة الأدمن
                                </button>

                            </form>

                            @if($user->id !== auth()->id())
                                <form method="POST"
                                      action="{{ route('admin.users.destroy', $user->id) }}"
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">

                                    @csrf
                                    @method('DELETE')

                                    <button style="
                                        background:red;
                                        color:white;
                                        border:none;
                                        padding:8px 14px;
                                        border-radius:8px;
                                        cursor:pointer;">
                                        حذف
                                    </button>

                                </form>
                            @endif

                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="empty-table">
                            لا يوجد أدمن حالياً
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>

    </div>

    <br><br>

    {{-- البحث عن مستخدم لإضافته كأدمن --}}
    <div class="admin-table-card">

        <h3 style="margin-bottom:20px;color:#e67e22;">
            البحث عن مستخدم لإضافته كأدمن
        </h3>

        <form method="GET" class="admin-filter-form" style="margin-bottom:20px;">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="بحث بالاسم أو البريد أو رقم القيد">

            <button type="submit" class="admin-add-btn">
                بحث
            </button>

            @if(request('search'))
                <a href="{{ route('admin.admins.index') }}"
                   class="btn-warning"
                   style="text-decoration:none; display:inline-block;">
                    إعادة ضبط
                </a>
            @endif
        </form>

        @if(request('search'))

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم القيد / الرقم الوظيفي</th>
                        <th>الدور الحالي</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($searchResults as $user)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>{{ $user->student_number ?? '-' }}</td>

                            <td>
                                @if($user->role == 'staff')
                                    <span class="status-active">
                                        Staff
                                    </span>
                                @elseif($user->role == 'student')
                                    <span class="status-inactive">
                                        Student
                                    </span>
                                @else
                                    <span class="status-inactive">
                                        {{ $user->role }}
                                    </span>
                                @endif
                            </td>

                            <td style="display:flex; gap:8px; justify-content:center;">

                                <form method="POST"
                                      action="{{ route('admin.admins.updateRole', [$user->id,'admin']) }}"
                                      onsubmit="return confirm('هل تريد جعل هذا المستخدم أدمن؟')">

                                    @csrf
                                    @method('PATCH')

                                    <button class="btn-active">
                                        جعل أدمن
                                    </button>

                                </form>

                                <form method="POST"
                                      action="{{ route('admin.users.destroy', $user->id) }}"
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">

                                    @csrf
                                    @method('DELETE')

                                    <button style="
                                        background:red;
                                        color:white;
                                        border:none;
                                        padding:8px 14px;
                                        border-radius:8px;
                                        cursor:pointer;">
                                        حذف
                                    </button>

                                </form>

                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="empty-table">
                                لا توجد نتائج مطابقة
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>

        @else

            <div class="empty-table">
                ابحث عن مستخدم بالاسم أو البريد أو رقم القيد لإضافته كأدمن.
            </div>

        @endif

    </div>

    <br><br>

    {{-- آخر النشاطات --}}
    <div class="admin-table-card">

        <h3 style="margin-bottom:20px;color:#e67e22;">
            آخر النشاطات للأدمن
        </h3>

        @forelse($activities as $activity)

            <div style="
                padding:12px;
                border-bottom:1px solid #eee;
                display:flex;
                justify-content:space-between;
                align-items:center;
            ">

                <div>
                    <strong>
                        {{ $activity->admin->name ?? 'غير معروف' }}
                    </strong>

                    <br>

                    {{ $activity->description }}
                </div>

                <small style="color:#888;">
                    {{ $activity->created_at->diffForHumans() }}
                </small>

            </div>

        @empty

            <div class="empty-table">
                لا توجد نشاطات حتى الآن
            </div>

        @endforelse

    </div>

</div>

@endsection