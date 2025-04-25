<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

                // my route de redirection
                // Route::middleware('web')
                // ->group(function () {
                //     Route::get('/dashboard', function () {
                //         if (auth()->user()->role === 'admin') {
                //             return redirect()->route('admin.dashboard');
                //         }

                //         // Sinon, rediriger vers la page d'accueil ou autre
                //         return redirect('/');
                //     })->middleware(['auth'])->name('dashboard');
                // });

                Route::middleware('web')->group(function () {
                    Route::get('/dashboard', function () {
                        if (auth()->user()->role === 'admin') {
                            return redirect()->route('admin.dashboard');
                        }

                        // sinon
                        return redirect('/');
                    })->middleware(['auth'])->name('dashboard');
                });


        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
