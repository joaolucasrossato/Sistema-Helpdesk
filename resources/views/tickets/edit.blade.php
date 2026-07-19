@extends('layouts.app')

@section('content')
<h1 class="mb-4">Editar Chamado</h1>

<form method="POST" action="{{ route('tickets.update', $ticket) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $ticket->title) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', $ticket->description) }}</textarea>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Categoria</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="Aberto" {{ $ticket->status == 'Aberto' ? 'selected' : '' }}>Aberto</option>
                <option value="Em andamento" {{ $ticket->status == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                <option value="Resolvido" {{ $ticket->status == 'Resolvido' ? 'selected' : '' }}>Resolvido</option>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Prioridade</label>
            <select name="priority" class="form-select">
                <option value="baixa" {{ $ticket->priority == 'baixa' ? 'selected' : '' }}>Baixa</option>
                <option value="media" {{ $ticket->priority == 'media' ? 'selected' : '' }}>Média</option>
                <option value="alta" {{ $ticket->priority == 'alta' ? 'selected' : '' }}>Alta</option>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
