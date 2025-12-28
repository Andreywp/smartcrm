<?php

namespace App\Services\Ticket;

use App\Enums\TicketStatus;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Support\Carbon;

class TicketService implements TicketServiceInterface
{
    public function create(array $data): Ticket
    {
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
            'status' => TicketStatus::NEW->value,
        ]);

        if (!empty($data['files'])) {
            foreach ($data['files'] as $file) {
                $ticket
                    ->addMedia($file)
                    ->toMediaCollection('attachments');
            }
        }

        return $ticket;
    }

    public function updateStatus(Ticket $ticket, string $status): Ticket
    {
        $ticket->status = $status;

        if ($status === TicketStatus::DONE->value) {
            $ticket->response_at = Carbon::now();
        }

        $ticket->save();

        return $ticket;
    }
}

