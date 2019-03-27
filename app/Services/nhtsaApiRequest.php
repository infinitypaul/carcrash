<?php


namespace App\Services;

use App\Service\ApiResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class nhtsaApiRequest
{
    private $data = array();
    private $url;
    private static $method = 'GET';

    function __construct($url)
    {
        $this->url = $url;
    }

    public function addBody($name, $value){
        $this->data[$name] = $value;
        return $this;
    }



    public static function addMethod($method){
        return self::$method = $method;
    }

    public function makeRequest(){
        $client = new Client(['timeout' => 60]);
        try{
            $response = $client->request(self::$method, $this->url, [
                'form_params' => $this->data,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);
            return ApiResponse::parseResponse($response);
        } catch (RequestException $e){
            $response = $e->getResponse();
            return ApiResponse::parseErrorResponse($response);

        }
    }
}
