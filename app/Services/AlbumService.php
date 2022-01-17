<?php

namespace App\Services;
use App\Models\GalleryModel;

class AlbumService 
{

public function album($res){
    
        $playlist = new GalleryModel();
        $playlist->img = "https://tipsmake.com/data1/thumbs/how-to-extract-img-files-in-windows-10-thumb-bzxI4IDgg.jpg";
        if(!empty($res->album->image[3]->{'#text'})){
            $playlist->img = $res->album->image[3]->{'#text'};
        }
        $playlist->artist = $res->album->artist;
        $playlist->album = $res->album->name;
        $playlist->info = "";
        if(isset($res->album->wiki->content)){
            $playlist->info =$res->album->wiki->content;
        }
        return $playlist;
    }
}