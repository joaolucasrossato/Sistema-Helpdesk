@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Categorias</h2>

    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        Nova Categoria
    </a>

</div>

<table class="table table-striped">

    <thead>

        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>

    </thead>

    <tbody>

    @forelse($categories as $category)

        <tr>

            <td>{{ $category->name }}</td>

            <td>{{ $category->description }}</td>

            <td>

                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">
                    Editar
                </a>

                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm btn-danger">
                        Excluir
                    </button>

                </form>

        </tr>

    @empty

        <tr>
            <td colspan="2">
                Nenhuma categoria cadastrada.
            </td>
        </tr>

    @endforelse

    </tbody>

</table>

@endsection
