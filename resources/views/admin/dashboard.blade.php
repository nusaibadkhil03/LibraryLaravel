@extends('layouts.admin')

@section('page_title', 'الرئيسية')

@section('content')
    <div class="cards">
        <div class="card">
            <h3>طلبات الاستعارة</h3>
            <p>{{ $borrowRequestsCount ?? 0 }}</p>
        </div>

        <div class="card">
            <h3>عدد الطلبة</h3>
            <p>{{ $studentsCount ?? 0 }}</p>
        </div>

        <div class="card">
            <h3>عدد الكتب</h3>
            <p>{{ $booksCount ?? 0 }}</p>
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
                            <td>{{ $borrow->user->name ?? '-' }}</td>
                            <td>{{ $borrow->book->title ?? '-' }}</td>
                            <td>{{ $borrow->status }}</td>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestBooks as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->department->name ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>لا توجد كتب مضافة حالياً.</p>
        @endif
    </div>
@endsection