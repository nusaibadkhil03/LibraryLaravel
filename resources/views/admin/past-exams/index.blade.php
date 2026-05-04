@extends('layouts.admin')

@section('content')

<div class="section-box">

    <h2>أسئلة السنوات</h2>

    <a href="{{ route('admin.past-exams.create') }}" class="admin-logout-btn">
        إضافة جديد
    </a>

    @if(session('success'))
        <div style="background:#d4edda; padding:10px; margin:10px 0; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    @if($pastExams->count())
        <table style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>القسم</th>
                    <th>السنة</th>
                    <th>الفصل</th>
                    <th>الدكتور</th>
                    <th>الملف</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pastExams as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->department->name ?? '-' }}</td>
                        <td>{{ $item->academic_year }}</td>
                        <td>{{ $item->semester }}</td>
                        <td>{{ $item->doctor_name }}</td>

                        <td>
                            <a href="{{ asset('storage/'.$item->file_path) }}" target="_blank">
                                عرض
                            </a>
                        </td>

                        <td>
                            <form action="{{ route('admin.past-exams.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟')">

                                @csrf
                                @method('DELETE')

                                <button style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px;">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>لا توجد بيانات</p>
    @endif

</div>

@endsection