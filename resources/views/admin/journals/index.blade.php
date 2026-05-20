@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>إدارة المجلات</h2>

    <a href="{{ route('admin.journals.create') }}" class="btn btn-primary mb-3">
        ➕ إضافة مجلة
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>السنة</th>
                <th>الناشر</th>
                <th>الملف</th>
                <th>الإجراءات</th>
            </tr>
        </thead>

        <tbody>
            @foreach($journals as $journal)
                <tr>
                    <td>{{ $journal->title }}</td>
                    <td>{{ $journal->publication_year }}</td>
                    <td>{{ $journal->publisher }}</td>

                    <td>
                        <a href="{{ asset('storage/' . $journal->file_path) }}" target="_blank">
                            فتح
                        </a>
                        |
                        <a href="{{ asset('storage/' . $journal->file_path) }}" download>
                            تحميل
                        </a>
                    </td>

                    <td>
                        <form action="{{ route('admin.journals.destroy', $journal->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection