<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use PDOException;
use Exception;
use DB;

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
        try {
            DB::connection()
                ->getPdo();
            Paginator::useBootstrap();
        } catch (Exception $e) {
            abort($e instanceof PDOException ? 500 : 503);
        }
    }
}
