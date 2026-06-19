@extends('layouts.app')
@section('content')

<div class="box-topo">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <span class="eyebrow">Carteira de clientes</span>
            <h1>Clientes</h1>
        </div>
        <a href="{{ auth()->check() ? route('clientes.create') : route('login') }}" class="button-novo">
            <span class="button__text">Novo Cliente</span>
            <span class="button__icon"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
        </a>
    </div>
    <form method="GET" class="row g-2 mt-3 id-search-form">
        <div class="col-md-7">
            <input type="text" name="search" class="form-control"
                placeholder="Pesquisar por nome, email ou NIF..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="order" class="form-select">
                <option value="id"   {{ request('order') == 'id'   ? 'selected' : '' }}>Ordenar por ID</option>
                <option value="nome" {{ request('order') == 'nome' ? 'selected' : '' }}>Ordenar por Nome</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
        </div>
    </form>
</div>

<div class="tabela-box">
    <div class="tabela-box-scroll">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>NIF</th>
                    <th class="text-center" style="width:1%;white-space:nowrap;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td class="text-muted">#{{ $cliente->id }}</td>
                        <td class="fw-semibold">{{ $cliente->nome }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefone }}</td>
                        <td>{{ $cliente->nif }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('clientes.show', $cliente) }}" class="btn-acao btn-acao-ver">Ver</a>
                            <a href="{{ auth()->check() ? route('clientes.edit', $cliente) : route('login') }}" class="btn-acao btn-acao-editar">Editar</a>
                            @auth
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Apagar cliente?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-acao btn-acao-apagar">Apagar</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn-acao btn-acao-apagar">Apagar</a>
                            @endauth
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Nenhum cliente encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $clientes->links() }}
</div>

@endsection
