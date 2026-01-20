<?php
namespace App\DTO\Ticket;

use App\Enums\TicketStatus;

class UpdateTicketDto
{
    public function __construct(
        public readonly TicketStatus $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: TicketStatus::from($data['status']),
        );
    }


}

