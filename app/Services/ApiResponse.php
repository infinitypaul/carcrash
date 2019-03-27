<?php

/**
 * Created by PhpStorm.
 * User: infinitypaul
 * Date: 27/03/2019
 * Time: 10:27 PM
 */

namespace App\Service;


class ApiResponse
{
    private $isSuccessfulResponse = false;
    private $statusCode;
    private $responseCode = "00";
    private $responseMessage;
    private $responseData;
    private $requiresValidation = false;


    public function getStatusCode(){
        return $this->statusCode;
    }

    public function getResponseCode(){
        return $this->responseCode;
    }

    public function requiresValidation(){
        return $this->requiresValidation;
    }

    public function getResponseMessage(){
        return $this->responseMessage;
    }

    public function getResponseData(){
        return $this->responseData;
    }

    public static function parseResponse($response){
        $resp = new ApiResponse();
        $resp->statusCode = $response->getStatusCode();
        if($resp->statusCode < 500){
            $responseBodyAsString  = $response->getBody();
            $data = json_decode($responseBodyAsString, true);
            if(isset($data['data']['responseCode'])){
                $resp->responseCode = $data['data']['responseCode'];
            }
            if(isset($data['data']['responsecode'])){
                $resp->responseCode = $data['data']['responsecode'];
            }
            if(isset($resp->responseCode) && $resp->statusCode === 01){
                $resp->requiresValidation = true;
            }
            if($resp->statusCode === 200 && ($resp->responseCode === "00" || $resp->responseCode === "0" || $resp->responseCode === "02")){
                $resp->isSuccessfulResponse = true;
            }

            $resp->responseData = $data;

            if(isset($data['Message'])){
                $resp->responseMessage = $data['Message'];
            }
        }

        return $resp;
    }

    public static function parseErrorResponse($response){
        $resp = new ApiResponse();
        $resp->statusCode = $response->getStatusCode();
        if($resp->statusCode < 500){
            $responseBodyAsString = $response->getBody()->getContents();
            $data = json_decode($responseBodyAsString, true);
            if(isset($data['data']['responseCode'])){
                $resp->responseCode = $data['data']['responseCode'];
            }
            if(isset($data['data']['responsecode'])){
                $resp->responseCode = $data['data']['responsecode'];
            }
            if(isset($resp->responseCode) && $resp->statusCode === 01){
                $resp->requiresValidation = true;
            }
            $resp->responseData = $data;
            return $resp;
        }

    }
}
