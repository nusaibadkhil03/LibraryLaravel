@extends('layouts.admin')

@section('content')

<h2>طلبات الاستعارة</h2>

@if(session('success'))
<div style="background:#d4edda; padding:10px; margin-bottom:10px;">
    {{ session('success') }}
</div>
@endif

<table style="width:100%; border-collapse:collapse;">
    <thead>
        <tr style="background:#eee;">
            <th>#</th>
            <th>الطالب</th>
            <th>الكتاب</th>
            <th>الحالة</th>
            <th>الإجراء</th>
        </tr>
    </thead>

    <tbody>
        @foreach($borrows as $borrow)
        <tr>
            <td>{{ $borrow->id }}</td>
            <td>{{ $borrow->user->name ?? '-' }}</td>
            <td>{{ $borrow->libraryBook->title ?? '-' }}</td>
            <td>{{ $borrow->status }}</td>

            <td style="padding:10px; display:flex; gap:8px; justify-content:center;">

               @if($borrow->status == 'pending')
                 <form method="POST" action="{{ route('admin.borrows.approve', $borrow->id) }}">
                   @csrf
                   <button type="submit"
                          style="background:green; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
                قبول
                  </button>
                 </form>

                 <form method="POST" action="{{ route('admin.borrows.reject', $borrow->id) }}">
                   @csrf
                   <button type="submit"
                    style="background:red; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
                رفض
              </button>
          </form>
      @else
         <span>-</span>
    @endif

</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection