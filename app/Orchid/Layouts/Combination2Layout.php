<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\View;

class Combination2Layout extends View
{
    /**
     * Combination2Layout constructor.
     */
    public function __construct()
    {   
        parent::__construct('components.combinations2', [
            'combinations2' => 'combinations2',
        ]);
    }

    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'combinations2';
}
