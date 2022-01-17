<?php

use App\Http\Controllers\GalleryController;
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


Route::get('/', [GalleryController::class, 'index'], function () {
    return view('gallery');
})->name('gallery');

Route::get('/playlist/{id}', [GalleryController::class, 'open'])->name('showplaylist');
    
Route::group(
    [
        'middleware' => 'auth'
    ], function () {
        
        Route::get('/create', [GalleryController::class, 'create'])->name('playlistcreate');
        Route::post('/create', [GalleryController::class, 'prefill'])->name('playlistAutocompleteSubmit');

        Route::get('/create/autocomplete', [GalleryController::class, 'showPrefill'])->name('playlistAutocomplete');
        Route::post('/create/submit', [GalleryController::class, 'store'])->name('playlistcreateSubmit'); 


            Route::group(
                [
                    'prefix' => 'playlist'
                ], function () {
                
                Route::get('/{id}/update', [GalleryController::class, 'edit'])->name('updateplaylist');
                Route::post('/{id}/update/submit', [GalleryController::class, 'update'])->name('updatesubmit');
                Route::get('/{id}/delete', [GalleryController::class, 'delete'])->name('deleteplaylist');


            });
});

require __DIR__.'/auth.php';


