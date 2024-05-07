<div class="bg-white rounded shadow-sm pt-3 mb-3">
    <div class="px-3 pb-1">
                @if (count($viererkombinationen) > 0)
                    @foreach ($viererkombinationen as $treffer)
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-success mb-3 text-center" role="alert">
                                    <strong>{{ \Carbon\Carbon::parse($treffer['draw_date'])->format('d.m.Y') }}</strong>
                                    <br>
                                    <div class="d-flex justify-content-center align-items-center border-bottom">
                                        @foreach ($treffer['numbers'] as $number)
                                            <span class="mx-3 fs-3 {{ in_array($number, $treffer['matched_numbers']) ? 'text-primary' : '' }}">{{ $number }}</span>
                                        @endforeach
                                        @foreach ($treffer['zusatzzahlen'] as $zusatz)
                                            <span class="fs-5  mx-2 text-secondary">{{ $zusatz }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="/portal/analyse?num1={{ $treffer['numbers'][0] }}&num2={{ $treffer['numbers'][1] }}&num3={{ $treffer['numbers'][2] }}&num4={{ $treffer['numbers'][3] }}&num5={{ $treffer['numbers'][4] }}&ext1={{ $treffer['zusatzzahlen'][0] }}&ext2={{ $treffer['zusatzzahlen'][1] }}" >
                                    <strong>{{ __('Analyze numbers') }}</strong> 
                                </a><br>
                                <a href="/portal/analyse?num1={{ $treffer['numbers'][0] }}&num2={{ $treffer['numbers'][1] }}&num3={{ $treffer['numbers'][2] }}&num4={{ $treffer['numbers'][3] }}&num5={{ $treffer['numbers'][4] }}&ext1={{ $treffer['zusatzzahlen'][0] }}&ext2={{ $treffer['zusatzzahlen'][1] }}" >
                                    <strong>{{ __('Add to "my numbers"') }}</strong> 
                                </a><br>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning text-center" role="alert">
                        Kein Treffer gefunden.
                    </div>
                @endif
    </div>
</div>
