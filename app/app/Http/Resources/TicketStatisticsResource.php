<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketStatisticsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'today' => $this['today'] ?? 0,
            'week' => $this['week'] ?? 0,
            'month' => $this['month'] ?? 0,
        ];
    }
}

