<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ProjectsRepositoryInterface;
use App\Repositories\ProjectsRepository;
use App\Repositories\TasksRepository;
use App\Repositories\TasksRepositoryInterface;
use App\Repositories\DepartmentsRepository;
use App\Repositories\DepartmentsRepositoryInterface;
use App\Repositories\AdminsRepository;
use App\Repositories\AdminsRepositoryInterface;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProjectsRepositoryInterface::class,
            ProjectsRepository::class
        );

        $this->app->bind(
            TasksRepositoryInterface::class,
            TasksRepository::class
        );

        $this->app->bind(
            DepartmentsRepositoryInterface::class,
            DepartmentsRepository::class
        );

        $this->app->bind(
            AdminsRepositoryInterface::class,
            AdminsRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
