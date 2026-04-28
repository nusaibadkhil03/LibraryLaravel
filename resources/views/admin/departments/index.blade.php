@extends('layouts.admin')

@section('page_title', 'إدارة الأقسام')

@section('content')
<div class="section-box">

    <h2>إدارة الأقسام</h2>

    <!-- الفورم -->
    <form method="POST" action="{{ route('admin.departments.store') }}" style="margin:20px 0;">
        @csrf

        <input type="text" name="name" placeholder="اسم القسم" required
               style="padding:10px; margin:5px;">

        <input type="text" name="description" placeholder="وصف القسم"
               style="padding:10px; margin:5px;">

        <button type="submit" class="admin-logout-btn">إضافة قسم</button>
    </form>
    @if(session('success'))
    <div id="success-message"
         style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
        {{ session('success') }}
    </div>
@endif


    <!-- الجدول -->
    @if($departments->count())
        <table style="width:100%; margin-top:20px; border-collapse: collapse;">
            <thead>
                <tr style="background:#eee;">
                    <th style="padding:10px;">#</th>
                    <th style="padding:10px;">اسم القسم</th>
                    <th style="padding:10px;">الوصف</th>
                    <th style="padding:10px;">الإجراء</th>
                </tr>
            </thead>

            <tbody>
                @foreach($departments as $department)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $department->id }}</td>
                        <td style="padding:10px;">{{ $department->name }}</td>
                       
                        <td style="padding:10px;">{{ $department->description ?? '-' }}</td>
                    <td>
  

    <!-- زر حذف -->
    <form method="POST"
          action="{{ route('admin.departments.delete', $department->id) }}"
          onsubmit="return confirm('هل أنت متأكد من حذف هذا القسم؟ سيتم حذفه نهائيًا.');">
        @csrf
        @method('DELETE')

        <button type="submit"
                style="background:#dc3545; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;">
            حذف
        </button>
    </form>

</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="margin-top:20px;">لا توجد أقسام حالياً.</p>
    @endif

</div>

<script>
    setTimeout(function () {
        let msg = document.getElementById('success-message');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 3000);
</script>
@endsection