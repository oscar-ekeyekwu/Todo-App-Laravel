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

        'App\Projects' => 'App\Policies\ProjectsPolicy',
        'App\Departments' => 'App\Policies\AdminPolicy',
        'App\Status' => 'App\Policies\AdminPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gate::define('projects.manage-projects', 'App\Policies\DeptHeadPolicy@view');

        //
    }
}
