<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
{
    Model::preventLazyLoading(! $this->app->isProduction());

    Paginator::defaultView('pagination::bootstrap-3');

// Pendaftaran: paling banyak 5 kiriman per menit dari satu alamat IP
RateLimiter::for('pendaftaran', fn (Request $request) => Limit::perMinute(5)->by($request->ip()));

// Cek NIM: dibatasi supaya daftar NIM dan nama tidak mudah disedot lewat skrip
RateLimiter::for('cek-nim', fn (Request $request) => Limit::perMinute(10)->by($request->ip()));

}

}