<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TicketRepositoryInterface
{
    public function paginateWithFilters(array $filters): LengthAwarePaginator;
    public function create(array $data): Ticket;
}
