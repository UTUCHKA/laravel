<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\Models\GalleryModel;
use App\Services\ApiService;
use App\Services\AlbumService;
use Exception;

class GalleryController extends Controller
{

    public function store(GalleryRequest $request)
    {

        GalleryModel::create([
            'user_id' => auth()->user()->id,
            'artist' => $request->artist,
            'album' => $request->album,
            'img' => $request->img,
            'info' => preg_replace('#<a.*?>.*?</a>#i', '', $request->info),
        ]);

        return redirect()->route('gallery')->with('success', "Альбом был добавлен");
    }

    public function create(){
        return view('playlistcreate');
    }

    public function prefill(Request $request){
        $htmlbuildquery = array(
            'method'=>'album.getinfo',
            'api_key'=>config('apiconfig.apiKey'),
            'artist'=>$request->artist,
            'album'=>$request->album,
            'format'=>'json'
        );
        $url = config('apiconfig.url') . "?" . http_build_query($htmlbuildquery);
        $data= (new ApiService)->api($url);
        if($data instanceof Exception){

            return redirect()->route('playlistAutocomplete')->with('notFound', "Альбом или исполнитель не найдены"); 
        }
        $res= (new AlbumService)->album($data);

        return view('playlistcreate', ['data' => $res]);
    }

    public function showPrefill(){
        return view('playlistAutocomplete');
    }

    public function index(){
        return view('gallery', ['playlists' => GalleryModel::orderBy('id', 'desc')->paginate(6)]);
    }

    public function open($id){
        return view('showplaylist', ['data' => GalleryModel::findOrFail($id)]);
    }

    public function edit($id){
        return view('updateplaylist', ['data' => GalleryModel::findOrFail($id)]);
    }

    public function update($id, GalleryRequest $request)
    {

        GalleryModel::find($id)->update([
            'user_id' => auth()->user()->id,
            'artist' => $request->artist,
            'album' => $request->album,
            'img' => $request->img,
            'info' => $request->info,
        ]);
        

        return redirect()->route('gallery', $id)->with('success', "Альбом был отредактирован");
    }

    public function delete($id)
    {
        $delete = GalleryModel::find($id);
        $delete->delete();
        return redirect()->route('gallery', $id)->with('success', "Альбом был Удален");
    }
}
