<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\View;

class EurozahlenCardLayout extends View
{
    /**
     * EurozahlenCardLayout constructor.
     */
    public function __construct()
    {   
    
        parent::__construct('components.eurozahlen-cards', [
            'title' => 'title',
            'description' => 'description',
            'eurozahlen' => 'eurozahlen',
            'eurozahlenCombination' => 'eurozahlenCombination',
        ]);
    }

    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'eurozahlenCombination';
}
