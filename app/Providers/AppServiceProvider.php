<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Infrastructure\User;
use App\Infrastructure\Transaction;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        User\Factory\UserFactoryInterface::class => User\Factory\UserFactory::class,
        User\Repository\UserRepositoryInterface::class => User\Repository\UserRepository::class,
        Transaction\Repository\TransactionRepositoryInterface::class => Transaction\Repository\TransactionRepository::class,
        Transaction\Factory\TransactionFactoryInterface::class => Transaction\Factory\TransactionFactory::class
    ];

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
        Schema::defaultStringLength(191);
    }
}
