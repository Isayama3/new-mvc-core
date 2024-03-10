<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public const HOME = '/home';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();

        $this->mapAdminApiRoutes();
        $this->mapAdminWebRoutes();
        $this->mapAdminAuthRoutes();

        $this->mapClientApiRoutes();
        $this->mapClientAuthRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapAdminWebRoutes()
    {
        Route::middleware(['web', 'auth:admin', 'localeSessionRedirect','localizationRedirect', 'localeViewPath'])
            ->prefix(LaravelLocalization::setLocale().'/admin')
            ->namespace($this->namespace . '\Admin\Web')
            ->name('admin.')
            ->group(base_path('routes/admin/web/admin.php'));
    }

    protected function mapAdminApiRoutes()
    {
        Route::prefix('admin')
            ->namespace($this->namespace . '\Admin\Api')
            ->prefix('admin')
            ->name('api.v1.admin.')
            ->group(base_path('routes/admin/web/admin.php'));
    }

    protected function mapAdminAuthRoutes()
    {
        // Route::middleware(['guest:admin-api'])->group(base_path('routes/admin/api/auth.php'));

        Route::middleware(['web', 'guest:admin', 'localizationRedirect', 'localeViewPath'])
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/admin/web/auth.php'));
    }

    protected function mapClientApiRoutes()
    {
        Route::prefix('client')
            ->namespace($this->namespace . '\Client\Api')
            ->prefix('api/v1/')
            ->name('api.v1.client.')
            ->middleware(['localizationRedirect', 'localeViewPath'])
            ->group(base_path('routes/client/api/client.php'));
    }

    protected function mapClientAuthRoutes()
    {
        Route::prefix('api/v1/')
            ->middleware(['guest:client-api', 'localizationRedirect', 'localeViewPath'])
            ->namespace($this->namespace . '\Client\Api\Auth')
            ->name('api.v1.client.')
            ->group(base_path('routes/client/api/auth.php'));
    }
}
