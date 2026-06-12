@extends('layouts.admin')

@section('content')

<h2>طلبات الاستعارة</h2>

@if(session('success'))
    <div style="background:#d4edda; padding:10px; margin-bottom:10px; border-radius:8px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background:#f8d7da; padding:10px; margin-bottom:10px; border-radius:8px;">
        {{ session('error') }}
    </div>
@endif

<form method="GET" action="{{ route('admin.borrows.index') }}" style="
    background:#fff;
    padding:18px;
    border-radius:16px;
    margin:20px 0;
    box-shadow:0 4px 14px rgba(0,0,0,0.06);
">

    <div style="
        display:grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap:12px;
        align-items:end;
    ">

        <div>
            <label>بحث</label>
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="اسم الطالب، رقم القيد، الهاتف، الكتاب"
                   style="width:100%;">
        </div>

        <div>
            <label>الحالة</label>
            <select name="status" style="width:100%;">
                <option value="">كل الحالات</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>مستعار</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>مقبول</option>
                <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>تم الإرجاع</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>مرفوض</option>
            </select>
        </div>

        <div>
            <label>تاريخ الاستعارة</label>
            <input type="date"
                   name="borrow_date"
                   value="{{ request('borrow_date') }}"
                   style="width:100%;">
        </div>

        <div>
            <label>تاريخ الإرجاع المتوقع</label>
            <input type="date"
                   name="due_date"
                   value="{{ request('due_date') }}"
                   style="width:100%;">
        </div>

        <div>
            <label>الترتيب</label>
            <select name="sort" style="width:100%;">
                <option value="">الأحدث</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>الأقدم</option>
                <option value="student" {{ request('sort') == 'student' ? 'selected' : '' }}>اسم الطالب</option>
                <option value="borrow_date" {{ request('sort') == 'borrow_date' ? 'selected' : '' }}>تاريخ الاستعارة</option>
                <option value="due_date" {{ request('sort') == 'due_date' ? 'selected' : '' }}>تاريخ الإرجاع</option>
            </select>
        </div>

        <div style="display:flex; gap:8px;">
            <button type="submit" style="
                background:#e67e22;
                color:white;
                border:none;
                padding:11px 20px;
                border-radius:10px;
                cursor:pointer;
                font-weight:bold;
            ">
                تطبيق
            </button>

            <a href="{{ route('admin.borrows.index') }}" style="
                background:#6c757d;
                color:white;
                text-decoration:none;
                padding:11px 20px;
                border-radius:10px;
                font-weight:bold;
            ">
                إعادة ضبط
            </a>
        </div>

    </div>
</form>

<table style="width:100%; border-collapse:collapse;">
    <thead>
        <tr style="background:#eee;">
            <th>#</th>
            <th>اسم الطالب</th>
            <th>رقم القيد</th>
            <th>القسم</th>
            <th>رقم الهاتف</th>
            <th>الكتاب</th>
            <th>تاريخ الاستعارة</th>
            <th>تاريخ الإرجاع المتوقع</th>
            <th>الحالة</th>
            <th>الإجراء</th>
        </tr>
    </thead>

    <tbody>
        @forelse($borrows as $borrow)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $borrow->student_name ?? $borrow->user->name ?? '-' }}</td>

                <td>{{ $borrow->user->student_number ?? $borrow->student_number ?? '-' }}</td>

                <td>{{ $borrow->user->department->name ?? '-' }}</td>

                <td>{{ $borrow->user->phone ?? '-' }}</td>

                <td>{{ $borrow->libraryBook->title ?? '-' }}</td>

                <td>{{ $borrow->borrow_date ?? '-' }}</td>

                <td>{{ $borrow->due_date ?? '-' }}</td>

                <td>
                    @if($borrow->status == 'pending')
                        قيد الانتظار
                    @elseif($borrow->status == 'borrowed')
                        مستعار
                    @elseif($borrow->status == 'returned')
                        تم الإرجاع
                    @elseif($borrow->status == 'rejected')
                        مرفوض
                    @elseif($borrow->status == 'approved')
                        مقبول
                    @else
                        {{ $borrow->status }}
                    @endif
                </td>

                <td style="padding:10px; display:flex; gap:8px; justify-content:center;">
                    @if($borrow->status == 'pending')

                        <form method="POST" action="{{ route('admin.borrows.approve', $borrow->id) }}">
                            @csrf
                            <button type="submit" style="background:green; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
                                قبول
                            </button>
                        </form>

<form method="POST" action="{{ route('admin.borrows.reject', $borrow->id) }}" style="display:flex; gap:6px;">    @csrf

    <input type="text"
           name="rejection_reason"
           placeholder="سبب الرفض"
           required
           style="padding:8px; border-radius:8px; border:1px solid #ddd; width:130px;">

    <button type="submit" style="background:red; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
        رفض
    </button>
</form>

                    @elseif($borrow->status == 'borrowed' || $borrow->status == 'approved')

                        <a href="{{ route('admin.borrows.returnForm', $borrow->id) }}"
   style="background:#007bff; color:white; padding:8px 14px; border-radius:8px; text-decoration:none;">
    إرجاع
</a>

                    @else
                        <span>-</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" style="text-align:center; padding:20px;">
                    لا توجد طلبات استعارة حالياً
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection