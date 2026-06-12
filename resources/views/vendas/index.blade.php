@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Vendas</h1>
        @auth
            <a href="{{ route('vendas.create') }}" class="btn btn-primary">+ Nova Venda</a>
        @endauth
    </div>
    <table class="table table-striped table-bordered" style="table-layout: auto;">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Apartamento</th>
                <th>Data</th>
                <th>Valor</th>
                <th class="text-center" style="width: 1%; white-space: nowrap;">Ações</th>
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
                    <td class="text-nowrap">
                        <a href="{{ route('vendas.show', $venda) }}" class="btn btn-sm btn-info">Ver</a>
                        @auth
                            <a href="{{ route('vendas.edit', $venda) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('vendas.destroy', $venda) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Apagar venda?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Apagar</button>
                            </form>
                        @endauth
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhuma venda registada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $vendas->links() }}
    </div>
@endsection
