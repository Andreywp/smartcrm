<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentTicketRepository implements TicketRepositoryInterface
{
    public function paginateWithFilters(array $filters): LengthAwarePaginator
    {
        $query = Ticket::query()
            ->with('customer')
            ->orderByDesc('created_at');

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['email'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('email', 'like', '%' . $filters['email'] . '%');
            });
        }

        if (!empty($filters['phone'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('phone', 'like', '%' . $filters['phone'] . '%');
            });
        }

        return $query->paginate(2)->withQueryString();
    }
}

