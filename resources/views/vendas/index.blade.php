@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Vendas</h1>
    <a href="{{ route('vendas.create') }}" class="btn btn-primary">+ Nova Venda</a>
</div>
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th><th>Cliente</th><th>Apartamento</th>
            <th>Data</th><th>Valor</th><th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($vendas as $venda)
        <tr>
            <td>{{ $venda->id }}</td>
            <td>{{ $venda->cliente->nome }}</td>
            <td>{{ $venda->apartamento->referencia }} ({{ $venda->apartamento->tipologia }})</td>
            <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</td>
            <td>{{ number_format($venda->valor_venda, 2, ',', '.') }} €</td>
            <td>
                <a href="{{ route('vendas.show', $venda) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('vendas.edit', $venda) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('vendas.destroy', $venda) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Apagar venda? O apartamento voltará a Disponível.')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Apagar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Nenhuma venda registada.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
