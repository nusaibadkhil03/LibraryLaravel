@extends('layouts.main')

@section('content')

<div class="curriculum-page">

    <h2 class="curriculum-title">
        {{ __('messages.curriculum_and_schedules') }}
    </h2>

    <form method="GET" action="{{ route('curriculum') }}" class="department-filter">
        <select name="department_id" onchange="this.form.submit()">
            <option value="">
                {{ __('messages.select_department') }}
            </option>

            @foreach($departments as $department)
                <option value="{{ $department->id }}"
                    {{ $selectedDepartment == $department->id ? 'selected' : '' }}>
                    {{ app()->getLocale() == 'en'
                        ? ucwords(str_replace('-', ' ', $department->slug))
                        : $department->name }}
                </option>
            @endforeach
        </select>
    </form>

<div class="curriculum-tabs">        <button type="button" class="curriculum-tab-btn active" onclick="showSection('schedules', this)">
            <span>🗓️</span>
            {{ __('messages.study_schedules') }}
        </button>

        <button type="button" class="curriculum-tab-btn" onclick="showSection('plans', this)">
            <span>📘</span>
            {{ __('messages.study_plan') }}
        </button>

        <button type="button" class="curriculum-tab-btn" onclick="showSection('calendars', this)">
            <span>📆</span>
            {{ __('messages.academic_calendar') }}
        </button>

        <button type="button" class="curriculum-tab-btn" onclick="showSection('exams', this)">
            <span>📝</span>
            {{ __('messages.exam_schedules') }}
        </button>
    </div>

    <div id="schedules" class="section-box active">
        <h3 class="section-title">
            {{ __('messages.study_schedules') }}
        </h3>

        @if(!$selectedDepartment)
            <p class="empty-msg">
                {{ __('messages.select_department_for_schedules') }}
            </p>
        @elseif($schedules->count())
            <div class="grid-box">
                @foreach($schedules as $item)
                    <div class="image-card">
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ __('messages.study_schedule') }}">

                        <a class="download-btn"
                           href="{{ asset('storage/' . $item->image) }}"
                           download>
                            {{ __('messages.download_image') }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-msg">
                {{ __('messages.no_schedules_for_department') }}
            </p>
        @endif
    </div>

    <div id="plans" class="section-box">
        <h3 class="section-title">
            {{ __('messages.study_plan') }}
        </h3>

        @if(!$selectedDepartment)
            <p class="empty-msg">
                {{ __('messages.select_department_for_plan') }}
            </p>
        @elseif($plans->count())
            <div class="grid-box">
                @foreach($plans as $item)
                    <div class="image-card">
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ __('messages.study_plan') }}">

                        <a class="download-btn"
                           href="{{ asset('storage/' . $item->image) }}"
                           download>
                            {{ __('messages.download_image') }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-msg">
                {{ __('messages.no_plan_for_department') }}
            </p>
        @endif
    </div>

    <div id="calendars" class="section-box">
        <h3 class="section-title">
            {{ __('messages.academic_calendar') }}
        </h3>

        @if($calendars->count())
            <div class="grid-box">
                @foreach($calendars as $item)
                    <div class="image-card">
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ __('messages.academic_calendar') }}">

                        <a class="download-btn"
                           href="{{ asset('storage/' . $item->image) }}"
                           download>
                            {{ __('messages.download_image') }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-msg">
                {{ __('messages.no_academic_calendar') }}
            </p>
        @endif
    </div>

    <div id="exams" class="section-box">
        <h3 class="section-title">
            {{ __('messages.exam_schedules') }}
        </h3>

        @if(!$selectedDepartment)
            <p class="empty-msg">
                {{ __('messages.select_department_for_exams') }}
            </p>
        @elseif($examSchedules->count())
            <div class="grid-box">
                @foreach($examSchedules as $item)
                    <div class="image-card">
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ __('messages.exam_schedule') }}">

                        <a class="download-btn"
                           href="{{ asset('storage/' . $item->image) }}"
                           download>
                            {{ __('messages.download_schedule') }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-msg">
                {{ __('messages.no_exam_schedules_for_department') }}
            </p>
        @endif
    </div>

</div>

<script>
    function showSection(sectionId, button) {
        document.querySelectorAll('.curriculum-page .section-box').forEach(section => {
            section.classList.remove('active');
        });

        document.querySelectorAll('.curriculum-tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        document.getElementById(sectionId).classList.add('active');
        button.classList.add('active');
    }
</script>

@endsection