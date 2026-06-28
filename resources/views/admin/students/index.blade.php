@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <div class="admin-page-header">

        <h2>إدارة الطلبة</h2>

        <form method="GET"
              action="{{ route('admin.students.index') }}"
              class="admin-filter-form">

            <input type="text"
                   name="search"
                   placeholder="بحث باسم الطالب أو البريد..."
                   value="{{ request('search') }}">

            <select name="department_id">
                <option value="">كل الأقسام</option>

                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ request('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>

            <select name="status">
                <option value="">كل الحالات</option>

                <option value="active"
                    {{ request('status') == 'active' ? 'selected' : '' }}>
                    نشط
                </option>

                

                <option value="suspended"
                    {{ request('status') == 'suspended' ? 'selected' : '' }}>
                    موقوف
                </option>
            </select>

            <button type="submit" class="admin-save-btn">
                بحث
            </button>

        </form>

    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-table-card">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>القسم</th>
                    <th>الحالة</th>
                    <th>إدارة الحساب</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>

                @forelse($students as $student)

                    <tr>

                        <td>{{ $student->id }}</td>

                        <td>{{ $student->name }}</td>

                        <td>{{ $student->email }}</td>

                        <td>
                            {{ $student->department->name ?? '-' }}
                        </td>

                        <td>

                            @if($student->status == 'active')
                                <span class="status-active">
                                    نشط
                                </span>

                            

                            @else
                                <span class="status-suspended">
                                    موقوف
                                </span>
                            @endif

                        </td>

                        <td>

                            <div class="student-actions">

                                <form method="POST"
                                      action="{{ route('admin.students.updateStatus', [$student->id,'active']) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button class="btn-active">
                                        تفعيل
                                    </button>
                                </form>

                         

                                <form method="POST"
                                      action="{{ route('admin.students.updateStatus', [$student->id,'suspended']) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button class="btn-danger">
                                        إيقاف
                                    </button>
                                </form>

                            </div>

                        </td>

                        <td>

                            <form method="POST"
                                  action="{{ route('admin.students.destroy',$student->id) }}"
                                  onsubmit="return confirm('هل أنت متأكد من حذف الطالب؟')">

                                @csrf
                                @method('DELETE')

                                <button class="btn-danger">
                                    حذف
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7">
                            لا يوجد طلبة حالياً
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection