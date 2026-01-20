<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    @vite(['resources/css/app.css'])
</head>
<body class="p-6">

<h1 class="text-xl font-semibold mb-4">Tickets</h1>
<form method="POST" class="mb-4" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="border px-3">
        Logout
    </button>
</form>

<form method="GET" class="mb-4 flex flex-wrap gap-2 text-sm">
    <input type="date" name="date_from" value="{{ request('date_from') }}" class="border p-1">
    <input type="date" name="date_to" value="{{ request('date_to') }}" class="border p-1">

    <select name="status" class="border p-1">
        <option value="">Status</option>
        @foreach(\App\Enums\TicketStatus::cases() as $status)
            <option value="{{ $status->value }}"
                @selected(request('status') === $status->value)>
                {{ ucfirst($status->value) }}
            </option>
        @endforeach
    </select>

    <input type="text" name="email" placeholder="Email"
           value="{{ request('email') }}" class="border p-1">

    <input type="text" name="phone" placeholder="Phone"
           value="{{ request('phone') }}" class="border p-1">

    <button type="submit" class="border px-3">Apply</button>
    <a href="{{ route('admin.tickets.index') }}" class="border px-3">Reset</a>

</form>

<table class="w-full border text-sm">
    <thead>
    <tr class="bg-gray-100">
        <th class="border p-2">ID</th>
        <th class="border p-2">Client</th>
        <th class="border p-2">Phone</th>
        <th class="border p-2">Email</th>
        <th class="border p-2">Subject</th>
        <th class="border p-2">Status</th>
        <th class="border p-2"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($tickets as $ticket)
        <tr>
            <td class="border p-2">{{ $ticket->id }}</td>
            <td class="border p-2">{{ $ticket->customer->name }}</td>
            <td class="border p-2">{{ $ticket->customer->phone }}</td>
            <td class="border p-2">{{ $ticket->customer->email }}</td>
            <td class="border p-2">{{ $ticket->subject }}</td>
            <td class="border p-2">{{ ucfirst($ticket->status->value) }}</td>
            <td class="border p-2">
                <a href="{{ route('admin.tickets.show', $ticket) }}" class="underline">
                    Open
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $tickets->links() }}
</div>

</body>
</html>

