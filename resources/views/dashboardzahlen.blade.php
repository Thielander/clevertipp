<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<div class="bg-white rounded shadow-sm mb-3 pt-3">
    <div class="d-flex px-3 align-items-center">
        <legend class="text-black px-2 mt-2 mb-0">
            <div class="d-flex align-items-center">
                <h3>{{ __('EuroJackpot draw from')}} {{ \Carbon\Carbon::parse($letzterEintragZahlenUndEinsatz->draw_date)->format('d.m.Y') }}</h3>
            </div>
        </legend>
    </div>
    <div class="clevertipp-wrapper">
        <div class="clevertipp-left">
            <span class="clevertipp-zahlen">
                <b class="clevertipp-item">{{ $letzterEintragZahlenUndEinsatz->num1 }}</b>
                <b class="clevertipp-item">{{ $letzterEintragZahlenUndEinsatz->num2 }}</b>
                <b class="clevertipp-item">{{ $letzterEintragZahlenUndEinsatz->num3 }}</b>
                <b class="clevertipp-item">{{ $letzterEintragZahlenUndEinsatz->num4 }}</b>
                <b class="clevertipp-item">{{ $letzterEintragZahlenUndEinsatz->num5 }}</b>
                <span class="clevertipp-zahlen-gap"></span>
                <b class="clevertipp-superzahl">{{ $letzterEintragZahlenUndEinsatz->num6 }}</b>
                <b class="clevertipp-superzahl">{{ $letzterEintragZahlenUndEinsatz->num7 }}</b>
            </span>
        </div>  
        <div class="clevertipp-right">
            <div>
                <span class="clevertipp-zusatz">
                    <div style="width: 75px; margin-right: 20px;"><b>Spieleinsatz:</b></div>
                    <span>{{ number_format($letzterEintragZahlenUndEinsatz->spieleinsatz, 2, ',', '.') }} €</span>
                </span>
                <!-- Wenn es eine Eigenschaft jackpot gibt, dann diese auch ausgeben -->
                @if (property_exists($letzterEintragZahlenUndEinsatz, 'jackpot'))
                <span class="clevertipp-zusatz">
                    <div style="width: 75px; margin-right: 20px;"><b>Jackpot:</b></div>
                    <span>{{ number_format($letzterEintragZahlenUndEinsatz->jackpot, 2, ',', '.') }} €</span>
                </span>
                @endif
                <br>
                <a href="/portal/analyse?num1={{ $letzterEintragZahlenUndEinsatz->num1 }}&num2={{ $letzterEintragZahlenUndEinsatz->num2 }}&num3={{ $letzterEintragZahlenUndEinsatz->num3 }}&num4={{ $letzterEintragZahlenUndEinsatz->num4 }}&num5={{ $letzterEintragZahlenUndEinsatz->num5 }}&ext1={{ $letzterEintragZahlenUndEinsatz->num6 }}&ext2={{ $letzterEintragZahlenUndEinsatz->num7 }}" class="btn btn-info" >
                    <strong>{{ __('Analyze numbers') }}</strong> 
                </a>
            </div>
        </div>
    </div>
</div>

