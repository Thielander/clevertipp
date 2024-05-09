<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muster extends Model
{
    /**
     * Generiere alle möglichen Muster im Lotto.
     *
     * @return array
     */
    public static function generiereAlleMuster(): array
    {
        $muster = [];

       /**
         * Gerade Muster 
         *   *****
         */
        $geradeMuster = [
            [1, 2, 3, 4, 5], //Feld Quer & Hochkant
            [2, 3, 4, 5, 6], //Feld Quer 
            [3, 4, 5, 6, 7], //Feld Quer 
            [4, 5, 6, 7, 8], //Feld Quer 
            [5, 6, 7, 8, 9], //Feld Quer 
            [6, 7, 8, 9, 10], //Feld Quer & Hochkant
            [11, 12, 13, 14, 15], //Feld & Hochkant
            [12, 13, 14, 15, 16], //Feld
            [13, 14, 15, 16, 17], //Feld 
            [14, 15, 16, 17, 18], //Feld 
            [15, 16, 17, 18, 19], //Feld
            [16, 17, 18, 19, 20], //Feld & Hochkant
            [21, 22, 23, 24, 25], //Feld & Hochkant
            [22, 23, 24, 25, 26], //Feld 
            [23, 24, 25, 26, 27], //Feld 
            [24, 25, 26, 27, 28], //Feld 
            [25, 26, 27, 28, 29], //Feld 
            [26, 27, 28, 29, 30], //Feld & Hochkant
            [31, 32, 33, 34, 35], //Feld & Hochkant
            [32, 33, 34, 35, 36], //Feld 
            [33, 34, 35, 36, 37], //Feld 
            [34, 35, 36, 37, 38], //Feld 
            [35, 36, 37, 38, 39], //Feld 
            [36, 37, 38, 39, 40], //Feld & Hochkant
            [41, 42, 43, 44, 45], //Feld & Hochkant
            [42, 43, 44, 45, 46], //Feld
            [43, 44, 45, 46, 47], //Feld 
            [44, 45, 46, 47, 48], //Feld 
            [45, 46, 47, 48, 49], //Feld 
            [46, 47, 48, 49, 50], //Feld & Hochkant
            
            
        ];

        $muster['Gerade'] = $geradeMuster;

        /**
         * Senkrechte Muster Feld Quer
         *   *
         *   *
         *   *
         *   *
         *   *
         */
        $senkrechte = [
            [1, 11, 21, 31, 41], //Feld Quer
            [2, 12, 22, 32, 42], //Feld Quer
            [3, 13, 23, 33, 43], //Feld Quer
            [4, 14, 24, 34, 44], //Feld Quer
            [5, 15, 25, 35, 45], //Feld Quer
            [6, 16, 26, 32, 46], //Feld Quer
            [7, 17, 27, 32, 47], //Feld Quer
            [8, 18, 28, 32, 48], //Feld Quer
            [9, 19, 29, 32, 49], //Feld Quer
            [10, 20, 30, 32, 50], //Feld Quer
            
    
        ];

        $muster['Senkrecht'] = $senkrechte;

        /**
         * Diagonale Muster Feld Quer
         *   *
         *     *
         *       *
         *         *
         *           *
         */
        $diagonale = [
            [1, 12, 23, 34, 45], //Feld Quer
            [2, 13, 24, 35, 46], //Feld Quer
            [3, 14, 25, 36, 47], //Feld Quer
            [4, 15, 26, 37, 48], //Feld Quer
            [5, 16, 27, 38, 49], //Feld Quer
            [6, 17, 28, 39, 50], //Feld Quer
            [5, 14, 23, 32, 41], //Feld Quer
            [6, 15, 24, 33, 42], //Feld Quer
            [7, 16, 25, 34, 43], //Feld Quer
            [8, 17, 26, 35, 44], //Feld Quer
            [9, 18, 27, 36, 45], //Feld Quer
            [10, 19, 28, 37, 46], //Feld Quer
            [1, 7, 13, 19, 25], //Feld Hochkant
            [6, 12, 18, 24, 30], //Feld Hochkant
            [11, 17, 23, 29, 35], //Feld Hochkant
            [16, 22, 28, 34, 40], //Feld Hochkant
            [21, 27, 33, 39, 45], //Feld Hochkant
            [26, 32, 38, 44, 50], //Feld Hochkant
            [5, 9, 19, 17, 21], //Feld Hochkant
            [10, 14, 18, 22, 26], //Feld Hochkant
            [15, 19, 23, 27, 31], //Feld Hochkant
            [20, 24, 28, 32, 36], //Feld Hochkant
            [25, 29, 33, 37, 41], //Feld Hochkant
            [30, 34, 38, 42, 46], //Feld Hochkant
        ];

        $muster['Diagonal'] = $diagonale;

        /**
         * Winkel Muster oben Links offen Feld Quer
         *     *
         *     *
         *  ****
         */
        $winkelobenlinks = [
            [3, 13, 23, 22, 21], //Feld Quer
            [4, 14, 24, 23, 22], //Feld Quer
            [5, 15, 25, 24, 23], //Feld Quer
            [6, 16, 26, 25, 24], //Feld Quer
            [7, 17, 27, 26, 25], //Feld Quer
            [8, 18, 28, 27, 26], //Feld Quer
            [9, 19, 29, 28, 27], //Feld Quer
            [10, 20, 30, 29, 28], //Feld Quer
            [13, 23, 33, 32, 31], //Feld Quer
            [14, 24, 34, 33, 32], //Feld Quer
            [15, 25, 35, 34, 33], //Feld Quer
            [16, 26, 36, 35, 34], //Feld Quer
            [17, 27, 37, 36, 35], //Feld Quer
            [18, 28, 38, 37, 36], //Feld Quer
            [18, 29, 39, 38, 37], //Feld Quer
            [20, 30, 40, 39, 38], //Feld Quer
            [23, 33, 43, 42, 41], //Feld Quer
            [24, 34, 44, 43, 42], //Feld Quer
            [25, 35, 45, 44, 43], //Feld Quer
            [26, 36, 46, 45, 44], //Feld Quer
            [27, 37, 47, 46, 45], //Feld Quer
            [28, 38, 48, 47, 46], //Feld Quer
            [29, 39, 49, 48, 47], //Feld Quer
            [30, 40, 50, 49, 48], //Feld Quer
        ];

        $muster['WinkelObenLinks'] = $winkelobenlinks;

       /**
         * Winkel Muster oben rechts offen Feld Quer
         *     *
         *     *
         *     ***
         */
        $winkelobenrechts = [
            [3, 13, 23, 22, 21], //Feld Quer
         
        ];

        $muster['WinkelObenRechts'] = $winkelobenrechts;

        /**
         * Winkel Muster unten rechts offen Feld Quer
         *     ***
         *     *
         *     *
         */
        $winkeluntenrechts = [
            [1, 2, 3, 11, 21], //Feld Quer
         
        ];

        $muster['WinkelUntenRechts'] = $winkeluntenrechts;

        /**
         * Winkel Muster unten links offen Feld Quer
         *   ***
         *     *
         *     *
         */
        $winkeluntenlinks = [
            [1, 2, 3, 13, 23], 
            [2, 3, 4, 14, 24], 
            [3, 4, 5, 15, 25], 
            [4, 5, 6, 16, 26], 
            [5, 6, 7, 17, 27], 
            [6, 7, 8, 18, 28], 
            [7, 8, 9, 19, 29], 
            [8, 9, 10, 20, 30], 
            [11, 12, 13, 23, 33], 
            [12, 13, 14, 24, 34], 
            [13, 14, 15, 25, 35], 
            [14, 15, 16, 26, 36], 
            [15, 16, 17, 27, 37], 
            [16, 17, 18, 28, 38], 
            [17, 18, 19, 29, 39], 
            [18, 19, 20, 30, 40], 
            [21, 22, 23, 33, 43], 
            [22, 23, 24, 34, 44], 
            [23, 24, 25, 35, 45], 
            [24, 25, 26, 36, 46], 
            [25, 26, 27, 37, 47], 
            [26, 27, 28, 38, 48], 
            [27, 28, 29, 39, 49], 
            [28, 29, 30, 40, 50], 
         
        ];

        $muster['WinkelUntenLinksQuer'] = $winkeluntenlinks;

        /**
         * Winkel Muster PlusFeld Quer
         *     *
         *    ***
         *     *
         */
        $plus = [
            [2, 11, 12, 13, 22], 
            [3, 12, 13, 14, 23], 
            [4, 13, 14, 15, 24], 
            [5, 14, 15, 16, 25], 
            [6, 15, 16, 17, 26], 
            [7, 16, 17, 18, 27], 
            [8, 17, 18, 19, 28], 
            [9, 18, 19, 20, 29], 
            [12, 21, 22, 23, 32],
            [13, 22, 23, 24, 33],
            [14, 23, 24, 25, 34], 
            [15, 24, 25, 26, 35],
            [16, 25, 26, 27, 36],
            [17, 26, 27, 28, 37], 
            [18, 27, 28, 29, 38],
            [19, 28, 29, 30, 39],
            [22, 31, 32, 33, 42],
            [23, 32, 33, 34, 43],
            [24, 33, 34, 35, 44],
            [25, 34, 35, 36, 45],
            [26, 35, 36, 37, 46],
            [27, 36, 37, 38, 47],
            [28, 37, 38, 39, 48],
            [29, 38, 39, 40, 49],
         
        ];

        $muster['Plus'] = $plus;

        /**
         * Eigene Muster PfeilFeld Quer
         *      *  *
         *    *      *
         *  *          *
         *    *      *
         *      *  *
         */
        $pfeil = [
            [3, 12, 21, 32, 43], 
            [4, 13, 22, 33, 44], 
            [5, 14, 23, 34, 45], 
            [6, 15, 24, 35, 46], 
            [7, 16, 25, 36, 47], 
            [8, 17, 26, 37, 48], 
            [9, 18, 27, 38, 49], 
            [10, 19, 28, 39, 50], 
            [1, 12, 23, 32, 41], 
            [2, 13, 24, 33, 42], 
            [3, 14, 25, 34, 43], 
            [4, 15, 26, 35, 44], 
            [5, 16, 27, 36, 45], 
            [6, 17, 28, 37, 46], 
            [7, 18, 29, 38, 47], 
            [8, 19, 30, 39, 48], 
         
        ];

        $muster['PfeilQuer'] = $pfeil;

        /**
         * Eigene Muster PfeilFeld Hochkant
         *      *  *
         *    *      *
         *  *          *
         *    *      *
         *      *  *
         */
        $pfeilhochkant = [
            [3, 7, 11, 17, 23], 
            [4, 8, 12, 18, 24],
            [5, 9, 13, 19, 25],
            [8, 12, 16, 22, 28],
            [9, 13, 17, 23, 29],
            [10, 14, 18, 24, 30],
            [13, 17, 21, 27, 33],
            [14, 18, 22, 28, 34],
            [15, 19, 23, 29, 35],
            [18, 22, 26, 32, 38],
            [19, 23, 26, 32, 38],
            [20, 24, 27, 33, 39],
            [23, 27, 31, 37, 43],
            [24, 28, 32, 38, 44],
            [25, 29, 33, 39, 45],
            [28, 32, 36, 42, 48],
            [29, 33, 37, 43, 49],
            [30, 34, 38, 44, 50],
            [1, 7, 13, 17, 21],
            [2, 8, 14, 18, 22],
            [3, 9, 15, 19, 23],
            [6, 12, 18, 22, 26],
            [7, 13, 19, 23, 27],
            [8, 14, 20, 24, 28],
            [11, 17, 23, 27, 31],
            [12, 18, 24, 28, 32],
            [13, 19, 25, 29, 33],
            [16, 22, 28, 32, 36],
            [17, 23, 29, 33, 37],
            [18, 24, 30, 33, 38],
            [21, 27, 33, 37, 41],
            [22, 28, 34, 38, 42],
            [23, 29, 35, 39, 43],
            [26, 32, 38, 42, 46],
            [27, 33, 39, 43, 47],
            [28, 34, 40, 44, 48],
        ];

        $muster['PfeilHochkant'] = $pfeilhochkant;
        
         /**
         * Eigene Muster Zick Zack Senkrecht Feld Quer
         *     *
         *   *
         *     *
         *   *
         *     *
         */
        $zickzackSenkrecht = [
            [2, 11, 22, 31, 42], //Feld Quer
            [3, 12, 23, 32, 43], //Feld Quer
            [4, 13, 24, 33, 44], //Feld Quer
            [5, 14, 25, 34, 45], //Feld Quer
            [6, 15, 26, 35, 46], //Feld Quer
            [7, 16, 27, 36, 47], //Feld Quer
            [8, 17, 28, 37, 48], //Feld Quer
            [9, 18, 29, 38, 49], //Feld Quer
            [10, 19, 30, 39, 50], //Feld Quer
            [1, 12, 21, 32, 41], //Feld Quer
            [2, 13, 22, 33, 42], //Feld Quer
            [3, 14, 23, 34, 43], //Feld Quer
            [4, 15, 24, 35, 44], //Feld Quer
            [5, 16, 25, 36, 45], //Feld Quer
            [6, 17, 26, 37, 46], //Feld Quer
            [7, 18, 27, 38, 47], //Feld Quer
            [8, 19, 28, 39, 48], //Feld Quer
            [9, 20, 29, 40, 49], //Feld Quer
  
         
        ];

        $muster['ZickZackSenkrecht'] = $zickzackSenkrecht;
        

        /**
         * Eigene Muster Zick Zack Waagerecht Feld Quer
         *    *   *   *
         *      *   *
         */
        $zickZackWaagerecht = [
            [1, 3, 5, 12, 14], //Feld Quer
            [2, 4, 6, 13, 15], //Feld Quer
            [3, 5, 7, 14, 16], //Feld Quer
            [4, 6, 8, 15, 17], //Feld Quer
            [5, 7, 9, 16, 18], //Feld Quer
            [6, 8, 10, 17, 19], //Feld Quer
            [11, 13, 15, 22, 2], //Feld Quer
            [12, 14, 16, 23, 2], //Feld Quer
            [13, 15, 17, 24, 2], //Feld Quer
            [14, 16, 18, 25, 2], //Feld Quer
            [15, 17, 19, 26, 2], //Feld Quer
            [16, 18, 20, 27, 2], //Feld Quer
            [21, 23, 25, 32, 3], //Feld Quer
            [22, 24, 26, 33, 3], //Feld Quer
            [23, 25, 27, 34, 3], //Feld Quer
            [24, 26, 28, 35, 3], //Feld Quer
            [25, 27, 29, 36, 3], //Feld Quer
            [26, 28, 30, 37, 3], //Feld Quer
            [31, 33, 35, 42, 4], //Feld Quer
            [32, 34, 36, 43, 4], //Feld Quer
            [33, 35, 37, 44, 4], //Feld Quer
            [34, 36, 38, 45, 4], //Feld Quer
            [35, 37, 39, 46, 4], //Feld Quer
            [36, 38, 40, 47, 4], //Feld Quer
            [2, 5, 11, 13, 15], //Feld Quer

        ];

        $muster['ZickZackWaagerecht'] = $zickZackWaagerecht;
      

        return $muster; 
    }

   
    

 /**
 * Überprüft, ob die Zahlen ein Muster ergeben und gibt Details zurück.
 */
public static function checkNumber(int $num1 = 0, int $num2 = 0, int $num3 = 0, int $num4 = 0, int $num5 = 0, int $ext1 = 0, int $ext2 = 0, $date = null)
{
    $muster = self::generiereAlleMuster();

    // Kombination der übergebenen Zahlen erstellen
    $kombination = [$num1, $num2, $num3, $num4, $num5];
    $zusatzzahlen = [$ext1, $ext2];
    $gefundeneMuster = [];
    $gefunden = false;

    // Durch jedes Muster iterieren und überprüfen, ob die Kombination enthalten ist
    foreach ($muster as $musterTyp => $musterListe) {
        foreach ($musterListe as $einzelnesMuster) {
            // Überprüfen, ob alle Zahlen der Kombination im Muster enthalten sind
            $anzahlUebereinstimmungen = count(array_intersect($kombination, $einzelnesMuster));
            if ($anzahlUebereinstimmungen === 5) {
                $gefunden = true;
                $gefundeneMuster[] = $musterTyp; // Speichere den Typ des gefundenen Musters
            }
        }
    }

    return [
        'numbers' => array_merge($kombination, $zusatzzahlen),
        'found' => $gefunden,
        'found_patterns' => $gefundeneMuster
    ];
}

    
}
