<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Ticket\EloquentTicketRepository;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Services\Ticket\TicketService;
use App\Services\Ticket\TicketServiceInterface;

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

        $this->app->bind(
            TicketServiceInterface::class,
            TicketService::class
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
