<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use App\Models\Analyse;
use Illuminate\Http\Request;


class AnalyseScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        // Array für die Zahlen anlegen
        $numbers = [];
    
        // Jede Nummer anfragen, Standardwert auf 0 setzen, wenn nicht vorhanden
        $numbers['num1'] = request('num1', 0);
        $numbers['num2'] = request('num2', 0);
        $numbers['num3'] = request('num3', 0);
        $numbers['num4'] = request('num4', 0);
        $numbers['num5'] = request('num5', 0);
    
        $numbers['ext1'] = request('ext1', 0);
        $numbers['ext2'] = request('ext2', 0);
    
        $abstaendeZahlen = Analyse::checkMuster(
            $numbers['num1'],
            $numbers['num2'],
            $numbers['num3'],
            $numbers['num4'],
            $numbers['num5'],
            $numbers['ext1'],
            $numbers['ext2']
        );

        $alleAbstaende = Analyse::alleAbstaendePruefen();

        $alleViererKombinationenFinden = Analyse::alleViererKombinationenFinden(
            $numbers['num1'],
            $numbers['num2'],
            $numbers['num3'],
            $numbers['num4'],
            $numbers['num5']
        );

        return [
            'zahlenanalyse' => $numbers,
            'abstaendeZahlen' => $abstaendeZahlen,
            'alleAbstaende' => $alleAbstaende,
            'viererkombinationen' => $alleViererKombinationenFinden
        ];
    }
    

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Number analysis');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Analyze'))
                ->method('analyzeData')
        ];
    }

    public function analyzeData(Request $request)
    {
        // Konstruiere die Basis-URL für die Weiterleitung
        $baseUrl = route('platform.analyse');
    
        // Hole die Daten aus dem Request
        $params = [
            'num1' => $request->input('zahlenanalyse.num1', 0),
            'num2' => $request->input('zahlenanalyse.num2', 0),
            'num3' => $request->input('zahlenanalyse.num3', 0),
            'num4' => $request->input('zahlenanalyse.num4', 0),
            'num5' => $request->input('zahlenanalyse.num5', 0),
            'ext1' => $request->input('zahlenanalyse.ext1', 0),
            'ext2' => $request->input('zahlenanalyse.ext2', 0),
        ];
    
        // Erstelle die URL mit den Query-Parametern
        $query = http_build_query($params);
        $fullUrl = "{$baseUrl}?{$query}";
    
        // Leite zur neuen URL mit den Parametern weiter
        return redirect()->to($fullUrl);
    }
    
    


    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Group::make([
                    Input::make('zahlenanalyse.num1')
                        ->type('number')
                        ->title(__('Number 1')),
                    Input::make('zahlenanalyse.num2')
                        ->type('number')
                        ->title(__('Number 2')),
                    Input::make('zahlenanalyse.num3')
                        ->type('number')
                        ->title(__('Number 3')),
                    Input::make('zahlenanalyse.num4')
                        ->type('number')
                        ->title(__('Number 4')),
                    Input::make('zahlenanalyse.num5')
                        ->type('number')
                        ->title(__('Number 5')),
                    Input::make('zahlenanalyse.ext1')
                    ->type('number')
                    ->title(__('Extra 1')),
                    Input::make('zahlenanalyse.ext2')
                    ->type('number')
                    ->title(__('Extra 2'))
                ]),
            ]),
            //Layout::view('components.analyseformular'),
            Layout::split([
                Layout::view('components.identicalnumbersHead'),
                Layout::view('components.identicalnumbers'),
            ])->ratio('30/70'),
            Layout::split([
                Layout::view('components.musteranalyseHead'),
                Layout::view('components.musteranalyse'),
            ])->ratio('30/70'),
          
            Layout::split([
                Layout::view('components.partiallyidenticalfiguresHead'),
                Layout::view('components.partiallyidenticalfigures'),
            ])->ratio('30/70'),
            
    
          
           
        ];
    }
}
