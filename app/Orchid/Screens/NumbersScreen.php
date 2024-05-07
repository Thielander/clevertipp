<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Actions\ModalToggle;

class NumbersScreen extends Screen
{
    public function query(): array
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('Your numbers');
    }

    public function commandBar(): array
    {
        return [
            ModalToggle::make('Zahlen hinzufügen')
                ->modal('lottoModal')
                ->icon('bs.plus-square-dotted'),
        ];
    }


    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('user.firstname')
                    ->title('Vorname')
                    ->required(),
              
              
            ]),
            Layout::modal('lottoModal', Layout::rows([
                Group::make([
                    Input::make('zahlenanalyse.num1')
                        ->type('number')
                        ->title(__('Number 1'))
                        ->max('50'),
                    Input::make('zahlenanalyse.num2')
                        ->type('number')
                        ->title(__('Number 2'))
                        ->max('50'),
                    Input::make('zahlenanalyse.num3')
                        ->type('number')
                        ->title(__('Number 3'))
                        ->max('50'),
                    Input::make('zahlenanalyse.num4')
                        ->type('number')
                        ->title(__('Number 4'))
                        ->max('50'),
                    Input::make('zahlenanalyse.num5')
                        ->type('number')
                        ->title(__('Number 5'))
                        ->max('50')
                ]),
                Group::make([
                    Input::make('zahlenanalyse.ext1')
                        ->type('number')
                        ->title(__('Extra 1'))
                        ->max('12'),
                        
                    Input::make('zahlenanalyse.ext2')
                        ->type('number')
                        ->title(__('Extra 2'))
                        ->max('12')
                ]),
            ]))->title('Neue Zahlen anlegen'),
        ];
    }


}
