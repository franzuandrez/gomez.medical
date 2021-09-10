<?php

namespace App\Providers;

use App\Repositories\v1\Interfaces\StockRepositoryInterface;
use App\Repositories\v1\StockRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        //
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);

    }
}
