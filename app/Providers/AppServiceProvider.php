<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\KendaraanRepository;
use App\Repositories\KendaraanRepositoryInterface;

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
        $this->app->bind(KendaraanRepositoryInterface::class, KendaraanRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
