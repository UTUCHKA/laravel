<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class ApiService
{

public function api(Request $request){
        $client = new Client();
        $album = $request->album;
        $artist = $request->artist;
        try{
            $res = $client->request('post', 'http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key='.env('API_KEY_LASTFM').'&artist=' . $artist . '&album=' . $album . '&format=json');
        } catch(RequestException $e){
            return new Exception('Альбом или исполнитель не найдены');
        }
        
        return $res->getbody();
    }  
}