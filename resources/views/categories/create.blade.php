@extends('layouts.app')

@section('content')

<h2>Nova Categoria</h2>

<form action="{{ route('categories.store') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label class="form-label">Nome</label>

        <input
            type="text"
            name="name"
            class="form-control"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descrição</label>

        <textarea
            name="description"
            class="form-control"
            rows="4"></textarea>
    </div>

    <button class="btn btn-primary">
        Salvar
    </button>

</form>

@endsection
