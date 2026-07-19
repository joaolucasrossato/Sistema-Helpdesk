<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTickets = Ticket::count();
        $abertos = Ticket::where('status', 'Aberto')->count();
        $emAndamento = Ticket::where('status', 'Em andamento')->count();
        $resolvidos = Ticket::where('status', 'Resolvido')->count();
        $totalCategorias = Category::count();

        return view('dashboard', compact(
            'totalTickets',
            'abertos',
            'emAndamento',
            'resolvidos',
            'totalCategorias'
        ));
    }
}
