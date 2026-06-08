@extends('layouts.main')

@section('content')

<style>

    .journals-full-page{
    margin-top:0 !important;
    padding-top:40px !important;
}

.journals-full-page{
    margin-bottom:0 !important;
    padding-bottom:0 !important;
}
.journals-full-page {
    width: 100vw;
    min-height: 100vh;
    margin-right: calc(50% - 50vw);
    margin-left: calc(50% - 50vw);
    padding: 55px 25px 80px;

    background:
        linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.65)),
        url("{{ asset('images/journals-bg.jpeg') }}");

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.journals-full-container {
    width: 100%;
    max-width: 1050px;
    margin: 0 auto;
}

.journals-full-header {
    text-align: center;
    color: white;
    margin-bottom: 35px;
}

.journals-full-header h1 {
    font-size: 42px;
    font-weight: 900;
    margin-bottom: 12px;
}

.journals-full-header p {
    font-size: 16px;
    margin: 0;
}

.journals-full-divider {
    width: 45px;
    height: 4px;
    background: #f97316;
    border-radius: 20px;
    margin: 18px auto 0;
}

.journals-full-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 260px));
    justify-content: center;
    gap: 22px;
}

.journals-full-card {
    background: rgba(255,255,255,.96);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 18px 45px rgba(0,0,0,.25);
    min-height: 445px;
    display: flex;
    flex-direction: column;
}

.journals-full-cover {
    height: 170px;
    background:
        linear-gradient(rgba(0,0,0,.35), rgba(0,0,0,.45)),
        url("{{ asset('images/journals-bg.jpeg') }}");
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 22px;
}

.journals-full-cover h3 {
    color: white;
    font-size: 22px;
    margin: 0;
    text-align: center;
    padding: 0 14px;
}

.journals-full-body {
    padding: 20px;
    text-align: center;
    color: #1f2937;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.journals-full-meta {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 7px;
    margin-bottom: 14px;
}

.journals-full-meta span {
    background: #fff7ed;
    color: #ea580c;
    border: 1px solid #fed7aa;
    padding: 5px 10px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 800;
}

.journals-full-publisher {
    font-size: 14px;
    color: #374151;
    margin-bottom: 10px;
}

.journals-full-description {
    color: #6b7280;
    font-size: 13px;
    line-height: 1.7;
    margin: 0 0 18px;
    flex: 1;
}

.journals-full-actions {
    display: flex;
    gap: 10px;
    margin-top: auto;
}

.journals-full-btn {
    flex: 1;
    padding: 10px 8px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 800;
    font-size: 13px;
}

.journals-full-read {
    background: #f97316;
    color: white !important;
}

.journals-full-download {
    background: #fff;
    color: #1f2937 !important;
    border: 1px solid #ddd;
}

.journals-full-empty {
    background: rgba(255,255,255,.96);
    border-radius: 22px;
    padding: 40px;
    text-align: center;
    color: #6b7280;
}

@media (max-width: 768px) {
    .journals-full-page {
        padding: 45px 15px 60px;
        background-attachment: scroll;
    }

    .journals-full-header h1 {
        font-size: 32px;
    }

    .journals-full-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="journals-full-page">

    <div class="journals-full-container">

        <div class="journals-full-header">
            <h1>المجلات العلمية</h1>
            <p>
                تصفح المجلات والإصدارات العلمية الخاصة بالجامعة، مع إمكانية قراءة الملفات مباشرة أو تحميلها بصيغة PDF.
            </p>
            <div class="journals-full-divider"></div>
        </div>

        @if($journals->count())

            <div class="journals-full-grid">

                @foreach($journals as $journal)

                    <div class="journals-full-card">

                        <div class="journals-full-cover">
                            <h3>{{ $journal->title }}</h3>
                        </div>

                        <div class="journals-full-body">

                            <div class="journals-full-meta">
                                @if($journal->issue_number)
                                    <span>العدد {{ $journal->issue_number }}</span>
                                @endif

                                @if($journal->publication_year)
                                    <span>{{ $journal->publication_year }}</span>
                                @endif

                                @if($journal->publication_date)
                                    <span>{{ $journal->publication_date }}</span>
                                @endif
                            </div>

                            @if($journal->publisher)
                                <div class="journals-full-publisher">
                                    الناشر: {{ $journal->publisher }}
                                </div>
                            @endif

                            <p class="journals-full-description">
                                {{ $journal->description ? Str::limit($journal->description, 90) : 'لا يوجد وصف مضاف لهذه المجلة.' }}
                            </p>

                            <div class="journals-full-actions">

    <form method="POST"
          action="{{ route('favorites.toggle') }}"
          style="display:inline;">
        @csrf

        <input type="hidden"
               name="favoritable_id"
               value="{{ $journal->id }}">

        <input type="hidden"
               name="favoritable_type"
               value="{{ App\Models\Journal::class }}">

        <button type="submit"
                style="
                    border:none;
                    background:#fff7ed;
                    padding:10px 14px;
                    border-radius:12px;
                    cursor:pointer;
                    font-size:18px;
                ">
            ⭐
        </button>
    </form>

    <a href="{{ asset('storage/' . $journal->file_path) }}"
       target="_blank"
       class="journals-full-btn journals-full-read">
        قراءة
    </a>

    <a href="{{ asset('storage/' . $journal->file_path) }}"
       download
       class="journals-full-btn journals-full-download">
        تحميل PDF
    </a>

</div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else
            <div class="journals-full-empty">
                لا توجد مجلات متاحة حاليًا.
            </div>
        @endif

    </div>

</div>

@endsection