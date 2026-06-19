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

<br>

<div class="box-graficos">
    <h2>Registos por mês <span class="text-muted fs-6 fw-normal">(últimos 12 meses)</span></h2>
    <div class="row g-3 pb-3">
        <div class="col-md-4">
            <div class="grafico-card">
                <div class="grafico-titulo"><span class="dot" style="background: var(--ink);"></span> Clientes registados</div>
                <canvas id="graficoClientes"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="grafico-card">
                <div class="grafico-titulo"><span class="dot" style="background: var(--gold);"></span> Apartamentos registados</div>
                <canvas id="graficoApartamentos"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="grafico-card">
                <div class="grafico-titulo"><span class="dot" style="background: var(--green);"></span> Vendas realizadas</div>
                <canvas id="graficoVendas"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const mesesLabels = @json($mensalLabels);

    const dadosClientes = @json($clientesPorMes);
    const dadosApartamentos = @json($apartamentosPorMes);
    const dadosVendas = @json($vendasPorMes);

    function criarGrafico(canvasId, labels, dados, cor) {
        const ctx = document.getElementById(canvasId);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: dados,
                    backgroundColor: cor,
                    borderRadius: 4,
                    maxBarThickness: 28
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    criarGrafico('graficoClientes', mesesLabels, dadosClientes, '#1C2B33');
    criarGrafico('graficoApartamentos', mesesLabels, dadosApartamentos, '#A66E2C');
    criarGrafico('graficoVendas', mesesLabels, dadosVendas, '#3A6B52');
</script>

@endsection
