@extends('layouts.admin')

@section('content')

<div class="section-box">

    <h2>إضافة مستخدم جديد</h2>

    @if ($errors->any())
        <div style="
            background:#f8d7da;
            color:#721c24;
            padding:12px;
            border-radius:10px;
            margin-bottom:15px;
        ">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
            gap:15px;
        ">

            <div>
                <label>الاسم</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       style="width:100%;">
            </div>

            <div>
                <label>البريد الإلكتروني</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       style="width:100%;">
            </div>

            <div>
                <label>كلمة المرور</label>
                <input type="password"
                       name="password"
                       required
                       style="width:100%;">
            </div>

            <div>
                <label>تأكيد كلمة المرور</label>
                <input type="password"
                       name="password_confirmation"
                       required
                       style="width:100%;">
            </div>

            <div>
                <label>رقم القيد</label>
                <input type="text"
                       name="student_number"
                       value="{{ old('student_number') }}"
                       style="width:100%;">
            </div>

            <div>
                <label>رقم الهاتف</label>
                <input type="text"
                       name="phone"
                       value="{{ old('phone') }}"
                       style="width:100%;">
            </div>

            <div>
                <label>الدور</label>

                <select name="role" required style="width:100%;">
                    <option value="student">طالب</option>
                    <option value="staff">عضو هيئة تدريس</option>
                    <option value="admin">أدمن</option>
                </select>
            </div>

        </div>

        <div style="margin-top:20px;">
            <button type="submit"
                    style="
                        background:#e67e22;
                        color:white;
                        border:none;
                        padding:12px 25px;
                        border-radius:10px;
                        cursor:pointer;
                        font-weight:bold;
                    ">
                حفظ المستخدم
            </button>

            <a href="{{ route('admin.admins.index') }}"
               style="
                    background:#6c757d;
                    color:white;
                    text-decoration:none;
                    padding:12px 25px;
                    border-radius:10px;
                    margin-right:10px;
               ">
                رجوع
            </a>
        </div>

    </form>

</div>

@endsection