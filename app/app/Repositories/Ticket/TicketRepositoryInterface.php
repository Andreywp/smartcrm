<?php

namespace App\Repositories\Ticket;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TicketRepositoryInterface
{
    public function paginateWithFilters(array $filters): LengthAwarePaginator;
}
