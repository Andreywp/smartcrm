<?php

namespace App\Services\Ticket;

use App\Models\Ticket;

interface TicketServiceInterface
{
    public function create(array $data): Ticket;
    public function updateStatus(Ticket $ticket, string $status): Ticket;
}
