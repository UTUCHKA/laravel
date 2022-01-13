<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'artist' => 'required|min:1|max:255',
            'album' => 'required|min:1|max:255',
            'img' => 'required',
            'info' => 'required|min:1'
        ];
    }
    
    public function messages(){
        return [
            'artist.required' => 'Поле исполнителя является обязательным',
            'album.required' => 'Поле альбома является обязательным',
            'img.required' => 'Загрузите изображение',
            'info.required' => 'Поле информации является обязательным',
        ];
    }
}
