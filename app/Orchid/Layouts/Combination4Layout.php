<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\View;

class Combination4Layout extends View
{
    /**
     * Combination3Layout constructor.
     */
    public function __construct()
    {   
        parent::__construct('components.combinations4', [
            'combinations4' => 'combinations4',
        ]);
    }

    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'combinations4';
}
