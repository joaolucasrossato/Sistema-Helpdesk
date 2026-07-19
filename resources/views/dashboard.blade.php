@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Dashboard</h1>

    <hr>

    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Categorias</h5>
                    <h2>{{ \App\Models\Category::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Chamados</h5>
                    <h2>{{ \App\Models\Ticket::count() }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
