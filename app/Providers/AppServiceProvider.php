<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
    public function boot(){
        Gate::define('admin', function(User $user){
            return $user->role == 'admin';
        });

        Gate::define('petugas', function(User $user){
            return $user->role == 'petugas';
        });
        
        Gate::define('rakyat', function(User $user){
            return $user->role == 'rakyat';
        });

        // paginate
        Paginator::useBootstrapFive();
    }

}
