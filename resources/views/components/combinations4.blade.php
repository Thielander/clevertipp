@if(isset($combinations4) && count($combinations4) > 0)
<p>{{ __('There are 230300 different combinations of 4. These are the 42 most common.') }}</p>
    <div class="row">
        @foreach($combinations4 as $item)
            <div class="col-lg-3 col-xl-2 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-lg fw-bold font-monospace">  
                                    {{ __('Combination') }}:<br>
                                    {{ $item['combination'][0] }} {{ $item['combination'][1] }} {{ $item['combination'][2] }} {{ $item['combination'][3] }}<br>
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
