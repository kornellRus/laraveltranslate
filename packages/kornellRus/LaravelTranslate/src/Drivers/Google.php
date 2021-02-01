<?php
namespace KornellRus\LaravelTranslate\Drivers;

use KornellRus\LaravelTranslate\Contracts\ITranslateDriver;
use KornellRus\LaravelTranslate\LaravelTranslate;
use KornellRus\LaravelTranslate\Repositories\GoogleRepository;
use KornellRus\LaravelTranslate\Services\GoogleService;
use function PHPUnit\Framework\returnArgument;

class Google extends LaravelTranslate implements ITranslateDriver
{

    public function translate($text, $from='', $to='')
    {
        return (new GoogleService(app(GoogleRepository::class)))->translate($from, $to, $text);

        // TODO: Implement translate() method.
    }

}
