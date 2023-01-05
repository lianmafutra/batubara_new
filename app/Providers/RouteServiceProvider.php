<?php

namespace App\Providers;


use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Vinkla\Hashids\Facades\Hashids;

class RouteServiceProvider extends ServiceProvider
{
   /**
    * The path to the "home" route for your application.
    *
    * This is used by Laravel authentication to redirect users after login.
    *
    * @var string
    */
   public const HOME = '/home';

   /**
    * Define your route model bindings, pattern filters, etc.
    *
    * @return void
    */
   public function boot()
   {
      $this->configureRateLimiting();

      $this->routes(function () {
         Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));

         Route::middleware('web')
            ->group(base_path('routes/web.php'));

         Route::middleware('web')
            ->group(base_path('routes/app.php'));
      });

      Route::bind('mobil', function ($value) {
         return Hashids::decode($value)[0];
      });
      Route::bind('supir', function ($value) {
         return Hashid::decode($value)[0];
      });

      Route::bind('pemilik', function ($value) {
         return Hashid::decode($value)[0];
      });

   
      Route::bind('transportir', function ($value) {
         return Hashids::decode($value)[0];
      });
      Route::bind('harga', function ($value) {
         return Hashids::decode($value)[0];
      });
      Route::bind('tujuan', function ($value) {
         return Hashids::decode($value)[0];
      });
   }

   /**
    * Configure the rate limiters for the application.
    *
    * @return void
    */
   protected function configureRateLimiting()
   {
      RateLimiter::for('api', function (Request $request) {
         return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
      });
   }
}
