<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketStatisticsResource;
use App\Models\Ticket;
use App\Services\Ticket\TicketServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function store(
        StoreTicketRequest $request,
        TicketServiceInterface $ticketService
    ): TicketResource {
        $ticket = $ticketService->create(
            $request->validated()
        );

        return new TicketResource(
            $ticket->load(['customer', 'media'])
        );
    }

    public function statistics(): JsonResponse
    {
        return (new TicketStatisticsResource([
            'today' => Ticket::today()->count(),
            'week' => Ticket::thisWeek()->count(),
            'month' => Ticket::thisMonth()->count(),
        ]))->response();
    }
}
