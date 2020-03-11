<?php

namespace App\Providers;

use App\User;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

        \App\Projects::class => \App\Policies\ProjectsPolicy::class,
        \App\Departments::class => \App\Policies\AdminPolicy::class,
        \App\Status::class => \App\Policies\AdminPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-projects', function ($user) {
            return $user->type['id'] == 3;
        });

        //
    }
}
