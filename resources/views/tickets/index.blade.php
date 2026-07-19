@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Chamados</h1>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary">Novo Chamado</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="GET" class="mb-3 d-flex gap-2">
    <select name="status" class="form-select" style="max-width: 220px;" onchange="this.form.submit()">
        <option value="">Todos os status</option>
        <option value="aberto" {{ request('status') == 'aberto' ? 'selected' : '' }}>Aberto</option>
        <option value="em_andamento" {{ request('status') == 'em_andamento' ? 'selected' : '' }}>Em andamento</option>
        <option value="resolvido" {{ request('status') == 'resolvido' ? 'selected' : '' }}>Resolvido</option>
    </select>
</form>

<table class="table table-hover align-middle">
    <thead>
        <tr>
            <th>Título</th>
            <th>Categoria</th>
            <th>Status</th>
            <th>Prioridade</th>
            <th>Autor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tickets as $ticket)
        <tr>
            <td>{{ $ticket->title }}</td>
            <td>{{ $ticket->category->name ?? '-' }}</td>
            <td>
                @php
                    $statusColors = [
                        'Aberto' => 'bg-danger',
                        'Em andamento' => 'bg-warning text-dark',
                        'Resolvido' => 'bg-success',
                    ];
                @endphp
                <span class="badge {{ $statusColors[$ticket->status] ?? 'bg-secondary' }}">
                    {{ str_replace('_', ' ', $ticket->status) }}
                </span>
            </td>
            <td>{{ ucfirst($ticket->priority) }}</td>
            <td>{{ $ticket->user->name }}</td>
            <td>
                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Tem certeza que deseja excluir este chamado?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">Nenhum chamado encontrado.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
