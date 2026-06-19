@extends('layouts.app')
@section('content')

<div class="box-topo" style="border-radius:12px; border-bottom:1px solid var(--line); margin-bottom:1.75rem;">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <span class="eyebrow">Catálogo de imóveis</span>
            <h1>Apartamentos</h1>
        </div>
        <a href="{{ auth()->check() ? route('apartamentos.create') : route('login') }}" class="button-novo">
            <span class="button__text">Novo Apt.</span>
            <span class="button__icon"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
        </a>
    </div>
    <form method="GET" class="row g-2 mt-3 id-search-form">
        <div class="col-md-7">
            <input type="text" name="search" class="form-control"
                placeholder="Pesquisar por referência, tipologia ou morada..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="order" class="form-select">
                <option value="id"        {{ request('order') == 'id'        ? 'selected' : '' }}>Ordenar por ID</option>
                <option value="tipologia" {{ request('order') == 'tipologia' ? 'selected' : '' }}>Ordenar por Tipologia</option>
                <option value="area"      {{ request('order') == 'area'      ? 'selected' : '' }}>Ordenar por Área</option>
                <option value="preco"     {{ request('order') == 'preco'     ? 'selected' : '' }}>Ordenar por Preço</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
        </div>
    </form>
</div>

<div class="apt-grid">
    @forelse($apartamentos as $apt)
        <div class="apt-card">
            <div class="apt-card-photo">
                @if ($apt->fotografia)
                    <img src="{{ asset('storage/' . $apt->fotografia) }}" alt="{{ $apt->referencia }}">
                @else
                    <div class="no-photo">Sem fotografia</div>
                @endif
                <span class="apt-card-badge {{ $apt->estado === 'Disponível' ? 'disponivel' : 'vendido' }}">
                    {{ $apt->estado }}
                </span>
            </div>
            <span class="apt-card-price-tag">{{ number_format($apt->preco, 0, ',', '.') }} €</span>
            <div class="apt-card-body">
                <div class="apt-card-ref">Ref. {{ $apt->referencia }}</div>
                <div class="apt-card-title">{{ $apt->tipologia }}</div>
                <div class="apt-card-address">{{ $apt->morada }}</div>
                <div class="apt-card-meta">
                    <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/></svg>
                        {{ $apt->area }} m²
                    </span>
                </div>
                <div class="apt-card-actions">
                    <a href="{{ route('apartamentos.show', $apt) }}" class="btn-acao btn-acao-ver">Ver</a>
                    <a href="{{ auth()->check() ? route('apartamentos.edit', $apt) : route('login') }}" class="btn-acao btn-acao-editar">Editar</a>
                    @auth
                        <form action="{{ route('apartamentos.destroy', $apt) }}" method="POST"
                            onsubmit="return confirm('Apagar apartamento?')" style="flex:1;">
                            @csrf @method('DELETE')
                            <button class="btn-acao btn-acao-apagar w-100">Apagar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-acao btn-acao-apagar">Apagar</a>
                    @endauth
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-muted py-5">Nenhum apartamento encontrado.</p>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $apartamentos->links() }}
</div>

@endsection
