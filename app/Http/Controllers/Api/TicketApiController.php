<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketApiController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::with(['category', 'user'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->get();

        return response()->json($tickets);
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['category', 'user', 'comments.user']);

        return response()->json($ticket);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $ticket = Ticket::create([
            ...$validated,
            'status' => 'Aberto',
            'user_id' => Auth::id(),
            'technician_id' => null,
        ]);

        return response()->json($ticket, 201);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'title' => 'sometimes|max:255',
            'description' => 'sometimes',
            'status' => 'sometimes',
            'priority' => 'sometimes',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $ticket->update($validated);

        return response()->json($ticket);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json(null, 204);
    }
}
