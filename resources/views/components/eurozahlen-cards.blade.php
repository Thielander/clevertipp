@if(isset($eurozahlen) && $eurozahlen->count() > 0)
<p>{{ __('Use the buttons to filter Lotto Euro numbers before and after the increase to 12 numbers on March 25, 2022, to discover specific trends and statistics.') }}</p>
    <div class="row">
        <h2>{{ __('Single Numbers') }}</h2>
        <p>{{ __('How often was a supplementary numbers drawn?') }}</p>

        @foreach($eurozahlen as $eintrag)
            <div class="col-lg-3 col-xl-2 mb-4">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-lg fw-bold">  
                                    {{ __('Number') }}: {{ $eintrag->number }}<br>
                                    {{ __('Count') }}: {{ $eintrag->anzahl }}<br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
    
@if(isset($eurozahlenCombination) && $eurozahlenCombination->count() > 0)
    <h2>{{ __('Combinations') }}</h2>
    <p>{{ __('Frequency of drawn combinations') }}</p>
    <div class="row">
        @foreach($eurozahlenCombination as $eintrag)
            <div class="col-lg-3 col-xl-2 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-lg fw-bold">  
                                    {{ __('Combination') }}:<br>
                                    {{ $eintrag->first_num }} - {{ $eintrag->second_num }}<br>
                                    {{ __('Count') }}: {{ $eintrag->anzahl }}<br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning">{{ __('No data available') }}</div>
@endif
