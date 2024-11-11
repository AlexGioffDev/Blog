<?php

namespace App\Providers;

use App\Models\User;
use App\UserRole;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Can Access
        Gate::define("can-access", function (User $user) {
            return in_array($user->role, [UserRole::ADMIN, UserRole::MOD]);
        });

        Gate::define("only-admin", function (User $user) {
            return $user->role === UserRole::ADMIN;
        });

        Gate::define('delete-user', function (User $user, User $targetUser) {
            return $user->role === UserRole::ADMIN &&
                $targetUser->role !== UserRole::ADMIN &&
                $user->id !== $targetUser->id;
        });
    }
}
