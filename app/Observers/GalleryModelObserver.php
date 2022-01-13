<?php

namespace App\Observers;
use App\Models\GalleryModel;
use Illuminate\Support\Facades\Log;

class GalleryModelObserver
{
    public function created(GalleryModel $data)
    {
        Log::channel('gallerycreatelog')->info('Playlist created.id='.$data->id.' album: '. $data->album.' artist: '.$data->artist.' img: '.$data->img.' info: '.$data->info);
    }

    public function updated(GalleryModel $data)
    {
        Log::channel('galleryupdatelog')->info('Gallery updated. album was: '.$data->getOriginal('album').' replaced to: '.$data->album.' artist was: '.$data->getOriginal('artist').' replaced to: '.$data->artist.' img was: '.$data->getOriginal('img').' replaced to: '.$data->img.' info was: '.$data->getOriginal('info').' replaced to: '.$data->info);
    }

    public function deleted(GalleryModel $data)
    {
        Log::channel('gallerydeletelog')->info('Playlist deleted. id: '.$data->id);
    }

}
