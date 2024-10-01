<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin_kepalasekolah', function (User $user) {
            return $user->role == 'admin' || $user->role == 'kepala_sekolah' || $user->role == 'kepala_perpus';
        });

        Gate::define('admin', function (User $user) {
            return $user->role == 'admin';
        });

        Gate::define('master', function (User $user) {
            return $user->role == 'admin' || $user->role == 'petugas' || $user->role == 'kepala_sekolah' || $user->role == 'kepala_perpus';
        });
    }
}
