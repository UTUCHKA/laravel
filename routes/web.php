<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'App\Http\Controllers\GalleryController@index', function () {
    return view('gallery');
})->name('gallery');

Route::group(
    [
        'prefix' => 'gallery'
    ], function () {

    Route::get('/playlist/{id}', 'App\Http\Controllers\GalleryController@open')->name('showplaylist');
    
    Route::group(
        [
            'middleware' => 'auth'
        ], function () {
            
            Route::get('/create', function () {
            return view('playlistcreate');
            })->name('playlistcreate');
    
            Route::get('/create/autocomplete', function () {
            return view('playlistAutocomplete');
            })->name('playlistAutocomplete');
        });
    Route::group(
        [
            'prefix' => 'playlist',
            'middleware' => 'auth'
        ], function () {

        
        Route::get('/{id}/update', 'App\Http\Controllers\GalleryController@edit')->name('updateplaylist');
        Route::get('/{id}/delete', 'App\Http\Controllers\GalleryController@delete')->name('deleteplaylist');
        Route::post('/{id}/update/submit', 'App\Http\Controllers\GalleryController@update')->name('updatesubmit');
        Route::post('/create/submit', 'App\Http\Controllers\GalleryController@add')->name('playlistcreateSubmit');
        Route::post('/create', 'App\Http\Controllers\GalleryController@prefill')->name('playlistAutocompleteSubmit');
    });
});

require __DIR__.'/auth.php';


