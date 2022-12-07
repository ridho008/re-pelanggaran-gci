<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use PDOException;
use Exception;
use DB;
// use Illuminate\Support\Facades\Schema;

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
            Paginator::useBootstrap();
            // Schema::defaultStringLength(191);
        // try {
        //     DB::connection()
        //         ->getPdo();
        // } catch (Exception $e) {
        //     abort($e instanceof PDOException ? 500 : 503);
        // }
    }
}
