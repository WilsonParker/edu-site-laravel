<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
    }

    public function map()
    {
        $this->buildWeb();
        $this->buildWebTest();
    }

    private function buildWeb()
    {
        Route::domain(config('domains.root_domain'))
            ->namespace($this->namespace . '\\Web')
            ->middleware('web')
            ->group(base_path('routes/web.php'));
    }

    private function buildWebTest()
    {
        Route::
        //domain(config('domains.domain.test'))
            namespace($this->namespace . '\\Web')
            ->middleware('web')
            ->group(base_path('routes/test.php'));
    }

    private function buildAdmin()
    {
        Route::domain(config('domains.domain.admin'))
            ->prefix('admin')
            ->middleware('admin')
            ->namespace($this->namespace . '\\Admin')
            ->group(base_path('routes/admin.php'));

    }

    private function buildApi()
    {
        Route::domain(config('domains.domain.api'))
            ->prefix('api')
            ->middleware('api')
            ->namespace($this->namespace . '\\Api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
