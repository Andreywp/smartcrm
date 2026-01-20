<?php

namespace App\Services\Ticket;

use App\Enums\TicketStatus;
use App\Models\Customer;
use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Support\Carbon;

class TicketService implements TicketServiceInterface
{
//    private TicketRepositoryInterface $ticketRepository;
//
//    public function __construct(TicketRepositoryInterface $ticketRepository)
//    {
//        $this->ticketRepository = $ticketRepository;
//    }
    public function __construct(
        private TicketRepositoryInterface $ticketRepository
    ) {}

    public function create(array $data): Ticket
    {
        return $this->ticketRepository->create($data);
    }

    public function updateStatus(Ticket $ticket, string $status): Ticket
    {
        $ticket->status = TicketStatus::from($status);

        if ($ticket->status === TicketStatus::DONE) {
            $ticket->response_at = Carbon::now();
        }

        $ticket->save();

        return $ticket;
    }
}

