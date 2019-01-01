<?php

namespace Ken\FlashMe\Facades;

use Illuminate\Support\Facades\Facade;

class FlashMe extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flashMe';
    }
}
