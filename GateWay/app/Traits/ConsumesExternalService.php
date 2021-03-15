<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{
   
    public $baseUri;

    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams= [] , $headers = []){

        //Create a instance of client from guzzle
        $client = new Client([
            'base_uri' => $this->baseuri,
        ]);

        //adding the secret key of the serivces of user and todo to the header 
        //so that validation become easy

        if(isset($this->secret)){
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $requestUrl , ['form_params' => $formParams ,'headers' => $headers]);

        return $response->getBody()->getContents();
    }
}

