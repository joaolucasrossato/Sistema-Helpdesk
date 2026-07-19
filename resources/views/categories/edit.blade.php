@extends('layouts.app')

@section('content')

<h1>Categorias</h1>

<h2>Editar Categoria</h2>

<form action="{{ route('categories.update', $category) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nome</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $category->name) }}"
            required>
    </div>

    <div class="mb-3">
        <label>Descrição</label>
        <textarea
            name="description"
            class="form-control"
            rows="4">{{ old('description', $category->description) }}</textarea>
    </div>

    <button class="btn btn-primary">
        Atualizar
    </button>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
        Cancelar
    </a>

</form>

@endsection
