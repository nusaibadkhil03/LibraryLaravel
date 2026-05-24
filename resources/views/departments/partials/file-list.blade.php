@if($items->count())
    <div class="content-list">
        @foreach($items as $item)
            <div class="content-row"
                 data-title="{{ $item->title }}"
                 data-year="{{ $item->academic_year ?? $item->publication_year ?? $item->year ?? $item->created_at ?? 0 }}">

                <div class="content-info">
                    <strong>{{ $item->title }}</strong>

                    <p>
                        @if(!empty($item->author))
                            المؤلف: {{ $item->author }} |
                        @endif

                        @if(!empty($item->academic_year))
                            السنة: {{ $item->academic_year }} |
                        @endif

                        @if(!empty($item->doctor_name))
                            الدكتور: {{ $item->doctor_name }} |
                        @endif

                        @if(!empty($item->students_names))
                            الطلبة: {{ $item->students_names }} |
                        @endif

                        @if(!empty($item->supervisor_name))
                            المشرف: {{ $item->supervisor_name }} |
                        @endif

                        @if(!empty($item->semester))
                            الفصل الدراسي: {{ $item->semester }}
                        @endif
                    </p>

                    @if(!empty($item->description))
                        <p>{{ \Illuminate\Support\Str::limit($item->description, 120) }}</p>
                    @endif
                </div>

                <div class="content-action">
                    @php
                        $file = $item->file_path ?? null;
                    @endphp

                    @if($file)

    @if(isset($title) && str_contains($title, 'مشاريع'))

        <a class="download-btn"
           href="{{ asset('storage/' . $file) }}"
           target="_blank">
           👁️ قراءة المشروع
        </a>

    @else

        <a class="download-btn"
           href="{{ asset('storage/' . $file) }}"
           target="_blank"
           download>
           📥 تحميل الملف
        </a>

    @endif

@else
    <span class="no-file">لا يوجد ملف</span>
@endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="empty-message">{{ $emptyMessage ?? 'لا يوجد محتوى حالياً.' }}</p>
@endif