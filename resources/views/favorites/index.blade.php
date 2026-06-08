<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.favorites') }}</title>

    <style>
        body {
            margin: 0;
            font-family: Tahoma, Arial, sans-serif;
            background: #f6f7fb;
            color: #222;
        }

        .favorites-header {
            background: #f97316;
            color: white;
            padding: 22px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .favorites-header h2 {
            margin: 0;
            font-size: 26px;
        }

        .favorites-header a {
            background: white;
            color: #f97316;
            text-decoration: none;
            padding: 9px 18px;
            border-radius: 20px;
            font-weight: bold;
        }

        .favorites-container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .favorite-card {
            background: white;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 8px 22px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
        }

        .favorite-info h3 {
            margin: 0 0 10px;
            color: #222;
        }

        .favorite-info p {
            margin: 5px 0;
            color: #666;
            line-height: 1.7;
        }

        .favorite-type {
            display: inline-block;
            background: #fff3e8;
            color: #f97316;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .favorite-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .favorite-actions a,
        .favorite-actions button {
            border: none;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
        }

        .open-btn {
            background: #f97316;
            color: white;
        }

        .remove-btn {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty-box {
            background: white;
            text-align: center;
            padding: 60px;
            border-radius: 18px;
            color: #777;
        }

        @media (max-width: 700px) {
            .favorites-header {
                padding: 18px 20px;
            }

            .favorite-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .favorite-actions {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="favorites-header">
    <h2>⭐ {{ __('messages.favorites') }}</h2>
    <a href="{{ url('/') }}">{{ __('messages.home') }}</a>
</div>

<div class="favorites-container">

    @forelse($favorites as $favorite)
        @php
            $item = $favorite->favoritable;
            $type = class_basename($favorite->favoritable_type);
        @endphp

        @if($item)
            <div class="favorite-card">

                <div class="favorite-info">
                    <span class="favorite-type">
                        @if($type == 'Journal')
                            {{ __('messages.scientific_journal') }}
                        @elseif($type == 'LibraryBook')
                            {{ __('messages.book') }}
                        @elseif($type == 'Curriculum')
                            {{ __('messages.curriculum_plan') }}
                        @elseif($type == 'PastExam')
                            {{ __('messages.past_exams') }}
                        @elseif($type == 'EducationalChannel')
                            {{ __('messages.educational_channel') }}
                        @else
                            {{ __('messages.digital_content') }}
                        @endif
                    </span>

                    <h3>{{ $item->title ?? $item->name ?? __('messages.untitled_item') }}</h3>

                    @if(isset($item->issue_number))
                        <p>{{ __('messages.issue_number') }}: {{ $item->issue_number }}</p>
                    @endif

                    @if(isset($item->publication_year))
                        <p>{{ __('messages.publication_year') }}: {{ $item->publication_year }}</p>
                    @endif

                    @if(isset($item->description))
                        <p>{{ $item->description }}</p>
                    @endif
                </div>

                <div class="favorite-actions">

                    @if(isset($item->file_path))
                        <a class="open-btn" href="{{ asset('storage/' . $item->file_path) }}" target="_blank">
                            {{ __('messages.open_file') }}
                        </a>
                    @elseif(isset($item->file))
                        <a class="open-btn" href="{{ asset('storage/' . $item->file) }}" target="_blank">
                            {{ __('messages.open_file') }}
                        </a>
                    @elseif(isset($item->channel_url))
                        <a class="open-btn" href="{{ $item->channel_url }}" target="_blank">
                            {{ __('messages.open_link') }}
                        </a>
                    @endif

                    <form method="POST" action="{{ route('favorites.toggle') }}">
                        @csrf
                        <input type="hidden" name="favoritable_id" value="{{ $favorite->favoritable_id }}">
                        <input type="hidden" name="favoritable_type" value="{{ $favorite->favoritable_type }}">

                        <button type="submit" class="remove-btn">
                            {{ __('messages.remove') }}
                        </button>
                    </form>

                </div>

            </div>
        @endif
    @empty
        <div class="empty-box">
            {{ __('messages.no_favorites') }}
        </div>
    @endforelse

</div>

</body>
</html>