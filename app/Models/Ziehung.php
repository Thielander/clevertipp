<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ziehung extends Model
{

    public static function naechstesZiehungsdatum($timezone = 'Europe/Berlin'): string {
        $jetzt = Carbon::now($timezone);  
        $heute = $jetzt->dayOfWeek; 
        $uhrzeit = $jetzt->hour;

        // Wochentage als Konstanten: 1 für Montag, 2 für Dienstag, ..., 5 für Freitag
        $dienstag = Carbon::TUESDAY; //2
        $freitag = Carbon::FRIDAY;

        if ($heute == $dienstag && $uhrzeit < 21) {
            return $jetzt->format('d.m.Y'); // Heutiges Datum ausgeben
        } elseif ($heute == $freitag && $uhrzeit < 21) {
            return $jetzt->format('d.m.Y'); // Heutiges Datum ausgeben
        } else {
            // Nächsten Dienstag oder Freitag berechnen
            $naechsterDienstag = $jetzt->copy()->next($dienstag);
            $naechsterFreitag = $jetzt->copy()->next($freitag);

            // Wenn heute Dienstag nach 21 Uhr oder ein anderer Tag der Woche, aber vor Freitag ist
            if ($heute >= $dienstag && $heute < $freitag || $heute == $freitag && $uhrzeit >= 21) {
                return $naechsterFreitag->format('d.m.Y');
            } else {
                // Wenn heute Freitag nach 21 Uhr oder ein Tag nach Freitag ist
                return $naechsterDienstag->format('d.m.Y');
            }
        }
    }
}