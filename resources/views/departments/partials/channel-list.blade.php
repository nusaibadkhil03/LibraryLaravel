<h3 class="content-title">{{ $title }}</h3>

@if($channels->count())
    <div class="content-list">
        @foreach($channels as $channel)
            <div class="content-row">
                <div class="content-info">
                    <strong>{{ $channel->title }}</strong>

                    <p>
                        @if($channel->platform)
                            {{ __('messages.platform') }}: {{ $channel->platform }}
                        @endif
                    </p>

                    @if($channel->description)
                        <p>{{ $channel->description }}</p>
                    @endif
                </div>

                <div class="content-action">
                    <form method="POST"
                          action="{{ route('favorites.toggle') }}"
                          style="display:inline;">
                        @csrf

                        <input type="hidden" name="favoritable_id" value="{{ $channel->id }}">
                        <input type="hidden" name="favoritable_type" value="{{ App\Models\EducationalChannel::class }}">

                        <button type="submit"
                                class="favorite-btn"
                                title="{{ __('messages.add_to_favorites') }}">
                            ⭐
                        </button>
                    </form>

                    <a class="download-btn"
                       href="{{ $channel->channel_url }}"
                       target="_blank">
                        {{ __('messages.open_channel') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="empty-message">{{ $emptyMessage }}</p>
@endif