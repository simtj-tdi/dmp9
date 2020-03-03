<?php

namespace App\Providers;

use App\Repositories\FaqRepository;
use App\Repositories\FaqRepositoryInterface;
use App\Repositories\QuestionRepository;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
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
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
