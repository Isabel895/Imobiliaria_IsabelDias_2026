@extends('layouts.app')
@section('content')
    <h1>Detalhe do Cliente</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $cliente->id }}</p>
            <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
            <p><strong>Morada:</strong> {{ $cliente->morada }}</p>
            <p><strong>NIF:</strong> {{ $cliente->nif }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
    </div>

    <h3 class="mt-4">Vendas deste cliente</h3>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Apartamento</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cliente->vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ $venda->apartamento->referencia }}</td>
                    <td>{{ $venda->data_venda }}</td>
                    <td>{{ number_format($venda->valor_venda, 2, ',', '.') }} €</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Sem vendas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
