@extends('layouts.app')

@section('content')
<h1 class="mb-4">Novo Chamado</h1>

<form method="POST" action="{{ route('tickets.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Categoria</label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">Selecione</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Prioridade</label>
            <select name="priority" class="form-select @error('priority') is-invalid @enderror">
                <option value="baixa">Baixa</option>
                <option value="media" selected>Média</option>
                <option value="alta">Alta</option>
            </select>
            @error('priority') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Criar Chamado</button>
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
