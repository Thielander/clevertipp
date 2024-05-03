<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importiere DB Facade für komplexe Queries

class Lotto extends Model
{
    protected $table = 'lottery_numbers';
    protected $fillable = [
        'draw_date', 'num6', 'num7',
    ];

    /**
     * Berechnet die häufigsten Eurozahlen innerhalb eines optional definierten Datumsbereichs.
     *
     * @param  string|null  $startDatum  Startdatum des Zeitraums
     * @param  string|null  $endDatum    Enddatum des Zeitraums
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function haeufigsteEurozahlenKombinationen($startDatum = null, $endDatum = null)
    {
        // SQL-Abfrage, die die kleinere und größere Zahl der beiden Spalten bestimmt
        // unabhängig von ihrer ursprünglichen Position (num6 oder num7)
        $query = DB::table('lottery_numbers')
                    ->select(DB::raw('LEAST(num6, num7) as first_num'), 
                             DB::raw('GREATEST(num6, num7) as second_num'), 
                             DB::raw('COUNT(*) as anzahl'))
                    ->when($startDatum, function ($query) use ($startDatum) {
                        return $query->where('draw_date', '>=', $startDatum);
                    })
                    ->when($endDatum, function ($query) use ($endDatum) {
                        return $query->where('draw_date', '<=', $endDatum);
                    })
                    ->groupBy('first_num', 'second_num')
                    ->orderBy('anzahl', 'desc')
                    ->orderBy('first_num', 'asc')
                    ->orderBy('second_num', 'asc')
                    ->get();
    
        return $query;
    }
    
    
   /**
     * Ermittelt die Häufigkeit, mit der jede Eurozahl gezogen wurde, optional gefiltert nach Datum.
     *
     * @param string|null $startDatum Startdatum für die Filterung der Ergebnisse
     * @param string|null $endDatum Enddatum für die Filterung der Ergebnisse
     * @return \Illuminate\Support\Collection
     */
    public static function haeufigsteEurozahlen($startDatum = null, $endDatum = null)
    {
        // Erstelle eine Query für die Eurozahlen in 'num6'
        $num6Query = DB::table('lottery_numbers')
            ->select('num6 as number')
            ->when($startDatum, function ($query) use ($startDatum) {
                return $query->where('draw_date', '>=', $startDatum);
            })
            ->when($endDatum, function ($query) use ($endDatum) {
                return $query->where('draw_date', '<=', $endDatum);
            });

        // Erstelle eine zweite Query für die Eurozahlen in 'num7'
        $num7Query = DB::table('lottery_numbers')
            ->select('num7 as number')
            ->when($startDatum, function ($query) use ($startDatum) {
                return $query->where('draw_date', '>=', $startDatum);
            })
            ->when($endDatum, function ($query) use ($endDatum) {
                return $query->where('draw_date', '<=', $endDatum);
            });

        // Kombiniere die zwei Queries mit UNION ALL und zähle die Vorkommen
        $combinedQuery = $num6Query->unionAll($num7Query);

        // Führe die finale Abfrage aus, um die Anzahl der Ziehungen jeder Zahl zu zählen
        return DB::query()
            ->fromSub($combinedQuery, 'combined_numbers')
            ->select('number', DB::raw('COUNT(*) as anzahl'))
            ->groupBy('number')
            ->orderBy('anzahl', 'desc')
            ->orderBy('number', 'asc')
            ->get();
    }

    /**
     * Berechnet die Kombinationen von Eurozahlen.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function kombinationen2er()
    {
            $sql = "
            WITH RECURSIVE combinations AS (
                SELECT id, num1 AS num, 1 AS level
                FROM lottery_numbers
                UNION ALL
                SELECT l.id, 
                    CASE 
                        WHEN c.level = 1 THEN l.num2
                        WHEN c.level = 2 THEN l.num3
                        WHEN c.level = 3 THEN l.num4
                        WHEN c.level = 4 THEN l.num5
                    END,
                    c.level + 1
                FROM lottery_numbers l
                JOIN combinations c ON l.id = c.id AND c.level < 5
            )
            , pairs AS (
                SELECT c1.id, c1.num AS num1, c2.num AS num2
                FROM combinations c1
                JOIN combinations c2 ON c1.id = c2.id AND c1.num < c2.num
            )
            SELECT num1, num2, COUNT(*) AS count
            FROM pairs
            GROUP BY num1, num2
            ORDER BY count DESC
            LIMIT 42;
            ";

        // Führe die SQL-Abfrage aus und hole die Ergebnisse
        $results = DB::select($sql);

        return $results;
    }
    

    public static function kombinationen3er()
{
    $sql = "
    WITH RECURSIVE combinations AS (
        SELECT id, num1 AS num, 1 AS level
        FROM lottery_numbers
        UNION ALL
        SELECT l.id, 
            CASE 
                WHEN c.level = 1 THEN l.num2
                WHEN c.level = 2 THEN l.num3
                WHEN c.level = 3 THEN l.num4
                WHEN c.level = 4 THEN l.num5
            END,
            c.level + 1
        FROM lottery_numbers l
        JOIN combinations c ON l.id = c.id AND c.level < 5
    )
    , triples AS (
        SELECT c1.id, c1.num AS num1, c2.num AS num2, c3.num AS num3
        FROM combinations c1
        JOIN combinations c2 ON c1.id = c2.id AND c1.num < c2.num
        JOIN combinations c3 ON c2.id = c3.id AND c2.num < c3.num
    )
    SELECT num1, num2, num3, COUNT(*) AS count
    FROM triples
    GROUP BY num1, num2, num3
    ORDER BY count DESC
    LIMIT 42;
    ";

    // Führe die SQL-Abfrage aus und hole die Ergebnisse
    $results = DB::select($sql);

    return $results;
}

public static function getUniqueThreeNumberCombinations()
{
    // Daten aus der Datenbank holen
    $lotteryNumbers = DB::table('lottery_numbers')->get(['num1', 'num2', 'num3', 'num4', 'num5']);

    // Ein Set für die einzigartigen Kombinationen und ihre Zählungen initialisieren
    $combinations = [];

    foreach ($lotteryNumbers as $numbers) {
        // Alle Zahlen in einem Array speichern
        $nums = [$numbers->num1, $numbers->num2, $numbers->num3, $numbers->num4, $numbers->num5];

        // Erzeugt alle Kombinationen von 3 Zahlen
        for ($i = 0; $i < count($nums) - 2; $i++) {
            for ($j = $i + 1; $j < count($nums) - 1; $j++) {
                for ($k = $j + 1; $k < count($nums); $k++) {
                    // Sortiert die Zahlen, um sicherzustellen, dass die Reihenfolge irrelevant ist
                    $combination = [$nums[$i], $nums[$j], $nums[$k]];
                    sort($combination);

                    // Konvertiert das Array zu einem String, um es eindeutig zu machen
                    $combinationKey = implode(',', $combination);

                    // Zählt, wie oft jede Kombination vorkommt
                    if (isset($combinations[$combinationKey])) {
                        $combinations[$combinationKey]['count']++;
                    } else {
                        $combinations[$combinationKey] = [
                            'combination' => $combination,
                            'count' => 1
                        ];
                    }
                }
            }
        }
    }

    // Sortiert das Kombinationen-Array basierend auf der Anzahl der Vorkommen, absteigend
    uasort($combinations, function ($a, $b) {
        return $b['count'] - $a['count'];
    });

    // Nur die Werte des Sets zurückgeben
    return array_values($combinations);
}

public static function getUniqueFourNumberCombinations()
{
    // Daten aus der Datenbank holen
    $lotteryNumbers = DB::table('lottery_numbers')->get(['num1', 'num2', 'num3', 'num4', 'num5']);

    // Ein Set für die einzigartigen Kombinationen und ihre Zählungen initialisieren
    $combinations = [];

    foreach ($lotteryNumbers as $numbers) {
        // Alle Zahlen in einem Array speichern
        $nums = [$numbers->num1, $numbers->num2, $numbers->num3, $numbers->num4, $numbers->num5];

        // Erzeugt alle Kombinationen von 4 Zahlen
        for ($i = 0; $i < count($nums) - 3; $i++) {
            for ($j = $i + 1; $j < count($nums) - 2; $j++) {
                for ($k = $j + 1; $k < count($nums) - 1; $k++) {
                    for ($l = $k + 1; $l < count($nums); $l++) {
                        // Sortiert die Zahlen, um sicherzustellen, dass die Reihenfolge irrelevant ist
                        $combination = [$nums[$i], $nums[$j], $nums[$k], $nums[$l]];
                        sort($combination);

                        // Konvertiert das Array zu einem String, um es eindeutig zu machen
                        $combinationKey = implode(',', $combination);

                        // Zählt, wie oft jede Kombination vorkommt
                        if (isset($combinations[$combinationKey])) {
                            $combinations[$combinationKey]['count']++;
                        } else {
                            $combinations[$combinationKey] = [
                                'combination' => $combination,
                                'count' => 1
                            ];
                        }
                    }
                }
            }
        }
    }

    // Sortiert das Kombinationen-Array basierend auf der Anzahl der Vorkommen, absteigend
    uasort($combinations, function ($a, $b) {
        return $b['count'] - $a['count'];
    });

    // Nur die Werte des Sets zurückgeben
    return array_values($combinations);
}

}
