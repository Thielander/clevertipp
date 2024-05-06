@if(isset($combinations5) && count($combinations5) > 0)
    @php
        $allCountsAreOne = true;
        foreach ($combinations5 as $item) {
            if ($item['count'] > 1) {
                $allCountsAreOne = false;
                break;
            }
        }
    @endphp
    
<p>{{ __('There are 2118760 different combinations of 5. These are the 42 most common.') }}</p>
    @if($allCountsAreOne)
        <p>{{ __('All combinations occur only once.') }}</p>
    @endif
    <div class="row">
        @foreach($combinations5 as $item)
            <div class="col-lg-3 col-xl-2 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-lg fw-bold font-monospace">  
                                    {{ __('Combination') }}:<br>
                                    {{ $item['combination'][0] }}-{{ $item['combination'][1] }}-{{ $item['combination'][2] }}-{{ $item['combination'][3] }}-{{ $item['combination'][4] }}<br>
                                    {{ __('Count') }}: {{ $item['count'] }}<br>
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
