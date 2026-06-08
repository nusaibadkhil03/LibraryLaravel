@extends('layouts.borrow_layout')

@section('title', __('messages.borrow_book'))

@section('content')

<div class="borrow-container">

    <div class="tabs" id="main-tabs">
        <button type="button" class="tab-btn active" onclick="showTab('request-form-container', this)">
            {{ __('messages.borrow_request') }}
        </button>

        <button type="button" class="tab-btn" onclick="showTab('status-view', this)">
            {{ __('messages.request_status') }}
        </button>
    </div>

    <div id="request-form-container" class="form-section active">

        <h2>{{ __('messages.submit_borrow_request') }}</h2>

        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
                {{ __('messages.select_valid_book') }}
            </div>
        @endif

        <form method="POST" action="{{ route('borrow.store') }}">
            @csrf

            <div class="form-grid">
                <div class="input-box">
                    <label>{{ __('messages.student_name') }} *</label>
                    <input type="text" name="student_name" placeholder="{{ __('messages.full_name') }}" required>
                </div>

                <div class="input-box">
                    <label>{{ __('messages.student_number') }} *</label>
                    <input type="text" name="student_id" placeholder="{{ __('messages.student_number_example') }}" required>
                </div>
            </div>

            <div class="form-grid">
                <div class="input-box">
                    <label>{{ __('messages.department') }}</label>
                    <input type="text"
                           value="{{ app()->getLocale() == 'en'
                                ? ucwords(str_replace('-', ' ', auth()->user()->department->slug ?? '-'))
                                : (auth()->user()->department->name ?? '-') }}"
                           readonly>
                </div>

                <div class="input-box">
                    <label>{{ __('messages.phone_number') }}</label>
                    <input type="text"
                           name="phone"
                           value="{{ auth()->user()->phone ?? '' }}">
                </div>
            </div>

            <div class="input-box">
                <label>{{ __('messages.book_name') }} *</label>

                <input
                    list="booksList"
                    id="bookSearch"
                    placeholder="{{ __('messages.type_book_name') }}"
                    autocomplete="off"
                    required
                    style="padding:10px; width:100%;"
                >

                <datalist id="booksList">
                    @foreach($books as $book)
                        <option data-id="{{ $book->id }}" value="{{ $book->title }}"></option>
                    @endforeach
                </datalist>

                <input type="hidden" name="book_id" id="book_id">
            </div>

            <div class="form-grid">
                <div class="input-box">
                    <label>{{ __('messages.author_name') }}</label>
                    <input type="text" name="author">
                </div>

                <div class="input-box">
                    <label>{{ __('messages.edition_number') }}</label>
                    <input type="text" name="edition">
                </div>
            </div>

            <div class="form-grid">
                <div class="input-box">
                    <label>{{ __('messages.borrow_date') }}</label>
                    <input type="date" id="borrow_date">
                </div>

                <div class="input-box">
                    <label>{{ __('messages.expected_return_date') }}</label>
                    <input type="text" id="return_date_display" readonly>
                </div>
            </div>

            <div style="
                background:#fff8e1;
                color:#7a5a00;
                border:1px solid #ffe08a;
                padding:10px 14px;
                border-radius:12px;
                margin:15px 0;
                font-size:14px;
                display:flex;
                align-items:center;
                gap:8px;
            ">
                <span style="font-size:18px;">⚠️</span>
                <span>
                    <strong>{{ __('messages.warning') }}:</strong>
                    {{ __('messages.late_return_warning') }}
                </span>
            </div>

            <div class="borrow-actions">
                <button type="submit" class="borrow-submit-btn">
                    {{ __('messages.send_request') }}
                </button>

                <a href="{{ url('/') }}" class="borrow-back-btn">
                    {{ __('messages.back_home') }}
                </a>
            </div>
        </form>
    </div>

    <div id="status-view" class="form-section" style="display:none;">
        <h2>{{ __('messages.track_request_status') }}</h2>

        @if(isset($borrows) && $borrows->count())
            @foreach($borrows as $borrow)

                <div style="
                    background:#fff;
                    padding:15px;
                    margin-bottom:10px;
                    border-radius:10px;
                    box-shadow:0 2px 8px rgba(0,0,0,0.1);
                ">

                    <p style="font-weight:bold;">
                        📘 {{ $borrow->libraryBook->title ?? '-' }}
                    </p>

                    @if($borrow->status == 'pending')
                        <span style="color:#e67e22; font-weight:bold;">
                            ⏳ {{ __('messages.pending_review') }}
                        </span>

                    @elseif($borrow->status == 'approved' || $borrow->status == 'borrowed')
                        <span style="color:green; font-weight:bold;">
                            ✅ {{ __('messages.approved') }}
                        </span>

                        @if($borrow->due_date)
                            <p style="margin-top:8px;">
                                {{ __('messages.expected_return_date') }}: {{ $borrow->due_date }}
                            </p>
                        @endif

                    @elseif($borrow->status == 'returned')
                        <span style="color:#007bff; font-weight:bold;">
                            📗 {{ __('messages.returned') }}
                        </span>

                    @elseif($borrow->status == 'rejected')
                        <span style="color:red; font-weight:bold;">
                            ❌ {{ __('messages.rejected') }}
                        </span>
                    @endif

                </div>

            @endforeach
        @else
            <p>{{ __('messages.no_requests') }}</p>
        @endif

    </div>

</div>

@endsection

@section('scripts')
<script>
function showTab(sectionId, button) {
    document.querySelectorAll('.form-section').forEach(section => {
        section.style.display = 'none';
        section.classList.remove('active');
    });

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });

    const section = document.getElementById(sectionId);
    if (section) {
        section.style.display = 'block';
        section.classList.add('active');
    }

    button.classList.add('active');
}

document.addEventListener("DOMContentLoaded", function () {
    const bookSearch = document.getElementById('bookSearch');
    const bookIdInput = document.getElementById('book_id');
    const options = document.querySelectorAll('#booksList option');

    if (bookSearch && bookIdInput) {
        bookSearch.addEventListener('input', function () {
            bookIdInput.value = '';

            options.forEach(option => {
                if (option.value === bookSearch.value) {
                    bookIdInput.value = option.dataset.id;
                }
            });
        });
    }

    const input = document.getElementById("borrow_date");
    const output = document.getElementById("return_date_display");

    if (!input || !output) return;

    input.addEventListener("input", function () {
        if (!input.value) return;

        let borrowDate = new Date(input.value);
        borrowDate.setDate(borrowDate.getDate() + 5);

        const year = borrowDate.getFullYear();
        const month = String(borrowDate.getMonth() + 1).padStart(2, '0');
        const day = String(borrowDate.getDate()).padStart(2, '0');

        output.value = `${year}-${month}-${day}`;
    });
});
</script>
@endsection
