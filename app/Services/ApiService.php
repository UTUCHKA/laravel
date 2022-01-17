<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class ApiService
{

public function api(string $url){
        $client = new Client();
        try{
            $res = $client->request('post', $url);
        } catch(RequestException $e){
            return new Exception('Альбом или исполнитель не найдены');
        }
        
        return json_decode($res->getbody());
    }  
}