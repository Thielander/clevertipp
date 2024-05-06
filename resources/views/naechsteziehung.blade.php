<div class="bg-white rounded shadow-sm mb-3 pt-3">
    <div class="d-flex px-3 align-items-center">
        <legend class="text-black px-2 mt-2">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <h3>{{ __('Next chance to win on') }} {{ $naechsteziehung }}</h3>
                <h4 class="text-center ">{{ __('Jackpot: ') }} {{ number_format($lottodaten['erwarteteGewinnsummen']['jackpot'], 2, ',', '.') }}€</h4>
                <p class="text-center mt-2">
                {{ __('All information and analyses presented are based exclusively on EuroMillions data.')}}
            </p>
            </div>
           
        </legend>
    </div>
</div>
