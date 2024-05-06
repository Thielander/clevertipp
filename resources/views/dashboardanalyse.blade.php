<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">




<div class="bg-white rounded shadow-sm mb-3 pt-3">
    <div class="d-flex px-3 align-items-center">
        <legend class="text-black px-2 mt-2 mb-4">
            <div class="d-flex align-items-center">
                <h3>{{ __('Pattern analysis')}} </h3>
            </div>

            <p class="small text-muted mb-3 content-read text-balance">
                @if ($zahlencheck)
                    {{ __('A pattern has been recognized in the current figures.') }}
                @else
                    {{ __('No pattern was detected in the current figures.') }}
                @endif
            </p>


            <div class="clevertipp-group">
                @for($i = 1; $i <= 50; $i++)
                    @if(in_array($i, [
                        $letzterEintragZahlenUndEinsatz->num1,
                        $letzterEintragZahlenUndEinsatz->num2,
                        $letzterEintragZahlenUndEinsatz->num3,
                        $letzterEintragZahlenUndEinsatz->num4,
                        $letzterEintragZahlenUndEinsatz->num5,
                    ]))
                        <div class="clevertipp-muster clevertipp-cross" style="width: 10%;"><span class="clevertipp-value">{{ $i }}</span></div>
                    @else
                        <div class="clevertipp-muster" style="width: 10%;"><span class="clevertipp-value">{{ $i }}</span></div>
                    @endif
                @endfor
            </div>
        </legend>
    </div>
</div>

<div class="bg-white rounded shadow-sm mb-3 pt-3">
    <div class="d-flex px-3 align-items-center">
        <legend class="text-black px-2 mt-2 mb-3">
            <div class="d-flex align-items-center">
                <h3>{{ __('Statistics')}}</h3>
            </div>

            <p class="small text-muted mb-0 content-read text-balance">
                Das Diagramm zeigt den Prozentsatz, wie oft jede Gewinnklasse ausgezahlt wurde, wobei die Gewinnklasse 1 angibt, wie häufig der Jackpot geknackt wurde.
            </p>
        </legend>
    </div>
</div>

<div class="bg-white rounded shadow-sm mb-3 pt-3">
    <div class="d-flex px-3 align-items-center">
        <legend class="text-black px-2 mt-2 mb-0">
            <div class="d-flex align-items-center">
                <h3>{{ __('Cross-sum')}} </h3>
            </div>

            <p class="small text-muted mb-3 content-read text-balance">
                hier die quersummen anzeigen
            </p>
        </legend>
    </div>
</div>