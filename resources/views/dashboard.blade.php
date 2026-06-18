@extends('layouts.app')
@section('content')

<div class="box-topo" style="border-radius:10px;border-bottom:1px solid #dee2e6;margin-bottom:1.5rem;">
    <h1>Dashboard</h1>
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="stat-card stat-card-blue">
            <div class="stat-icon">👤</div>
            <div class="stat-value">{{ $totalClientes }}</div>
            <div class="stat-label">Clientes Registados</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card stat-card-purple">
            <div class="stat-icon">🏢</div>
            <div class="stat-value">{{ $totalApartamentos }}</div>
            <div class="stat-label">Apartamentos Registados</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card stat-card-orange">
            <div class="stat-icon">🏠</div>
            <div class="stat-value">{{ $apartamentosVendidos }}</div>
            <div class="stat-label">Apartamentos Vendidos</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card stat-card-green">
            <div class="stat-icon">💰</div>
            <div class="stat-value">{{ number_format($totalVendas, 2, ',', '.') }} €</div>
            <div class="stat-label">Total em Vendas</div>
        </div>
    </div>
</div>

@endsection
