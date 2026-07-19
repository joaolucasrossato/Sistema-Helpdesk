@extends('layouts.app')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-label">Total de Chamados</div>
            <div class="stat-value">{{ $totalTickets }}</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-label">
                <span class="status-badge status-aberto">Aberto</span>
            </div>
            <div class="stat-value">{{ $abertos }}</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-label">
                <span class="status-badge status-em-andamento">Em andamento</span>
            </div>
            <div class="stat-value">{{ $emAndamento }}</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-label">
                <span class="status-badge status-resolvido">Resolvido</span>
            </div>
            <div class="stat-value">{{ $resolvidos }}</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-label">Categorias</div>
            <div class="stat-value">{{ $totalCategorias }}</div>
        </div>
    </div>
</div>
@endsection
