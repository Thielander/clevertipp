<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Statistik extends Model
{
    public static function wieOftWurdeZahlGezogen(int $num1 = 0, int $num2 = 0, int $num3 = 0, int $num4 = 0, int $num5 = 0, int $ext1 = 0, int $ext2 = 0): array {
        $zahlen = [$num1, $num2, $num3, $num4, $num5];
        $zusatzzahlen = [$ext1, $ext2];
        $ergebnisse = [];

        // Zählen für Hauptzahlen
        foreach ($zahlen as $zahl) {
            if ($zahl > 0) {
                $count = DB::table('lottery_numbers')
                    ->where('num1', $zahl)
                    ->orWhere('num2', $zahl)
                    ->orWhere('num3', $zahl)
                    ->orWhere('num4', $zahl)
                    ->orWhere('num5', $zahl)
                    ->count();

                $ergebnisse[] = [
                    'zahl' => $zahl,
                    'anzahl' => $count
                ];
            }
        }

        // Zählen für Zusatzzahlen
        foreach ($zusatzzahlen as $zahl) {
            if ($zahl > 0) {
                $count = DB::table('lottery_numbers')
                    ->where('num6', $zahl)
                    ->orWhere('num7', $zahl)
                    ->count();

                $ergebnisse[] = [
                    'zusatzzahl' => $zahl,
                    'anzahl' => $count
                ];
            }
        }

        return $ergebnisse;
    }

    public static function statisticAllNumbers(): array {
        $ergebnisse = [];
    
        // Zahlen von 1 bis 50 durchlaufen
        for ($zahl = 1; $zahl <= 50; $zahl++) {
            // Zählen der Vorkommen der Zahl in verschiedenen Spalten
            $count = DB::table('lottery_numbers')
                ->where('num1', $zahl)
                ->orWhere('num2', $zahl)
                ->orWhere('num3', $zahl)
                ->orWhere('num4', $zahl)
                ->orWhere('num5', $zahl)
                ->count();
    
            $ergebnisse[] = [
                'zahl' => $zahl,
                'anzahl' => $count
            ];
        }
    
        // Sortieren des Arrays basierend auf der 'anzahl'
        usort($ergebnisse, function ($item1, $item2) {
            return $item2['anzahl'] - $item1['anzahl'];
        });
    
        return $ergebnisse;
    }
    
    public static function statisticAllEuroNumbers(): array {
        $ergebnisse = [];
    
        // Zahlen von 1 bis 12 durchlaufen
        for ($zahl = 1; $zahl <= 12; $zahl++) {
            // Zählen der Vorkommen der Zahl in verschiedenen Spalten
            $count = DB::table('lottery_numbers')
                ->where('num6', $zahl)
                ->orWhere('num7', $zahl)
                ->count();
    
            $ergebnisse[] = [
                'zahl' => $zahl,
                'anzahl' => $count
            ];
        }
    
        // Sortieren des Arrays basierend auf der 'anzahl'
        usort($ergebnisse, function ($item1, $item2) {
            return $item2['anzahl'] - $item1['anzahl'];
        });
    
        return $ergebnisse;
    }

    public static function statisticSeitWannNichtMehrGezogen(): array {
        $ergebnisse = [];

        for ($zahl = 1; $zahl <= 50; $zahl++) {
            $letzteZiehung = DB::table('lottery_numbers')
                ->where('num1', $zahl)
                ->orWhere('num2', $zahl)
                ->orWhere('num3', $zahl)
                ->orWhere('num4', $zahl)
                ->orWhere('num5', $zahl)
                ->latest('id')
                ->first();
    
            $ziehungenSeitLetzter = DB::table('lottery_numbers')
                ->where('id', '>', $letzteZiehung->id)
                ->count();
    
            $ergebnisse[] = [
                'zahl' => $zahl,
                'ziehungen_seit_letzter' => $ziehungenSeitLetzter
            ];
        }
    
        $maxZiehungen = max(array_column($ergebnisse, 'ziehungen_seit_letzter'));
    
        // Anpassen der Prozentwerte für die Progress Bars
        foreach ($ergebnisse as &$statistik) {
            $statistik['prozent'] = ($statistik['ziehungen_seit_letzter'] / $maxZiehungen) * 100;
        }
    
        return $ergebnisse;
    }
        
    public static function statisticSeitWannNichtMehrGezogenEurozahl(): array {
        $ergebnisse = [];

        for ($zahl = 1; $zahl <= 12; $zahl++) {
            $letzteZiehung = DB::table('lottery_numbers')
                ->where('num6', $zahl)
                ->orWhere('num7', $zahl)
          
                ->latest('id')
                ->first();
    
            $ziehungenSeitLetzter = DB::table('lottery_numbers')
                ->where('id', '>', $letzteZiehung->id)
                ->count();
    
            $ergebnisse[] = [
                'zahl' => $zahl,
                'ziehungen_seit_letzter' => $ziehungenSeitLetzter
            ];
        }
    
        $maxZiehungen = max(array_column($ergebnisse, 'ziehungen_seit_letzter'));
    
        // Anpassen der Prozentwerte für die Progress Bars
        foreach ($ergebnisse as &$statistik) {
            $statistik['prozent'] = ($statistik['ziehungen_seit_letzter'] / $maxZiehungen) * 100;
        }
    
        return $ergebnisse;
    }
    
}
