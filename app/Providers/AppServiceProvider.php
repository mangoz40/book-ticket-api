<?php

namespace App\Providers;

use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Repositories\Eloquent\EloquentEventRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Eloquent\EloquentBookingRepository;
use Illuminate\Support\ServiceProvider;

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
        //
    }
}