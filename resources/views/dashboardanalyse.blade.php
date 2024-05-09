<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<div class="bg-white rounded shadow-sm mb-3 pt-3">
    <div class="d-flex px-3 align-items-center">
        <legend class="text-black px-2 mt-2 mb-4">
            <div class="d-flex align-items-center">
                <h3>{{ __('Pattern analysis')}} </h3>
            </div>

            <p class="small text-muted mb-3 content-read text-balance">
                @if ($zahlencheck['found'])
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
                <h3>{{ __('Statistics') }}</h3>
            </div>
            <p class="small text-muted mb-4 content-read text-balance">
                {{ __('This statistic shows how often the numbers were drawn in a draw.') }}
            </p>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    @foreach ($statistik as $item)
                        @if(isset($item['zusatzzahl']))
                            <th class="text-primary"><b>{{ $item['zusatzzahl'] }}</b></th> 
                        @else
                            <th><b>{{ $item['zahl'] }}</b></th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($statistik as $item)
                        @if(isset($item['zusatzzahl']))
                            <td class="text-primary">{{ $item['anzahl'] }}x</td> 
                        @else
                            <td>{{ $item['anzahl'] }}x</td>
                        @endif
                    @endforeach
                </tr>
            </tbody>
        </table>
        </legend>
    </div>
</div>




