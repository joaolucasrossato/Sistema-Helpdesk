<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Exibe a lista de chamados.
     */
    public function index(Request $request)
    {
        $tickets = Ticket::with(['category', 'user'])
            ->when($request->status, fn($query) => $query->where('status', $request->status))
            ->latest()
            ->get();

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('tickets.create', compact('categories'));
    }

    /**
     * Salva um novo chamado.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'Aberto',
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'technician_id' => null,
        ]);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado criado com sucesso!');
    }

    /**
     * Exibe o detalhe de um chamado.
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['category', 'user', 'comments.user']);

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Ticket $ticket)
    {
        $categories = Category::orderBy('name')->get();

        return view('tickets.edit', compact('ticket', 'categories'));
    }

    /**
     * Atualiza um chamado existente.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $ticket->update($request->only(
            'title',
            'description',
            'status',
            'priority',
            'category_id'
        ));

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado atualizado com sucesso!');
    }

    /**
     * Remove um chamado.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado excluído com sucesso!');
    }
}
