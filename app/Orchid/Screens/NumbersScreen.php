<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;

class NumbersScreen extends Screen
{
    public function query(): array
    {
        return [];
    }

    public function commandBar(): array
    {
        return [
            Button::make(__('Save'))
                ->icon('user')
                ->method('register')
        ];
    }


    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('user.firstname')
                    ->title('Vorname')
                    ->required(),
                Input::make('user.lastname')
                    ->title('Nachname')
                    ->required(),
                Input::make('user.email')
                    ->title('Email')
                    ->type('email')
                    ->required(),
                Input::make('user.address')
                    ->title('Anschrift')
                    ->required(),
                Group::make([
                    Input::make('user.postcode')
                        ->title('PLZ')
                        ->required(),
                    Input::make('user.city')
                        ->title('Ort')
                        ->required(),
                ]),
            ])
        ];
    }


}
