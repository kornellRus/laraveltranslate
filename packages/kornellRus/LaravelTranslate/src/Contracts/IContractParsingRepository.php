<?php
namespace KornellRus\LaravelTranslate\Contracts;

interface IContractParsingRepository
{

    public function parse(array $fields, string $fields_string);

}
