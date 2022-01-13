<?php

namespace App\Services;
use App\Models\GalleryModel;

class ConvertFromJsonService 
{

public function convertFromJson($res){

        $playlist = new GalleryModel();
        $decoded = json_decode($res);
        $playlist->img = "https://tipsmake.com/data1/thumbs/how-to-extract-img-files-in-windows-10-thumb-bzxI4IDgg.jpg";
        if(!empty($decoded->album->image[3]->{'#text'})){
            $playlist->img = $decoded->album->image[3]->{'#text'};
        }
        $playlist->artist = $decoded->album->artist;
        $playlist->album = $decoded->album->name;
        $playlist->info = "";
        if(isset($decoded->album->wiki->content)){
            $playlist->info =$decoded->album->wiki->content;
        }
        return $playlist;
    }
}