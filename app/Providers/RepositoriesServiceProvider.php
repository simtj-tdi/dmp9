<?php

namespace App\Providers;

use App\Repositories\FaqRepository;
use App\Repositories\FaqRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
    }
}
