<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Nette\Utils\Paginator;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        // Custom Blade directives for roles & permissions
        Blade::if('role', function (string $role) {
            return auth()->check() && auth()->user()->hasRole($role);
        });

        Blade::if('anyrole', function (string $roles) {
            return auth()->check() && auth()->user()->hasAnyRole(explode(',', $roles));
        });

        Blade::if('permission', function (string $permission) {
            return auth()->check() && auth()->user()->hasPermission($permission);
        });

    }
}
