<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Lotto;
use App\Orchid\Layouts\Combination2Layout;

class Combination2Screen extends Screen
{

  

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $combinations2 = Lotto::kombinationen2er();
        
        return [
            'combinations2' => $combinations2
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Combinations');
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
    public function layout(): array
    {
        return [
            new Combination2Layout(),
        ];
    }
}
