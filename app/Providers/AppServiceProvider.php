<?php

namespace App\Providers;

use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Repositories\Eloquent\EloquentEventRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Eloquent\EloquentBookingRepository;
//use Illuminate\Support\ServiceProvider;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventRepositoryInterface::class, EloquentEventRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, EloquentBookingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}