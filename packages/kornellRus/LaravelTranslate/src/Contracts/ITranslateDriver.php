<?php
namespace KornellRus\LaravelTranslate\Contracts;

interface ITranslateDriver
{

    public function translate(string $source, string $to, string $from);
}
