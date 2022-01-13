<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\GalleryModelObserver;
use App\Models\GalleryModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        GalleryModel::observe(new GalleryModelObserver);
    }
}
