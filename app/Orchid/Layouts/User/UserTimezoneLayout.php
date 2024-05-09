<?php

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;
use DateTimeZone;
use DateTime;

class UserTimezoneLayout extends Rows
{
    /**
     * Erzeugt eine Liste aller verfügbaren Zeitzonen.
     *
     * @return array
     */
    private function getTimezoneOptions(): array
    {
        $timezones = [];
        $timezoneIdentifiers = DateTimeZone::listIdentifiers();
        foreach ($timezoneIdentifiers as $identifier) {
            $timezones[$identifier] = $identifier;
        }
        return $timezones;
    }

    /**
     * Gibt die aktuelle Uhrzeit in der vom Benutzer gewählten Zeitzone zurück.
     *
     * @return string
     */
    protected function getCurrentTime(): string
    {
        // Verwendet UTC als Standardzeitzone, falls keine Benutzerzeitzone verfügbar ist.
        $userTimezone = $this->query->get('user')->timezone ?? 'UTC'; 
        $now = new DateTime('now', new DateTimeZone($userTimezone));
        return $now->format('H:i:s');
    }

    protected function fields(): array
    {
        return [
            Select::make('user.timezone')
                ->title(__('Time Zone') . " ( " . $this->getCurrentTime() . " )")
                ->options($this->getTimezoneOptions())
                ->help(__('Select your preferred time zone.')),
        ];
    }
}
