<?php
namespace KornellRus\LaravelTranslate\Services;

use \KornellRus\LaravelTranslate\Contracts\IContractParsingRepository as Repository;


class GoogleService
{
    protected $max_length = 5000;
    protected $length = 4999;
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    protected function fieldsString($fields)
    {
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key.'='.$value.'&';
        }

        return rtrim($fields_string, '&');
    }

    protected function requestTranslation($from, $to, $item)
    {
        if(empty($from)) {
            $from = config('laraveltranslate.lang.from');
        }
        if(empty($to)) {
            $to = config('laraveltranslate.lang.to');
        }
        $fields = [
            'sl' => urlencode($from),
            'tl' => urlencode($to),
            'q'  => urlencode($item),
        ];

        if (strlen($fields['q']) >= $this->max_length) {
            $fields['q'] = substr( $fields['q'], 0, $this->length);
        }

        $fields_string = $this->fieldsString($fields);

        $content = $this->repository->parse($fields, $fields_string);

        return $content;

    }

    public function translate($from, $to, $item) {

        $content = $this->requestTranslation($from, $to, $item);

            return $this->getSentencesFromJSON($content);
    }

    protected function getSentencesFromJSON($json)
    {
        if (empty($json)) {
            return '';
        }
        $arr = json_decode($json, true);
        $sentences = '';

        if (isset($arr['sentences'])) {
            foreach ($arr['sentences'] as $s) {
                $sentences .= isset($s['trans']) ? $s['trans'] : '';
            }
        }

        return $sentences;
    }
}
