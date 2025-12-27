<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'customer_id',
        'subject',
        'message',
        'status',
        'response_at',
    ];

    protected $casts = [
        'response_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function isNew(): bool
    {
        return $this->status === TicketStatus::NEW->value;
    }
}

