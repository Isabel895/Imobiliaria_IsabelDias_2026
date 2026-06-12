@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Clientes</h1>
        @auth
            <a href="{{ route('clientes.create') }}" class="btn btn-primary">+ Novo Cliente</a>
        @endauth
    </div>
    <table class="table table-striped table-bordered" style="table-layout: auto;">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>NIF</th>
                <th class="text-center" style="width: 1%; white-space: nowrap;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>{{ $cliente->nif }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-info">Ver</a>
                        @auth
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Apagar cliente?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Apagar</button>
                            </form>
                        @endauth
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhum cliente encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $clientes->links() }}
    </div>
@endsection
