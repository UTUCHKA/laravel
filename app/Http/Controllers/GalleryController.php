<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\Models\GalleryModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GalleryController extends Controller
{

    public function add(GalleryRequest $request)
    {

        GalleryModel::create([
            'user_id' => auth()->user()->id,
            'artist' => $request->artist,
            'album' => $request->album,
            'img' => $request->img,
            'info' =>  $this->stripLinks($request->info),
        ]);

        return redirect()->route('gallery')->with('success', "Альбом был добавлен");
    }

    public function api(Request $request){
        $client = new Client();
        $album = $request->album;
        $artist = $request->artist;
        try{
            $res = $client->request('post', 'http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key='.env('API_KEY_LASTFM').'&artist=' . $artist . '&album=' . $album . '&format=json');
        } catch(RequestException $e){
            return redirect()->route('playlistAutocomplete')->with('notFound', "Альбом или исолнитель не найдены");
        }

        $res=$res->getbody();
        $data=$this->convertFromJson($res);
        return view('playlistcreate', ['data' => $data]);
    }  

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

    public function index(){
        return view('gallery', ['playlists' => GalleryModel::orderBy('id', 'desc')->paginate(6)]);
    }

    public function open($id){
        return view('showplaylist', ['data' => GalleryModel::findOrFail($id)]);
    }

    public function update($id){
        return view('updateplaylist', ['data' => GalleryModel::findOrFail($id)]);
    }

    public function updateSubmit($id, GalleryRequest $request)
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

    public function stripLinks($info){
        return preg_replace('#<a.*?>.*?</a>#i', '',$info);
    }

}
