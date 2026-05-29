@extends('layouts.admin')

@section('content')

<div class="admin-table-page">

    <div class="admin-table-header">
        <h2>إدارة الأدمن</h2>

        <form method="GET" class="admin-filter-form">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="بحث بالاسم أو البريد">

            <button type="submit" class="admin-add-btn">
                بحث
            </button>
        </form>
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

    <div class="admin-table-card">

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

                @forelse($users as $user)

                    <tr>

                        <td>{{ $user->id }}</td>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>
                            @if($user->role == 'admin')
                                <span class="status-active">
                                    Admin
                                </span>
                            @else
                                <span class="status-inactive">
                                    Student
                                </span>
                            @endif
                        </td>

                        <td>

                            @if($user->role == 'admin')

                                <form method="POST"
                                      action="{{ route('admin.admins.updateRole', [$user->id,'student']) }}">

                                    @csrf
                                    @method('PATCH')

                                    <button class="btn-warning">
                                        إزالة الأدمن
                                    </button>

                                </form>

                            @else

                                <form method="POST"
                                      action="{{ route('admin.admins.updateRole', [$user->id,'admin']) }}">

                                    @csrf
                                    @method('PATCH')

                                    <button class="btn-active">
                                        جعل أدمن
                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="empty-table">
                            لا يوجد مستخدمون
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <br><br>

    <div class="admin-table-card">

        <h3 style="margin-bottom:20px;color:#e67e22;">
            آخر  النشاطات للأدمن
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