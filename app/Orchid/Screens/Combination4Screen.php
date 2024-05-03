<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Lotto;
use App\Orchid\Layouts\Combination4Layout;

class Combination4Screen extends Screen
{


    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $combinations4 = Lotto::getUniqueFourNumberCombinations();
        $limitedCombinations = array_slice($combinations4, 0, 42);
        
        return [
            'combinations4' => $limitedCombinations
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
            new Combination4Layout(),
        ];
    }
}
