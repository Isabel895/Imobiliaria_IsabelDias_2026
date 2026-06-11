@extends('layouts.app')
@section('content')
    <h1>Detalhe da Venda</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $venda->id }}</p>
            <p><strong>Cliente:</strong> {{ $venda->cliente->nome }}</p>
            <p><strong>Apartamento:</strong>
                {{ $venda->apartamento->referencia }} — {{ $venda->apartamento->tipologia }} —
                {{ $venda->apartamento->morada }}
            </p>
            <p><strong>Data da Venda:</strong> {{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</p>
            <p><strong>Valor:</strong> {{ number_format($venda->valor_venda, 2, ',', '.') }} €</p>
            <p><strong>Observações:</strong> {{ $venda->observacoes ?? '—' }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('vendas.edit', $venda) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
