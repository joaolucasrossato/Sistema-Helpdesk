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
    public function index()
    {
        return view('tickets.index', [
            'tickets' => collect()
        ]);
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

    public function show(Ticket $ticket)
    {
        //
    }

    public function edit(Ticket $ticket)
    {
        //
    }

    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    public function destroy(Ticket $ticket)
    {
        //
    }
}
