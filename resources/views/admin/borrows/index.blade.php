app/Http/Controllers/Admin/AdminBorrowController.php
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
            <th>العدد الكلي</th>
            <th>النسخ المتاحة</th>
            <th>النسخ المستعارة</th>
            <th>الحالة</th>
            <th>الإجراء</th>
        </tr>
    </thead>

    <tbody>
        @forelse($borrows as $borrow)
            <tr>
                <td>{{ $borrow->id }}</td>

                <td>{{ $borrow->student_name ?? $borrow->user->name ?? '-' }}</td>

                <td>{{ $borrow->user->student_number ?? $borrow->student_number ?? '-' }}</td>

                <td>{{ $borrow->user->department->name ?? '-' }}</td>

                <td>{{ $borrow->user->phone ?? '-' }}</td>

                <td>{{ $borrow->libraryBook->title ?? '-' }}</td>

                <td>{{ $borrow->borrow_date ?? '-' }}</td>

                <td>{{ $borrow->due_date ?? '-' }}</td>

                <td>{{ $borrow->libraryBook->total_copies ?? '-' }}</td>

                <td>{{ $borrow->libraryBook->available_copies ?? '-' }}</td>

                <td>
                    {{
                        ($borrow->libraryBook->total_copies ?? 0)
                        -
                        ($borrow->libraryBook->available_copies ?? 0)
                    }}
                </td>

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

                        <form method="POST" action="{{ route('admin.borrows.reject', $borrow->id) }}">
                            @csrf
                            <button type="submit" style="background:red; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
                                رفض
                            </button>
                        </form>

                    @elseif($borrow->status == 'borrowed' || $borrow->status == 'approved')

                        <form method="POST" action="{{ route('admin.borrows.return', $borrow->id) }}">
                            @csrf
                            <button type="submit" style="background:#007bff; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
                                إرجاع
                            </button>
                        </form>

                    @else
                        <span>-</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="13" style="text-align:center; padding:20px;">
                    لا توجد طلبات استعارة حالياً
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection