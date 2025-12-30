<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Ticket extends Model implements HasMedia
{
    use HasFactory, HasFactory, InteractsWithMedia;
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments')
            ->useDisk('public');
    }

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeThisWeek(Builder $query): Builder
    {
        return $query->whereBetween(
            'created_at',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        );
    }

    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('created_at', Carbon::now()->month);
    }


}

