@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Novo Chamado</h2>

    <form action="{{ route('tickets.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Título</label>

            <input
                type="text"
                name="title"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>

            <select
                name="category_id"
                class="form-select"
                required>

                <option value="">Selecione...</option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">
            <label class="form-label">Prioridade</label>

            <select
                name="priority"
                class="form-select">

                <option>Baixa</option>
                <option>Média</option>
                <option>Alta</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">Descrição</label>

            <textarea
                name="description"
                rows="5"
                class="form-control"></textarea>

        </div>

        <button class="btn btn-primary">

            Abrir Chamado

        </button>

    </form>

</div>

@endsection
