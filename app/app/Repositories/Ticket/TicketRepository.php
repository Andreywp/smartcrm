<?php

namespace App\Repositories\Ticket;

use App\Enums\TicketStatus;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TicketRepository implements TicketRepositoryInterface
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


    public function create(array $data): Ticket
    {
        return DB::transaction(function () use ($data) {

            $customer = Customer::firstOrCreate(
                ['phone' => $data['phone']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'] ?? null,
                ]
            );

            $ticket = Ticket::create([
                'customer_id' => $customer->id,
                'subject' => $data['subject'],
                'message' => $data['message'],
                'status' => TicketStatus::NEW,
            ]);

            if (!empty($data['files'])) {
                foreach ($data['files'] as $file) {
                    $ticket
                        ->addMedia($file)
                        ->toMediaCollection('attachments');
                }
            }

            return $ticket;
        });
    }

}

