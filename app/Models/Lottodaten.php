<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Lottodaten extends Model
{
    public static function fetchData()
    {
        $url = 'https://www.eurojackpot.de/wlinfo/WL_InfoService?client=jsn&gruppe=ZahlenUndQuoten&ewGewsum=ja&historie=ja&spielart=EJ&adg=ja&lang=de';

        // Deaktiviere SSL-Überprüfung für diesen Request im lokalen Entwicklungsumfeld
        $response = Http::withoutVerifying()->get($url);

        //$response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            return self::extractRelevantData($data);
        } else {
            // Handle error or unsuccessful response
            return [
                'error' => 'Failed to fetch data from the API.'
            ];
        }
    }

    protected static function extractRelevantData($data)
    {
        $relevantData = [];

        // Extrahiere 'spieleinsatz' Daten
        if (isset($data['auswertung']['spieleinsatz']['hauptlotterie'])) {
            $relevantData['spieleinsatz'] = $data['auswertung']['spieleinsatz']['hauptlotterie'];
        }

        // Extrahiere 'erwarteteGewinnsummen' Daten
        if (isset($data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['erwarteteGewinnsummen'])) {
            $erwarteteGewinnsummen = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['erwarteteGewinnsummen'];
            $relevantData['erwarteteGewinnsummen'] = [
                'folgeziehung' => $erwarteteGewinnsummen['folgeziehung'],
                'jackpot' => $erwarteteGewinnsummen['gewinnklassen'][0]['jackpot'] ?? null
            ];
        }

        return $relevantData;
   
    }
}