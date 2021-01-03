<?php

namespace App\Providers;

use App\Repository\Eloquent\{CategoryRepository,
    ClientRepository,
    OrderEvaluationRepositoryRepository,
    OrderRepository,
    ProductRepository,
    TenantRepository,
    TableRepository};

use App\Repository\Contract\{CategoryRepositoryInterface,
    ClientRepositoryInterface,
    OrderEvaluationRepositoryInterface,
    OrderRepositoryInterface,
    ProductRepositoryInterface,
    TenantRepositoryInterface,
    TableRepositoryInterface};

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
        $this->app->bind(
            TenantRepositoryInterface::class,
            TenantRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            TableRepositoryInterface::class,
            TableRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->bind(
            OrderEvaluationRepositoryInterface::class,
            OrderEvaluationRepositoryRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
