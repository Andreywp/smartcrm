<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Ticket\UpdateTicketDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Enums\TicketStatus;
use Carbon\Carbon;
use App\Repositories\Ticket\TicketRepositoryInterface;
class AdminTicketController extends Controller {

    public function __construct(
        private readonly TicketRepositoryInterface $ticketRepository
    ) {}

    public function index(Request $request)
    {
        $tickets = $this->ticketRepository->paginateWithFilters(
            $request->only([
                'status',
                'email',
                'phone',
                'date_from',
                'date_to',
            ])
        );

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['customer', 'media']);

        return view('admin.tickets.show', compact('ticket'));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
//        $request->validate([
//            'status' => ['required', 'string'],
//        ]);

//        if (
//            $ticket->status !== TicketStatus::DONE &&
//            $request->status === TicketStatus::DONE->value
//        ) {
//            $ticket->response_at = Carbon::now();
//        }

        $dto = UpdateTicketDto::fromArray($request->validated());

        $ticket->status = $dto->status;
        $ticket->save();

        return back();
    }



}
