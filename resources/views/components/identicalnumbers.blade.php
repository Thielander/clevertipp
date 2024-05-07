<div class="bg-white rounded shadow-sm  pt-3 mb-3">
    <div class="px-3 pb-1">
        @php
            $treffer = [];
            foreach ($alleAbstaende as $ziehung) {
                if ($ziehung['zahlen'] === $abstaendeZahlen['zahlen']) {
                    $treffer[] = $ziehung;
                }
            }
        @endphp

        @if (count($treffer) > 0)
            @foreach ($treffer as $ziehung)
                <div class="row">
                    <div class="col">
                        <div class="alert alert-success mb-3 text-center" role="alert">
                            <strong>{{ \Carbon\Carbon::parse($ziehung['date'])->format('d.m.Y') }}</strong>
                            <br>
                            <div class="d-flex justify-content-center align-items-center border-bottom">
                                @foreach ($ziehung['zahlen'] as $index => $zahl)
                                    <span class="fs-3 mx-2">{{ $zahl }}</span>
                                @endforeach
                                @foreach ($ziehung['zusatzzahlen'] as $index => $zahl)
                                    <span class="fs-5 mx-2">{{ $zahl }}</span>
                                @endforeach
                        </div>
                </div>
                    </div>
                    <div class="col">
                        <a href="/portal/analyse?num1={{ $ziehung['zahlen'][0] }}&num2={{ $ziehung['zahlen'][1] }}&num3={{ $ziehung['zahlen'][2] }}&num4={{ $ziehung['zahlen'][3] }}&num5={{ $ziehung['zahlen'][4] }}&ext1={{ $ziehung['zusatzzahlen'][0] }}&ext2={{ $ziehung['zusatzzahlen'][1] }}" >
                            <strong>{{ __('Analyze numbers') }}</strong> 
                        </a><br>
                        <a href="/portal/analyse?num1={{ $ziehung['zahlen'][0] }}&num2={{ $ziehung['zahlen'][1] }}&num3={{ $ziehung['zahlen'][2] }}&num4={{ $ziehung['zahlen'][3] }}&num5={{ $ziehung['zahlen'][4] }}&ext1={{ $ziehung['zusatzzahlen'][0] }}&ext2={{ $ziehung['zusatzzahlen'][1] }}" >
                            <strong>{{ __('Add to "my numbers"') }}</strong> 
                        </a>
                    </div>
                </div>

                
            @endforeach
        @else
            <div class="alert alert-warning text-center" role="alert">
                Diese Kombination wurde noch nie gezogen.
            </div>
        @endif
    </div>
</div>
