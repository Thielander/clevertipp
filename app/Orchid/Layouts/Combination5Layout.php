<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\View;

class Combination5Layout extends View
{
    /**
     * Combination5Layout constructor.
     */
    public function __construct()
    {   
        parent::__construct('components.combinations5', [
            'combinations5' => 'combinations5',
        ]);
    }

    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'combinations5';
}
