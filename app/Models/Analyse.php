<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Analyse extends Model
{

     /**
     * Abstände prüfen
     */
    public static function checkMuster(int $num1 = 0, int $num2 = 0, int $num3 = 0, int $num4 = 0, int $num5 = 0, int $ext1 = 0, int $ext2 = 0, $date = null): array
    {
        // Schritt 1: Zahlen in einem Array sammeln und sortieren
        $zahlen = [$num1, $num2, $num3, $num4, $num5];
        $zusatzzahlen = [$ext1, $ext2];
        sort($zahlen);
        sort($zusatzzahlen);
    
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
            'date' => $date,
            'zahlen' => $zahlen,
            'zusatzzahlen' => $zusatzzahlen,
            'abstaende' => $abstaende,
            'analyse' => $analyse ? 'true' : 'false'
        ];
    
        return $ergebnis;
    }
    
    public static function alleViererKombinationenFinden(int $num1 = 0, int $num2 = 0, int $num3 = 0, int $num4 = 0, int $num5 = 0)
{
    $ergebnisse = [];
    $eingabeZahlen = [$num1, $num2, $num3, $num4, $num5];
    sort($eingabeZahlen); // Sortiere die Eingabezahlen sofort

    $datensaetze = DB::table('lottery_numbers')
        ->select('draw_date', 'num1', 'num2', 'num3', 'num4', 'num5', 'num6', 'num7')
        ->get();

    foreach ($datensaetze as $datensatz) {
        $datenZahlen = [$datensatz->num1, $datensatz->num2, $datensatz->num3, $datensatz->num4, $datensatz->num5];
        sort($datenZahlen); // Sortiere die Zahlen jedes Datensatzes sofort

        $zusatzzahlen = [$datensatz->num6, $datensatz->num7];
        sort($zusatzzahlen); // Sortiere die Zusatzzahlen sofort

        $matchedNumbers = array_intersect($eingabeZahlen, $datenZahlen);
        sort($matchedNumbers); // Sortiere die übereinstimmenden Zahlen sofort

        $uebereinstimmendeZahlen = count($matchedNumbers);

        if ($uebereinstimmendeZahlen >= 4) {
            $treffer = [
                'draw_date' => $datensatz->draw_date,
                'numbers' => $datenZahlen,
                'zusatzzahlen' => $zusatzzahlen,
                'matched_numbers' => $matchedNumbers,
            ];

            $ergebnisse[] = $treffer;
        }
    }

    // Optional: Sortiere die gesamte Ergebnisliste nach einem anderen Kriterium, z.B. Datum
    usort($ergebnisse, function ($a, $b) {
        return $b['draw_date'] <=> $a['draw_date']; // Sortiere nach Datum, falls notwendig
    });

    return $ergebnisse;
}

    

    /**
     * Alle Abstände prüfen
     */
    public static function alleAbstaendePruefen()
    {
        $ergebnisse = [];
        $datensaetze = DB::table('lottery_numbers')
                         ->select('draw_date', 'num1', 'num2', 'num3', 'num4', 'num5', 'num6', 'num7')
                         ->get();

        foreach ($datensaetze as $datensatz) {
            $datensatz = (array)$datensatz;
            // Einzelne Zahlen extrahieren und als Integer an die Methode übergeben
            $ergebnisse[] = self::checkMuster(
                (int) $datensatz['num1'], 
                (int) $datensatz['num2'], 
                (int) $datensatz['num3'], 
                (int) $datensatz['num4'], 
                (int) $datensatz['num5'], 
                (int) $datensatz['num6'], 
                (int) $datensatz['num7'],
                      $datensatz['draw_date']

            );
        }

        return $ergebnisse;
    }
}