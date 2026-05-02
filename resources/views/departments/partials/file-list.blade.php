<h3 class="content-title">{{ $title }}</h3>

@if($items->count())
    <div class="content-list">
        @foreach($items as $item)
            <div class="content-row">
                <div class="content-info">
                    <strong>{{ $item->title }}</strong>

                    <p>
                        @if(!empty($item->author))
                            المؤلف: {{ $item->author }} |
                        @endif

                        @if(!empty($item->academic_year))
                            السنة: {{ $item->academic_year }} |
                        @endif

                        @if(!empty($item->semester))
                            الفصل الدراسي: {{ $item->semester }}
                        @endif
                    </p>

                    @if(!empty($item->description))
                        <p>{{ $item->description }}</p>
                    @endif
                </div>

                <div class="content-action">
                    @php
                        $file = $item->file_path ?? null;
                    @endphp

                    @if($file)
                        <a class="download-btn"
                           href="{{ asset('storage/' . $file) }}"
                           target="_blank">
                            تحميل PDF
                        </a>
                    @else
                        <span class="no-file">لا يوجد ملف PDF</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="empty-message">{{ $emptyMessage ?? 'لا يوجد محتوى حالياً.' }}</p>
@endif