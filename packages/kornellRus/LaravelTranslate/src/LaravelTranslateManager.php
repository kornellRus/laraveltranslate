<?php


namespace KornellRus\LaravelTranslate;

use Illuminate\Support\Manager;
use KornellRus\LaravelTranslate\Contracts\ITranslateDriver;
use KornellRus\LaravelTranslate\Drivers\Google;

class LaravelTranslateManager extends Manager {

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'google';
    }

    /**
     * @return ITranslateDriver
     */
    public function createGoogleDriver(): ITranslateDriver
    {
        return new Google;
    }
}
