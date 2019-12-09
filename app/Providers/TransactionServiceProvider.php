<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\TransactionRepository;
use App\Repository\Interfaces\TransactionRepositoryInterface;

class TransactionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TransactionRepositoryInterface::class, 
            TransactionRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
