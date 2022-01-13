<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\Models\GalleryModel;
use App\Services\ApiService;
use App\Services\ConvertFromJsonService;
use Exception;

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

    public function prefill(Request $request){
        $data= (new ApiService)->api($request);
        if($data instanceof Exception){
            return redirect()->route('playlistAutocomplete')->with('notFound', "Альбом или исолнитель не найдены"); 
        }
        $res= (new ConvertFromJsonService)->convertFromJson($data);

        return view('playlistcreate', ['data' => $res]);
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

    public function stripLinks($info){
        return preg_replace('#<a.*?>.*?</a>#i', '',$info);
    }

}
