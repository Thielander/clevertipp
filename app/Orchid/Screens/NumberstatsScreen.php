<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use App\Models\Lotto;
use Orchid\Support\Facades\Toast;
use App\Orchid\Layouts\EurozahlenCardLayout;

class NumberstatsScreen extends Screen
{
    public $title;
    public $description;

    public function __construct()
    {
        $this->title = __('All data');
        $this->description = __('On this page you will find all the combinations of Euro numbers and how often they have been drawn.');
    }

    public function query(): array
    {
        $date = request('date', null); // Datum aus der URL lesen
        $endDate = $date === '2022-03-18' ? '2022-03-18' : null;
        $startDate = $date === '2022-03-25' ? '2022-03-25' : null;

        $eurozahlenCombination = Lotto::haeufigsteEurozahlenKombinationen($startDate, $endDate);
        $eurozahlen = Lotto::haeufigsteEurozahlen($startDate, $endDate);

        return [
            'title' => $this->title,
            'description' => $this->description,
            'eurozahlenCombination' => $eurozahlenCombination,
            'eurozahlen' => $eurozahlen
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make(__('Show data up to March 18, 2022'))
                ->icon('calendar')
                ->method('redirectToDate')
                ->parameters(['date' => '2022-03-18']),
            
            Button::make(__('Show data from March 25, 2022'))
                ->icon('calendar-check')
                ->method('redirectToDate')
                ->parameters(['date' => '2022-03-25']),
            
            Button::make(__('Show all data'))
                ->icon('layers')
                ->method('redirectToDate')
                ->parameters(['date' => 'all']),
        ];
    }

    public function redirectToDate($date)
{
    // Leitet zur aktuellen Seite mit dem Datum als URL-Parameter um
    return redirect()->route('platform.numberstats', ['date' => $date]);
}

    

    public function layout(): array
    {
        return [
            new EurozahlenCardLayout(),
        ];
    }
}
