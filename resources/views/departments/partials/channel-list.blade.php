<h3 class="content-title">{{ $title }}</h3>

@if($channels->count())
    <div class="content-list">
        @foreach($channels as $channel)
            <div class="content-row">
                <div class="content-info">
                    <strong>{{ $channel->title }}</strong>

                    <p>
                        @if($channel->platform)
                            المنصة: {{ $channel->platform }}
                        @endif
                    </p>

                    @if($channel->description)
                        <p>{{ $channel->description }}</p>
                    @endif
                </div>

                <div class="content-action">
                    <a class="download-btn"
                       href="{{ $channel->channel_url }}"
                       target="_blank">
                        فتح القناة
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="empty-message">{{ $emptyMessage }}</p>
@endif