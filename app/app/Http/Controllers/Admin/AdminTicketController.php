<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller {

    public function index(Request $request)
    {
        $tickets = Ticket::query()
            ->with('customer')
            ->when($request->filled('status'), fn ($q) =>
            $q->where('status', $request->status)
            )
            ->when($request->filled('email'), fn ($q) =>
            $q->whereHas('customer', fn ($c) =>
            $c->where('email', 'like', '%' . $request->email . '%')
            )
            )
            ->when($request->filled('phone'), fn ($q) =>
            $q->whereHas('customer', fn ($c) =>
            $c->where('phone', 'like', '%' . $request->phone . '%')
            )
            )
            ->when($request->filled('date_from'), fn ($q) =>
            $q->whereDate('created_at', '>=', $request->date_from)
            )
            ->when($request->filled('date_to'), fn ($q) =>
            $q->whereDate('created_at', '<=', $request->date_to)
            )
            ->orderByDesc('id')
            ->paginate(2)
            ->withQueryString();

        return view('admin.tickets.index', compact('tickets'));
    }
}
