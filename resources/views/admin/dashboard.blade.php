@extends('layouts.admin')

@section('page_title', 'الرئيسية')

@section('content')

<div class="cards">

    <div class="card">
        <h3>طلبات قيد الانتظار</h3>
        <p>{{ $pendingBorrowsCount ?? 0 }}</p>
    </div>

    <div class="card">
        <h3>إجمالي طلبات الاستعارة</h3>
        <p>{{ $totalBorrowsCount ?? 0 }}</p>
    </div>

    <div class="card">
        <h3>طلبات مقبولة / مستعارة</h3>
        <p>{{ $approvedBorrowsCount ?? 0 }}</p>
    </div>

    <div class="card">
        <h3>طلبات تم إرجاعها</h3>
        <p>{{ $returnedBorrowsCount ?? 0 }}</p>
    </div>

    <div class="card">
        <h3>عدد الطلبة</h3>
        <p>{{ $studentsCount ?? 0 }}</p>
    </div>

    <div class="card">
        <h3>عدد العناوين </h3>
        <p>{{ $booksCount ?? 0 }}</p>
    </div>

    <div class="card">
        <h3>عدد الكتب</h3>
        <p>{{ $availableBooksCount ?? 0 }}</p>
    </div>

    <div class="card">
        <h3>عدد الأقسام</h3>
        <p>{{ $departmentsCount ?? 0 }}</p>
    </div>

</div>

<div class="section-box">
    <h2>آخر طلبات الاستعارة</h2>

    @if(isset($latestBorrows) && $latestBorrows->count())
        <table>
            <thead>
                <tr>
                    <th>الطالب</th>
                    <th>الكتاب</th>
                    <th>الحالة</th>
                </tr>
            </thead>

            <tbody>
                @foreach($latestBorrows as $borrow)
                    <tr>
                        <td>{{ $borrow->user->name ?? $borrow->student_name ?? '-' }}</td>
                        <td>{{ $borrow->libraryBook->title ?? '-' }}</td>
                        <td>
                            @if($borrow->status == 'pending')
                                قيد الانتظار
                            @elseif($borrow->status == 'approved')
                                مقبول
                            @elseif($borrow->status == 'borrowed')
                                مستعار
                            @elseif($borrow->status == 'returned')
                                تم الإرجاع
                            @elseif($borrow->status == 'rejected')
                                مرفوض
                            @else
                                {{ $borrow->status }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>لا توجد طلبات استعارة حالياً.</p>
    @endif
</div>

<div class="section-box">
    <h2>آخر الكتب المضافة</h2>

    @if(isset($latestBooks) && $latestBooks->count())
        <table>
            <thead>
                <tr>
                    <th>اسم الكتاب</th>
                    <th>القسم</th>
                    <th>النسخ الكلية</th>
                    <th>النسخ المتاحة</th>
                </tr>
            </thead>

            <tbody>
                @foreach($latestBooks as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->department->name ?? '-' }}</td>
                        <td>{{ $book->total_copies ?? 0 }}</td>
                        <td>{{ $book->available_copies ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>لا توجد كتب مضافة حالياً.</p>
    @endif
</div>

@endsection