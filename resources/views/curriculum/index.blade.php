@extends('layouts.main')

@section('content')

<div class="curriculum-page">

    <h2 class="curriculum-title">الخطة الدراسية والجداول</h2>

    <form method="GET" action="{{ route('curriculum') }}" class="department-filter">
        <select name="department_id" onchange="this.form.submit()">
            <option value="">اختر القسم</option>

            @foreach($departments as $department)
                <option value="{{ $department->id }}"
                    {{ $selectedDepartment == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </form>

    <div class="tabs">
        <button type="button" class="tab-btn active" onclick="showSection('schedules', this)">
            <span>🗓️</span>
            الجداول الدراسية
        </button>

        <button type="button" class="tab-btn" onclick="showSection('plans', this)">
            <span>📘</span>
            الخطة الدراسية
        </button>

        <button type="button" class="tab-btn" onclick="showSection('calendars', this)">
            <span>📆</span>
            التقويم الأكاديمي
        </button>
        <button type="button" class="tab-btn" onclick="showSection('exams', this)">
            <span>📝</span>
             جدول الامتحانات
            </button>
    </div>

    <div id="schedules" class="section-box active">
        <h3 class="section-title">الجداول الدراسية</h3>

        @if(!$selectedDepartment)
            <p class="empty-msg">يرجى اختيار القسم لعرض الجداول الدراسية.</p>
        @elseif($schedules->count())
            <div class="grid-box">
                @foreach($schedules as $item)
                    <div class="image-card">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="جدول دراسي">
                        <a class="download-btn" href="{{ asset('storage/' . $item->image) }}" download>
                            تحميل الصورة
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-msg">لا توجد جداول دراسية لهذا القسم حالياً.</p>
        @endif
    </div>

    <div id="plans" class="section-box">
        <h3 class="section-title">الخطة الدراسية</h3>

        @if(!$selectedDepartment)
            <p class="empty-msg">يرجى اختيار القسم لعرض الخطة الدراسية.</p>
        @elseif($plans->count())
            <div class="grid-box">
                @foreach($plans as $item)
                    <div class="image-card">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="خطة دراسية">
                        <a class="download-btn" href="{{ asset('storage/' . $item->image) }}" download>
                            تحميل الصورة
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-msg">لا توجد خطة دراسية لهذا القسم حالياً.</p>
        @endif
    </div>

    <div id="calendars" class="section-box">
        <h3 class="section-title">التقويم الأكاديمي</h3>

        @if($calendars->count())
            <div class="grid-box">
                @foreach($calendars as $item)
                    <div class="image-card">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="التقويم الأكاديمي">
                        <a class="download-btn" href="{{ asset('storage/' . $item->image) }}" download>
                            تحميل الصورة
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-msg">لا يوجد تقويم أكاديمي حالياً.</p>
        @endif
    </div>
    <div id="exams" class="section-box">
    <h3 class="section-title">جداول الامتحانات</h3>

    @if(!$selectedDepartment)
        <p class="empty-msg">يرجى اختيار القسم لعرض جداول الامتحانات.</p>

    @elseif($examSchedules->count())
        <div class="grid-box">
            @foreach($examSchedules as $item)
                <div class="image-card">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="جدول امتحانات">

                    <a class="download-btn"
                       href="{{ asset('storage/' . $item->image) }}"
                       download>
                        تحميل الجدول
                    </a>
                </div>
            @endforeach
        </div>

    @else
        <p class="empty-msg">لا توجد جداول امتحانات لهذا القسم حالياً.</p>
    @endif
</div>

</div>

<script>
    function showSection(sectionId, button) {
        document.querySelectorAll('.section-box').forEach(section => {
            section.classList.remove('active');
        });

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        document.getElementById(sectionId).classList.add('active');
        button.classList.add('active');
    }
</script>

@endsection