<?php

namespace App\Orchid\Screens\Examples;

use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ChartLineExample;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\Currency;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use App\Models\Dashboard;
use App\Models\Muster;
use App\Models\Ziehung;
use App\Models\Lottodaten;
use App\Models\Analyse;


class ExampleScreen extends Screen
{
    /**
     * Fish text for the table.
     */
    public const TEXT_EXAMPLE = 'Lorem ipsum at sed ad fusce faucibus primis, potenti inceptos ad taciti nisi tristique
    urna etiam, primis ut lacus habitasse malesuada ut. Lectus aptent malesuada mattis ut etiam fusce nec sed viverra,
    semper mattis viverra malesuada quam metus vulputate torquent magna, lobortis nec nostra nibh sollicitudin
    erat in luctus.';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {

        $ziehungen = Dashboard::countAllEntries();
        $bisherAusgezahlt = Dashboard::bisherAusgeszahlt();
        $jackpotGeknackt = Dashboard::jackpotGeknackt();
        $groessterAusgezahlterBetrag = Dashboard::groessterAusgezahlterBetrag();
        $gewinneUeberEineMillion = Dashboard::gewinneUeberEineMillion();
        $letzterEintragZahlenUndEinsatz = Dashboard::letzterEintragZahlenUndEinsatz();
        $letzterEintragGewinnklassen = Dashboard::letzterEintragGewinnklassen();
    
        $alleMuster = Muster::generiereAlleMuster();

        $alleAbstaende = Analyse::checkMuster(
            $letzterEintragZahlenUndEinsatz->num1,
            $letzterEintragZahlenUndEinsatz->num2,
            $letzterEintragZahlenUndEinsatz->num3,
            $letzterEintragZahlenUndEinsatz->num4,
            $letzterEintragZahlenUndEinsatz->num5
        );
        

        $check = Muster::checkNumber(
            $letzterEintragZahlenUndEinsatz->num1,
            $letzterEintragZahlenUndEinsatz->num2,
            $letzterEintragZahlenUndEinsatz->num3,
            $letzterEintragZahlenUndEinsatz->num4,
            $letzterEintragZahlenUndEinsatz->num5
        );

        $naechsteZiehung = Ziehung::naechstesZiehungsdatum();

        $lottoDaten = Lottodaten::fetchData();
       
        return [
            'categorycharts'  => [
                [
                    'name'   => 'Gewinnklassen',
                    'values' => array_values($jackpotGeknackt),
                    'labels' => [__('Prize category 1'), __('Prize category 2'), __('Prize category 3'), __('Prize category 4'), __('Prize category 5')],
                ],
            ],
            'charts'  => [
                [
                    'name'   => 'Gewinnchancen',
                    'values' => [0.000000715, 0.000014302, 0.000032180, 0.000160900, 0.003218021, 0.007079646, 0.007240605, 0.101522843, 0.141643059, 0.318471338, 0.531914894, 2.040816327],
                    'labels' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                ],
            ],
            'gewinntable'   => [
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[0]['gewinnklasse'] . ' - 5 Richtige + 2 EZ' , 'gewinne' => $letzterEintragGewinnklassen[0]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[0]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[1]['gewinnklasse'] . ' - 5 Richtige + 1 EZ',  'gewinne' => $letzterEintragGewinnklassen[1]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[1]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[2]['gewinnklasse'] . ' - 5 Richtige + 0 EZ',  'gewinne' => $letzterEintragGewinnklassen[2]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[2]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[3]['gewinnklasse'] . ' - 4 Richtige + 2 EZ',  'gewinne' => $letzterEintragGewinnklassen[3]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[3]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[4]['gewinnklasse'] . ' - 4 Richtige + 1 EZ',  'gewinne' => $letzterEintragGewinnklassen[4]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[4]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[5]['gewinnklasse'] . ' - 3 Richtige + 2 EZ',  'gewinne' => $letzterEintragGewinnklassen[5]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[5]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[6]['gewinnklasse'] . ' - 4 Richtige + 0 EZ',  'gewinne' => $letzterEintragGewinnklassen[6]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[6]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[7]['gewinnklasse'] . ' - 2 Richtige + 2 EZ',  'gewinne' => $letzterEintragGewinnklassen[7]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[7]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[8]['gewinnklasse'] . ' - 3 Richtige + 1 EZ',  'gewinne' => $letzterEintragGewinnklassen[8]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[8]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[9]['gewinnklasse'] . ' - 3 Richtige + 0 EZ',  'gewinne' => $letzterEintragGewinnklassen[9]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[9]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[10]['gewinnklasse'] . ' - 1 Richtige + 2 EZ',  'gewinne' => $letzterEintragGewinnklassen[10]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[10]['gewinn_betrag']]),
                new Repository(['gewinnklasse' => $letzterEintragGewinnklassen[11]['gewinnklasse'] . ' - 2 Richtige + 1 EZ',  'gewinne' => $letzterEintragGewinnklassen[11]['gewinne'] . ' x', 'gewinn_betrag' => $letzterEintragGewinnklassen[11]['gewinn_betrag']]),

            ],
            'letzterEintragZahlenUndEinsatz' => $letzterEintragZahlenUndEinsatz,
            'naechsteziehung' => $naechsteZiehung,
            'lottodaten' => $lottoDaten,
            'zahlencheck' => $check,
            'metrics' => [
                'sales'    => ['value' => number_format($ziehungen)],
                'visitors' => ['value' => number_format($bisherAusgezahlt) . '€'],
                'orders'   => ['value' => number_format($groessterAusgezahlterBetrag) . '€'],
                'total'    => number_format($gewinneUeberEineMillion),
            ],
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Clevertipp Dashboard';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('Smart bets, smart wins');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Show toast')
                ->method('showToast')
                ->novalidate()
                ->icon('bs.chat-square-dots'),

            ModalToggle::make('Launch demo modal')
                ->modal('exampleModal')
                ->method('showToast')
                ->icon('bs.window'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        
        $letzterEintragZahlenUndEinsatz = $this->query()['letzterEintragZahlenUndEinsatz'];

        return [
            Layout::metrics([
                __('Lotto draws')    => 'metrics.sales',
                __('Paid out so far') => 'metrics.visitors',
                __('Largest amount paid out') => 'metrics.orders',
                __('New millionaires') => 'metrics.total',
            ]),

           
            Layout::columns([
                
                Layout::view('naechsteziehung', compact('letzterEintragZahlenUndEinsatz')),
                Layout::view('dashboardzahlen', compact('letzterEintragZahlenUndEinsatz')),
                
            ]),
            Layout::columns([
                Layout::view('dashboardanalyse', compact('letzterEintragZahlenUndEinsatz')),
                Layout::table('gewinntable', [
                    TD::make('gewinnklasse', 'Gewinnklasse')
                        ->width('100'),
                
                    TD::make('gewinne', 'Gewinne')
                        ->width('100')
                        ->align(TD::ALIGN_RIGHT)
                        ->sort(),

                    TD::make('gewinn_betrag', 'Quoten')
                        ->width('100')
                        ->usingComponent(Currency::class, before: '€')
                        ->align(TD::ALIGN_RIGHT),
                ]),
                
            ]),
             Layout::columns([
                ChartBarExample::make('categorycharts', __('Prize categories'))
                    ->description(__('The chart shows the percentage of times each prize category has been paid out, with prize category 1 indicating how often the jackpot has been won.')),

                ChartLineExample::make('charts', __('Chances of winning') . " in %")
                    ->description(__('The odds of winning in each class are determined by the combination of correctly picked numbers.')),
            ]),
            Layout::modal('exampleModal', Layout::rows([
                Input::make('toast')
                    ->title('Messages to display')
                    ->placeholder('Hello world!')
                    ->help('The entered text will be displayed on the right side as a toast.')
                    ->required(),
            ]))->title('Create your own toast message'),
        ];
    }

    public function showToast(Request $request): void
    {
        Toast::warning($request->get('toast', 'Hello, world! This is a toast message.'));
    }
}
