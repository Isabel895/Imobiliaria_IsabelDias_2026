@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Apartamentos</h1>
        @auth
            <a href="{{ route('apartamentos.create') }}" class="btn btn-primary">+ Novo Apartamento</a>
        @endauth
    </div>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                placeholder="Pesquisar por referência, tipologia ou morada..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="order" class="form-select">
                <option value="id" {{ request('order') == 'id' ? 'selected' : '' }}>Ordenar por ID</option>
                <option value="tipologia"{{ request('order') == 'tipologia' ? 'selected' : '' }}>Ordenar por Tipologia
                </option>
                <option value="area" {{ request('order') == 'area' ? 'selected' : '' }}>Ordenar por Área</option>
                <option value="preco" {{ request('order') == 'preco' ? 'selected' : '' }}>Ordenar por Preço</option>
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
                <th>Ref.</th>
                <th>Tipologia</th>
                <th>Morada</th>
                <th>Área (m²)</th>
                <th>Preço</th>
                <th>Foto</th>
                <th>Estado</th>
                <th class="text-center" style="width: 1%; white-space: nowrap;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($apartamentos as $apt)
                <tr>
                    <td>{{ $apt->id }}</td>
                    <td>{{ $apt->referencia }}</td>
                    <td>{{ $apt->tipologia }}</td>
                    <td>{{ $apt->morada }}</td>
                    <td>{{ $apt->area }}</td>
                    <td>{{ number_format($apt->preco, 2, ',', '.') }} €</td>
                    <td>
                        @if ($apt->fotografia)
                            <img src="{{ asset('storage/' . $apt->fotografia) }}" height="50" width="70"
                                style="object-fit:cover; border-radius:4px;">
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $apt->estado === 'Disponível' ? 'bg-success' : 'bg-danger' }}">
                            {{ $apt->estado }}
                        </span>
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('apartamentos.show', $apt) }}" class="btn btn-sm btn-info">Ver</a>
                        @auth
                            <a href="{{ route('apartamentos.edit', $apt) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('apartamentos.destroy', $apt) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Apagar apartamento?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Apagar</button>
                            </form>
                        @endauth
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Nenhum apartamento encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $apartamentos->links() }}
    </div>
@endsection
