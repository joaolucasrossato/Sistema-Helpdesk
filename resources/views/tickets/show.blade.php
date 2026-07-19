@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $ticket->title }}</h1>
    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">Voltar</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <p><strong>Categoria:</strong> {{ $ticket->category->name ?? '-' }}</p>
        <p><strong>Status:</strong> {{ str_replace('_', ' ', $ticket->status) }}</p>
        <p><strong>Prioridade:</strong> {{ ucfirst($ticket->priority) }}</p>
        <p><strong>Aberto por:</strong> {{ $ticket->user->name }}</p>
        <hr>
        <p>{{ $ticket->description }}</p>
    </div>
</div>

<h4>Comentários</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<ul class="list-group mb-4">
    @forelse($ticket->comments as $comment)
        <li class="list-group-item">
            <strong>{{ $comment->user->name }}</strong>
            <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
            <p class="mb-0">{{ $comment->message }}</p>
        </li>
    @empty
        <li class="list-group-item text-muted">Nenhum comentário ainda.</li>
    @endforelse
</ul>

<form method="POST" action="{{ route('comments.store', $ticket) }}">
    @csrf
    <div class="mb-3">
        <textarea name="message" rows="3" class="form-control" placeholder="Escreva um comentário..."></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Comentar</button>
</form>
@endsection
