@extends('layouts.app')
@section('content')

<br>

    <h1>Dashboard</h1>
    <br>
    <br>



<div class="row g-4">
    <div class="col-md-3">
        <a href="{{ route('clientes.index') }}" class="text-decoration-none">
            <div class="stat-card stat-card-blue">
                <div class="stat-icon">👤</div>
                <div class="stat-value">{{ $totalClientes }}</div>
                <div class="stat-label">Clientes Registados</div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('apartamentos.index') }}" class="text-decoration-none">
            <div class="stat-card stat-card-purple">
                <div class="stat-icon">🏢</div>
                <div class="stat-value">{{ $totalApartamentos }}</div>
                <div class="stat-label">Apartamentos Registados</div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('apartamentos.index') }}" class="text-decoration-none">
            <div class="stat-card stat-card-orange">
                <div class="stat-icon">🏠</div>
                <div class="stat-value">{{ $apartamentosVendidos }}</div>
                <div class="stat-label">Apartamentos Vendidos</div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('vendas.index') }}" class="text-decoration-none">
            <div class="stat-card stat-card-green">
                <div class="stat-icon">💰</div>
                <div class="stat-value">{{ number_format($totalVendas, 2, ',', '.') }} €</div>
                <div class="stat-label">Total em Vendas</div>
            </div>
        </a>
    </div>
</div>



@endsection
