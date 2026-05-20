@extends('layouts.main')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-center">📚 المجلات العلمية</h2>

    <div class="row">

        @foreach($journals as $journal)
            <div class="col-md-4 mb-4">

                <div class="journal-card">

                    <div class="journal-header">
                        <h5 class="journal-title">{{ $journal->title }}</h5>
                    </div>

                    <div class="journal-body">

                        <div class="journal-info">
                            <span>🔢 الإصدار:</span>
                            <strong>{{ $journal->edition ?? 'غير محدد' }}</strong>
                        </div>

                        <div class="journal-info">
                            <span>📅 السنة:</span>
                            <strong>{{ $journal->publication_year }}</strong>
                        </div>

                    </div>

                    <div class="journal-footer">

                        <a href="{{ asset('storage/' . $journal->file_path) }}"
                           target="_blank"
                           class="btn-view">
                            📖 فتح
                        </a>

                        <a href="{{ asset('storage/' . $journal->file_path) }}"
                           download
                           class="btn-download">
                            ⬇ تحميل
                        </a>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

</div>

<style>
.journal-card {
    background: #fff;
    border-radius: 16px;
    padding: 18px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.journal-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.journal-title {
    font-size: 18px;
    font-weight: bold;
    color: #e67e22;
    margin-bottom: 10px;
}

.journal-body {
    margin: 10px 0;
}

.journal-info {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    margin-bottom: 6px;
    color: #444;
}

.journal-footer {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
    gap: 10px;
}

.btn-view {
    flex: 1;
    text-align: center;
    padding: 8px;
    background: #3498db;
    color: #fff;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.2s;
}

.btn-view:hover {
    background: #2980b9;
}

.btn-download {
    flex: 1;
    text-align: center;
    padding: 8px;
    background: #2ecc71;
    color: #fff;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.2s;
}

.btn-download:hover {
    background: #27ae60;
}
</style>
@endsection