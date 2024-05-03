<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\View;

class Combination3Layout extends View
{
    /**
     * Combination3Layout constructor.
     */
    public function __construct()
    {   
        parent::__construct('components.combinations3', [
            'combinations3' => 'combinations3',
        ]);
    }

    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'combinations3';
}
