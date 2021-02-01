<?php
namespace KornellRus\LaravelTranslate\Repositories;

use KornellRus\LaravelTranslate\Contracts\IContractParsingRepository;

class GoogleRepository implements IContractParsingRepository
{

    protected $url = 'https://translate.google.com/translate_a/single?client=at&dt=t&dt=ld&dt=qca&dt=rm&dt=bd&dj=1&hl=uk-RU&ie=UTF-8&oe=UTF-8&inputm=2&otf=2&iid=1dd3b944-fa62-4b55-b330-74909a99969e';
    protected $attempts = 5;
    protected $i = 0;
    protected $success_code = 200;
    protected $sleep = 1500000;


    public function parse($fields, $fields_string)
    {
       $result =  $this->curlRequest($fields, $fields_string);

        if (false === $result['data'] || $this->success_code !== $result['code']) {
            if ($this->i >= $this->attempts) {
                return false;
            } else {
                usleep($this->sleep);
                return $this->curlRequest($fields, $fields_string);
            }
        } else {
            return $result['data'];
        }

        // TODO: Implement parse() method.
    }

    protected function curlRequest($fields, $fields_string)
    {
//        $proxy = ProxyHelper::getRandomProxyForSearch();
        $this->i++;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($ch, CURLOPT_USERAGENT, 'AndroidTranslate/5.3.0.RC02.130475354-53000263 5.1 phone TRANSLATE_OPM5_TEST_1');

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
          'code' =>$httpcode,
          'data' =>$result,
        ];

    }

}
