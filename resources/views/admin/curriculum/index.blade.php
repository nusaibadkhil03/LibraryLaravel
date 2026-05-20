@extends('layouts.admin')

@section('content')

<h2>إدارة الخطة الدراسية</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('admin.curriculum.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <select name="type" id="type" required>
        <option value="schedule">الجداول الدراسية</option>
        <option value="plan">الخطة الدراسية</option>
        <option value="calendar">التقويم الأكاديمي</option>
        <option value="exam">جدول الامتحانات</option>
    </select>

    <select name="department_id" id="department_id">
        <option value="">اختر القسم</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
    </select>

    <input type="file" name="image" required>

    <button type="submit">رفع</button>
</form>

<hr>

<h3>الجداول الدراسية</h3>
@foreach($schedules as $item)
    <div>
        <img src="{{ asset('storage/'.$item->image) }}" width="120">
        <p>القسم: {{ $item->department->name ?? 'غير محدد' }}</p>

        <form method="POST" action="{{ route('admin.curriculum.destroy', $item->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">حذف</button>
        </form>
    </div>
@endforeach

<h3>الخطة الدراسية</h3>
@foreach($plans as $item)
    <div>
        <img src="{{ asset('storage/'.$item->image) }}" width="120">
        <p>القسم: {{ $item->department->name ?? 'غير محدد' }}</p>

        <form method="POST" action="{{ route('admin.curriculum.destroy', $item->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">حذف</button>
        </form>
    </div>
@endforeach

<h3>التقويم الأكاديمي</h3>
@foreach($calendars as $item)
    <div>
        <img src="{{ asset('storage/'.$item->image) }}" width="120">

        <form method="POST" action="{{ route('admin.curriculum.destroy', $item->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">حذف</button>
        </form>
    </div>

    
@endforeach

<h3>جداول الامتحانات</h3>

@foreach($examSchedules as $item)
    <div>
        <img src="{{ asset('storage/'.$item->image) }}" width="120">

        <p>
            القسم:
            {{ $item->department->name ?? 'غير محدد' }}
        </p>

        <form method="POST"
              action="{{ route('admin.curriculum.destroy', $item->id) }}">
            @csrf
            @method('DELETE')

            <button type="submit">حذف</button>
        </form>
    </div>
@endforeach

<script>
    const typeSelect = document.getElementById('type');
    const departmentSelect = document.getElementById('department_id');

    function toggleDepartment() {
        if (typeSelect.value === 'calendar') {
            departmentSelect.value = '';
            departmentSelect.disabled = true;
        } else {
            departmentSelect.disabled = false;
        }
    }

    typeSelect.addEventListener('change', toggleDepartment);
    toggleDepartment();
</script>

@endsection