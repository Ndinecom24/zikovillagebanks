<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // ── Super-admin bypass ─────────────────────────────────────────
        // If the user is a super-admin, every gate check returns true.
        Gate::before(function ($user) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        // ── Register a Gate for every permission in the config ─────────
        $groups = config('chilolezo.permissions', []);

        foreach ($groups as $group) {
            foreach ($group['items'] ?? [] as $slug => $description) {
                Gate::define($slug, function ($user) use ($slug) {
                    return $user->hasPermission($slug);
                });
            }
        }
    }
}
