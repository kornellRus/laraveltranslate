<?php

namespace KornellRus\LaravelTranslate\Facades;

use Illuminate\Support\Facades\Facade;

class Translate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */


    protected static function getFacadeAccessor(): string
    {
        return 'TranslateManager';
    }
}
