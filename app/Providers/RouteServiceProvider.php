<?php

namespace App\Providers;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        
        Route::bind("id", function ($value) {
            $id = Hashids::decode($value);
            return  $id[0];
        });

        Route::bind("ID", function ($value) {
            $id = Hashids::decode($value);
            return  $id[0];
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        // $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapUsersRoutes();

        $this->mapCongressmanRoutes();

        $this->mapRootRoutes();

        $this->mapAdminRoutes();
        
        $this->mapRevisorsRoutes();

        $this->mapFinancesRoutes();

        $this->mapStaffRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapUsersRoutes()
    {
        Route::prefix('app/usuarios')
            ->name('app.users.')
            ->middleware(['web','auth','verified','hasProfiles'])
            ->namespace($this->namespace)
            ->group(base_path('routes/users.php'));
    }

    protected function mapCongressmanRoutes()
    {
        Route::prefix('app/congresistas')
            ->name('app.congressman.')
            ->middleware(['web','auth','verified','hasProfiles'])
            ->namespace($this->namespace)
            ->group(base_path('routes/congressman.php'));
    }

    protected function mapRootRoutes()
    {
        Route::prefix('app/root')
            ->name('app.root.')
            ->middleware(['web','auth','verified','hasProfiles'])
            ->namespace($this->namespace)
            ->group(base_path('routes/root.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('app/admin')
            ->name('app.admin.')
            ->middleware(['web','auth','verified','hasProfiles'])
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    protected function mapRevisorsRoutes()
    {
        Route::prefix('app/revisores')
            ->name('app.revisors.')
            ->middleware(['web','auth','verified','hasProfiles'])
            ->namespace($this->namespace)
            ->group(base_path('routes/revisors.php'));
    }

    protected function mapFinancesRoutes()
    {
        Route::prefix('app/finanzas')
            ->name('app.finances.')
            ->middleware(['web','auth','verified','hasProfiles'])
            ->namespace($this->namespace)
            ->group(base_path('routes/finances.php'));
    }

    protected function mapStaffRoutes()
    {
        Route::prefix('app/staff')
            ->name('app.staff.')
            ->middleware(['web','auth','verified','hasProfiles'])
            ->namespace($this->namespace)
            ->group(base_path('routes/staff.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    // protected function mapApiRoutes()
    // {
    //     Route::prefix('api')
    //          ->middleware('api')
    //          ->namespace($this->namespace)
    //          ->group(base_path('routes/api.php'));
    // }
}
