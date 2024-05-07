<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Dashboard')
                ->icon('bs.house-door-fill')
                ->route('platform.example'),
                //->badge(fn () => 6),

            Menu::make(__('Your numbers'))
                ->icon('bs.0-square-fill')
                ->route('platform.numbers'),

            Menu::make(__('Supplementary numbers'))
                ->icon('bs.bar-chart-fill')
                ->title(__('Combinations'))
                ->route('platform.numberstats'),

            Menu::make(__('2 Numbers'))
                ->icon('bs.2-circle-fill')
                ->route('platform.combinations2'),
            
            Menu::make(__('3 Numbers'))
                ->icon('bs.3-circle-fill')
                ->route('platform.combinations3'),

            Menu::make(__('4 Numbers'))
                ->icon('bs.4-circle-fill')
                ->route('platform.combinations4'),

            Menu::make(__('5 Numbers'))
                ->icon('bs.5-circle-fill')
                ->route('platform.combinations5'),

            Menu::make(__('Number analysis'))
                ->icon('bs.123')
                ->title(__('Analysis'))
                ->route('platform.analyse'),


            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

                
            Menu::make('Website')
                ->title('Links')
                ->icon('bs.box-arrow-up-right')
                ->url('https://clevertipp.com')
                ->target('_blank'),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.cards', __('Cards'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
