<?php

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;

class UserLanguageLayout extends Rows
{
    protected function fields(): array
    {
        return [
            Select::make('user.language')
                ->title(__('Preferred Language'))
                ->options([
                    'en' => 'English',
                    'de' => 'Deutsch',
                    'fr' => 'Français',  
                ])
                ->help('Select your preferred language.'),
        ];
    }
}
