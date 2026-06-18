@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>💼 Vendas</h1>
       <a href="{{ auth()->check() ? route('vendas.create') : route('login') }}" class="button-novo"><span class="button__text">Nova Venda</span><span class="button__icon"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span></a>
    </div>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                placeholder="Pesquisar por cliente ou apartamento..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="order" class="form-select">
                <option value="id"          {{ request('order') == 'id'          ? 'selected' : '' }}>Ordenar por ID</option>
                <option value="data_venda"  {{ request('order') == 'data_venda'  ? 'selected' : '' }}>Ordenar por Data</option>
                <option value="valor_venda" {{ request('order') == 'valor_venda' ? 'selected' : '' }}>Ordenar por Valor</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
        </div>
    </form>

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
                        <a href="{{ route('vendas.show', $venda) }}" class="btn-acao btn-acao-ver">Ver</a>
                        <a href="{{ auth()->check() ? route('vendas.edit', $venda) : route('login') }}" class="btn-acao btn-acao-editar">Editar</a>
                        @auth
                            <form action="{{ route('vendas.destroy', $venda) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Apagar venda?')">
                                @csrf @method('DELETE')
                                <button class="btn-acao btn-acao-apagar">Apagar</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn-acao btn-acao-apagar">Apagar</a>
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
