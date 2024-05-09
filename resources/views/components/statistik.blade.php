<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


<div class="bg-white rounded shadow-sm mb-3 py-3">
    <div class="px-3 ">
        <div class="row">
            <div class="col-12 text-center  mb-3">
                <p class="fs-3">{{ __('Statistics of all figures') }}</p>
                <p>{{ __('This statistic shows how often the numbers were drawn in a draw.') }}</p>
            </div>
            @foreach ($statisticAllNumbers as $statistic)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
                    <span class="clevertipp-zahlen">
                        <b>{{ $statistic['zahl'] }}</b> {{ $statistic['anzahl'] }}x
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="bg-white rounded shadow-sm mb-3 py-3">
    <div class="px-3 ">
        <div class="row">
            <div class="col-12 text-center fs-3 mb-3">{{ __('Statistics of all euro figures')}}</div>
            @foreach ($statisticAllEuroNumbers as $statistic)
                <div class="col-6 col-sm-4 col-md-4 col-lg-2">
                    <span class="clevertipp-zahlen">
                        <b class="clevertipp-item">{{ $statistic['zahl'] }}</b> {{ $statistic['anzahl'] }}x
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="bg-white rounded shadow-sm mb-3 py-3">
    <div class="px-3 ">
        <div class="row">
            <div class="col-12 text-center mb-3">
                <p class="fs-3">{{ __('Winning numbers')}}</p>
                <p>{{ __('How many draws have you not drawn?')}}</p>
            </div>
            @foreach ($statisticSeitWannNichtMehrGezogen as $statistic)
                <div class="col-6 text-center mb-4">
                    <b>{{ $statistic['zahl'] }}</b>
                    <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="{{ $statistic['prozent'] }}" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <div class="progress-bar bg-info text-dark" style="width: {{ $statistic['prozent'] }}%">
                            {{ $statistic['ziehungen_seit_letzter'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="bg-white rounded shadow-sm mb-3 py-3">
    <div class="px-3 ">
        <div class="row">
            <div class="col-12 text-center mb-3">
                <p class="fs-3">{{ __('Supplementary numbers')}}</p>
                <p">{{ __('How many draws have you not drawn?')}}</p>
            </div>
            @foreach ($statisticSeitWannNichtMehrGezogenEurozahl as $statistic)
                <div class="col-6 text-center mb-4">
                    <b>{{ $statistic['zahl'] }}</b>
                    <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="{{ $statistic['prozent'] }}" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <div class="progress-bar bg-info text-dark" style="width: {{ $statistic['prozent'] }}%">
                            {{ $statistic['ziehungen_seit_letzter'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
