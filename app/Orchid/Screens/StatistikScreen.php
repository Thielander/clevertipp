<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Illuminate\Http\Request;
use App\Models\Statistik;

class StatistikScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {

        $statisticAllNumbers = Statistik::statisticAllNumbers();
        $statisticAllEuroNumbers = Statistik::statisticAllEuroNumbers();
        $statisticSeitWannNichtMehrGezogen = Statistik::statisticSeitWannNichtMehrGezogen();
        $statisticSeitWannNichtMehrGezogenEurozahl = Statistik::statisticSeitWannNichtMehrGezogenEurozahl();

        return [
            'statisticAllNumbers' => $statisticAllNumbers,
            'statisticAllEuroNumbers' => $statisticAllEuroNumbers,
            'statisticSeitWannNichtMehrGezogen' => $statisticSeitWannNichtMehrGezogen,
            'statisticSeitWannNichtMehrGezogenEurozahl' => $statisticSeitWannNichtMehrGezogenEurozahl
        ];
    }
    

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Statistics');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('How often was a number drawn?');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

  
    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
                Layout::view('components.statistik'),
        ];
    }
}
