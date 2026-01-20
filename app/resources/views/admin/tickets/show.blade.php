<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket #{{ $ticket->id }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="p-6 text-sm">

<h1 class="text-xl font-semibold mb-4">
    Ticket #{{ $ticket->id }}
</h1>

<div class="mb-4 border p-4">
    <h2 class="font-semibold mb-2">Customer</h2>
    <p>Name: {{ $ticket->customer->name }}</p>
    <p>Phone: {{ $ticket->customer->phone }}</p>
    <p>Email: {{ $ticket->customer->email }}</p>
</div>

<div class="mb-4 border p-4">
    <h2 class="font-semibold mb-2">Ticket</h2>
    <p><strong>Subject:</strong> {{ $ticket->subject }}</p>

    <div class="border p-2 mt-2">
        {{ $ticket->message }}
    </div>
</div>

<form method="POST"
      action="{{ route('admin.tickets.update', $ticket) }}"
      class="mb-4 border p-4">
    @csrf
    @method('PATCH')

    <label class="block mb-2 font-semibold">Status</label>
    <select name="status" class="border p-1 mb-3">
        @foreach(\App\Enums\TicketStatus::cases() as $status)
            <option value="{{ $status->value }}"
                @selected($ticket->status->value === $status->value)>
                {{ ucfirst($status->value) }}
            </option>
        @endforeach
    </select>

    <button class="border px-4 py-1">Save status</button>
</form>

<div class="border p-4 mb-4">
    <h2 class="font-semibold mb-2">Files</h2>

    @forelse($ticket->getMedia('attachments') as $file)
        <div>
            <a href="{{ $file->getUrl() }}" class="underline" target="_blank">
                {{ $file->file_name }}
            </a>
        </div>
    @empty
        <p>No files</p>
    @endforelse
</div>

<div class="text-gray-600">
    <p>Created at: {{ $ticket->created_at }}</p>
    <p>Answered at: {{ $ticket->answered_at ?? '—' }}</p>
</div>

</body>
</html>

