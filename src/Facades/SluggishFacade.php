<?php

namespace LaravelPulse\Sluggish\Facades;

use Illuminate\Support\Facades\Facade;

class SluggishFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Sluggish';
    }
}
