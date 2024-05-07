<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<div class="bg-white rounded shadow-sm mb-3 pt-3">
    <div class="d-flex px-3 align-items-center">
        <legend class="text-black px-2 mt-2 mb-4">
            <div class="d-flex align-items-center">
                <h3>{{ __('Numbers') }}</h3>
            </div>
        </legend>

        <form method="GET" action="{{ route('platform.analyse') }}"> 
           
            <div class="row">
                <div class="col">
                    <input type="number" name="num1" class="form-control" value="{{ $zahlenanalyse['num1'] ?? '' }}">
                </div>
                <div class="col">
                    <input type="number" name="num2" class="form-control" value="{{ $zahlenanalyse['num2'] ?? '' }}">
                </div>
                <div class="col">
                    <input type="number" name="num3" class="form-control" value="{{ $zahlenanalyse['num3'] ?? '' }}">
                </div>
                <div class="col">
                    <input type="number" name="num4" class="form-control" value="{{ $zahlenanalyse['num4'] ?? '' }}">
                </div>
                <div class="col">
                    <input type="number" name="num5" class="form-control" value="{{ $zahlenanalyse['num5'] ?? '' }}">
                </div>
                <div class="col">
                    <input type="number" name="ext1" class="form-control analysenumbers" value="{{ $zahlenanalyse['ext1'] ?? '' }}">
                </div>
                <div class="col">
                    <input type="number" name="ext2" class="form-control analysenumbers" value="{{ $zahlenanalyse['ext2'] ?? '' }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">{{ __('Analyze') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
