<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importiere DB Facade für komplexe Queries

class Dashboard extends Model
{

    /**
     * Zählt alle Einträge in der Tabelle 'lottery_numbers'.
     *
     * @return int
     */
    public static function countAllEntries()
    {
        // Zählt alle Einträge in der Tabelle und gibt die Anzahl zurück
        return DB::table('lottery_numbers')->count();
    }

    /**
     * Berechnet die Gesamtsumme der bisher ausgezahlten Gewinne aus der 'lotto' Tabelle.
     *
     * @return string
     */
    public static function bisherAusgeszahlt()
    {
        // Definiert die Summenberechnung direkt im Laravel Query Builder
        $totalAmount = DB::table('lottery_numbers')
            ->select(DB::raw("
                SUM(winner1_count * winner1_amount) +
                SUM(winner2_count * winner2_amount) +
                SUM(winner3_count * winner3_amount) +
                SUM(winner4_count * winner4_amount) +
                SUM(winner5_count * winner5_amount) +
                SUM(winner6_count * winner6_amount) +
                SUM(winner7_count * winner7_amount) +
                SUM(winner8_count * winner8_amount) +
                SUM(winner9_count * winner9_amount) +
                SUM(winner10_count * winner10_amount) +
                SUM(winner11_count * winner11_amount) +
                SUM(winner12_count * winner12_amount)
                AS total_amount
            "))
            ->first();

        return (int)$totalAmount->total_amount;
    }

    public static function gewinneUeberEineMillion()
    {
        $total = 0;

        for ($i = 1; $i <= 3; $i++) {
            // Zählt die Anzahl der Gewinne über einer Million in jeder Gewinnklasse
            $count = DB::table('lottery_numbers')
                ->where("winner{$i}_amount", '>', 1000000)  // Gewinnbetrag muss über einer Million liegen
                ->sum("winner{$i}_count");  // Summiert die Anzahl der Gewinner, die diese Bedingung erfüllen

            // Addiert die Zahlen zu einer Gesamtsumme
            $total += $count;
        }

        return (int) $total;  // Gibt die Gesamtzahl als Integer zurück
    }

     /**
     * Liest die Zahlen num1 bis num7 und den Spieleinsatz des letzten Eintrags.
     *
     * @return object
     */
    public static function letzterEintragZahlenUndEinsatz()
    {
        return DB::table('lottery_numbers')
                 ->select('draw_date', 'num1', 'num2', 'num3', 'num4', 'num5', 'num6', 'num7', 'spieleinsatz')
                 ->latest('draw_date')
                 ->first();
    }

    /**
     * Liest die Gewinnklassen und die Anzahl der Gewinner des letzten Eintrags.
     *
     * @return object
     */
    public static function letzterEintragGewinnklassen()
    {
        $result = DB::table('lottery_numbers')
            ->select(
                'winner1_count', 'winner1_amount',
                'winner2_count', 'winner2_amount',
                'winner3_count', 'winner3_amount',
                'winner4_count', 'winner4_amount',
                'winner5_count', 'winner5_amount',
                'winner6_count', 'winner6_amount',
                'winner7_count', 'winner7_amount',
                'winner8_count', 'winner8_amount',
                'winner9_count', 'winner9_amount',
                'winner10_count', 'winner10_amount',
                'winner11_count', 'winner11_amount',
                'winner12_count', 'winner12_amount'
            )
            ->latest('draw_date')
            ->first();
    
        $gewinnklassen = [];
        for ($i = 1; $i <= 12; $i++) {
            $gewinnklasse = "{$i}"; // Konstruiere den Namen der Gewinnklasse
            $gewinnKey = "winner{$i}_count";
            $gewinnBetragKey = "winner{$i}_amount";
            $gewinnklassen[] = [
                'gewinnklasse' => $gewinnklasse,
                'gewinne' => $result->$gewinnKey,
                'gewinn_betrag' => $result->$gewinnBetragKey,
            ];
        }
    
        return $gewinnklassen;
    }
    

    /**
     * Ermittelt den größten ausgezahlten Betrag in der Gewinnklasse "winner1".
     *
     * @return int
     */
    public static function groessterAusgezahlterBetrag()
    {
        // Ermittelt den maximalen Wert von winner1_amount aus der Tabelle
        $maxAmount = DB::table('lottery_numbers')
            ->max('winner1_amount');  // Findet den höchsten Betrag in der Spalte winner1_amount

        return (int)$maxAmount;  // Gibt den maximalen Betrag als Integer zurück
    }

    public static function jackpotGeknackt()
    {
        // Gesamtzahl der Spiele ermitteln
        $totalGames = DB::table('lottery_numbers')->count();

        // Überprüft, ob Spiele vorhanden sind, um Division durch Null zu vermeiden
        if ($totalGames === 0) {
            return [];
        }

        // Hilfsfunktion, um die Prozentzahl der Spiele zu ermitteln, in denen der Jackpot geknackt wurde
        $calculateJackpotPercentage = function($column) use ($totalGames) {
            $jackpotWins = DB::table('lottery_numbers')->where($column, '>', 0)->count();
            return ($jackpotWins / $totalGames) * 100;
        };

        // Prozentzahlen für jede winner_count Spalte berechnen
        $percentages = [];
        for ($i = 1; $i <= 5; $i++) {
            $column = "winner{$i}_count";
            $percentages[$column] = $calculateJackpotPercentage($column);
        }

        return $percentages;
    }
}   
    