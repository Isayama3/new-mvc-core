<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        Route::middleware(['web'])
            ->prefix('admin')
            ->namespace($this->namespace . '\Admin')
            ->name('admin.')
            ->group(base_path('routes/admin/web/admin.php'));
    }

    protected function mapAdminApiRoutes()
    {
        Route::prefix('admin')
            ->namespace($this->namespace . '\Admin')
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/admin/web/admin.php'));
    }

    protected function mapAdminAuthRoutes()
    {
        // Route::middleware(['guest:admin-api'])->group(base_path('routes/admin/api/auth.php'));
        Route::middleware(['web', 'guest:admin'])->prefix('admin')->name('admin.')->group(base_path('routes/admin/web/auth.php'));
    }
}
