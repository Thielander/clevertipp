<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<div class="bg-white rounded shadow-sm pt-3 mb-3">
    <div class="px-3 pb-1">
        <div class="row">
            <div class="col">
                @if ($muster['found'])
                    <strong>{{ __('A pattern has been recognized in the current figures.') }} {{ implode(', ', $muster['found_patterns']) }}</strong>
                @else
                    <strong>{{ __('No pattern was detected in the current figures.') }}</strong>
                @endif
                <p class="small text-muted mb-3 content-read text-balance"></p>
            </div>
            <div class="col">
                <div class="clevertipp-group">
                    @for ($i = 1; $i <= 50; $i++)
                        <div class="clevertipp-muster {{ in_array($i, array_slice($muster['numbers'], 0, 5)) ? 'clevertipp-cross' : '' }}" style="width: 10%;">
                            <span class="clevertipp-value">{{ $i }}</span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
