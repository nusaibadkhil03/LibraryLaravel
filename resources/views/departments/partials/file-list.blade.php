@if($items->count())
    <div class="content-list">
        @foreach($items as $item)
            @php
                $modelClass = get_class($item);
                $file = $item->file_path ?? null;
            @endphp

            <div class="content-row"
                 data-title="{{ $item->title }}"
                 data-year="{{ $item->academic_year ?? $item->publication_year ?? $item->year ?? $item->created_at ?? 0 }}">

                <div class="content-info">

                    <strong class="content-main-title">
                        {{ $item->title }}
                    </strong>

                    <div class="content-meta">

                        @if(!empty($item->exam_year))
                            <span>{{ __('messages.exam_year') }}: {{ $item->exam_year }}</span>
                        @endif

                        @if(!empty($item->academic_year))
                            <span>{{ __('messages.academic_year') }}: {{ $item->academic_year }}</span>
                        @endif

                        @if(!empty($item->author))
                            <span>{{ __('messages.author') }}: {{ $item->author }}</span>
                        @endif

                        @if(!empty($item->lecture_number))
                            <span>{{ __('messages.lecture') }}: {{ $item->lecture_number }}</span>
                        @endif

                        @if(!empty($item->doctor_name))
                            <span>{{ __('messages.doctor') }}: {{ $item->doctor_name }}</span>
                        @endif

                        @if(!empty($item->students_names))
                            <span>{{ __('messages.students') }}: {{ $item->students_names }}</span>
                        @endif

                        @if(!empty($item->supervisor_name))
                            <span>{{ __('messages.supervisor') }}: {{ $item->supervisor_name }}</span>
                        @endif

                        @if(!empty($item->semester))
                            <span>{{ __('messages.semester') }}: {{ $item->semester }}</span>
                        @endif

                    </div>

                    @if(!empty($item->description))
                        <p class="content-description">
                            {{ \Illuminate\Support\Str::limit($item->description, 120) }}
                        </p>
                    @endif

                    <div class="content-action">

                        @if($file)

                            @if(isset($title) && str_contains($title, 'مشاريع'))

                                <a class="download-btn"
                                   href="{{ asset('storage/' . $file) }}"
                                   target="_blank">
                                   👁️ {{ __('messages.read_project') }}
                                </a>

                            @else

                                @if($modelClass === App\Models\Book::class)

                                    <a class="download-btn"
                                       href="{{ route('books.download', $item->id) }}">
                                       📥 {{ __('messages.download_file') }}
                                    </a>

                                @else

                                    <a class="download-btn"
                                       href="{{ asset('storage/' . $file) }}"
                                       target="_blank"
                                       download>
                                       📥 {{ __('messages.download_file') }}
                                    </a>

                                @endif

                            @endif

                        @else
                            <span class="no-file">{{ __('messages.no_file') }}</span>
                        @endif

                        <form method="POST"
                              action="{{ route('favorites.toggle') }}"
                              style="display:inline;">
                            @csrf

                            <input type="hidden" name="favoritable_id" value="{{ $item->id }}">
                            <input type="hidden" name="favoritable_type" value="{{ $modelClass }}">

                            <button type="submit"
                                    class="favorite-btn"
                                    title="{{ __('messages.add_to_favorites') }}">
                                ⭐
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        @endforeach
    </div>
@else
    <p class="empty-message">
        {{ $emptyMessage ?? __('messages.no_content_currently') }}
    </p>
@endif