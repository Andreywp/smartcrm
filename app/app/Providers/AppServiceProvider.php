<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Ticket\EloquentTicketRepository;
use App\Repositories\Ticket\TicketRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TicketRepositoryInterface::class,
            EloquentTicketRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
