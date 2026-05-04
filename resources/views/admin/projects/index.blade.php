@extends('layouts.admin')

@section('content')

<div class="section-box">

    <h2>مشاريع التخرج</h2>

    <a href="{{ route('admin.projects.create') }}" class="admin-logout-btn">
        إضافة مشروع
    </a>

    @if(session('success'))
        <div style="background:#d4edda; padding:10px; margin:10px 0; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    @if($projects->count())
        <table style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المشروع</th>
                    <th>القسم</th>
                    <th>الطلبة</th>
                    <th>المشرف</th>
                    <th>الفصل</th>
                    <th>الملف</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->department->name ?? '-' }}</td>
                        <td>{{ $item->students_names }}</td>
                        <td>{{ $item->supervisor_name }}</td>
                        <td>{{ $item->semester }}</td>

                        <td>
                            @if($item->file_path)
                                <a href="{{ asset('storage/'.$item->file_path) }}" target="_blank">
                                    عرض
                                </a>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('admin.projects.destroy', $item->id) }}"
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
        <p>لا توجد مشاريع حالياً</p>
    @endif

</div>

@endsection