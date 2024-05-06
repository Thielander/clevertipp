<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{

     /**
     * Abstände prüfen
     */
    public static function checkMuster(int $num1, int $num2, int $num3, int $num4, int $num5): array
    {
        // Schritt 1: Zahlen in einem Array sammeln und sortieren
        $zahlen = [$num1, $num2, $num3, $num4, $num5];
        sort($zahlen);
    
        // Schritt 2: Abstände berechnen
        $abstaende = [];
        for ($i = 0; $i < count($zahlen) - 1; $i++) {
            $abstaende[] = $zahlen[$i + 1] - $zahlen[$i] - 1;
        }
    
        // Schritt 3: Überprüfen, ob alle Abstände unterschiedlich sind
        $uniqueAbstaende = array_unique($abstaende);
        $analyse = count($abstaende) === count($uniqueAbstaende);
    
        // Schritt 4: Ergebnisarray zusammenstellen
        $ergebnis = [
            'zahlen' => $zahlen,
            'abstaende' => $abstaende,
            'analyse' => $analyse ? 'true' : 'false'
        ];
    
        return $ergebnis;
    }
    
}