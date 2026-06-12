@extends('layouts.app')
@section('content')
    <h1>Detalhe do Apartamento</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $apartamento->id }}</p>
                    <p><strong>Referência:</strong> {{ $apartamento->referencia }}</p>
                    <p><strong>Tipologia:</strong> {{ $apartamento->tipologia }}</p>
                    <p><strong>Morada:</strong> {{ $apartamento->morada }}</p>
                    <p><strong>Área:</strong> {{ $apartamento->area }} m²</p>
                    <p><strong>Preço:</strong> {{ number_format($apartamento->preco, 2, ',', '.') }} €</p>
                    <p><strong>Estado:</strong>
                        <span class="badge {{ $apartamento->estado === 'Disponível' ? 'bg-success' : 'bg-danger' }}">
                            {{ $apartamento->estado }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        @if ($apartamento->fotografia)
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $apartamento->fotografia) }}" class="img-fluid rounded shadow"
                    alt="Foto do apartamento">
            </div>
        @endif
    </div>
   <div class="mt-3">
    @auth
        <a href="{{ route('apartamentos.edit', $apt) }}" class="btn btn-warning">Editar</a>
    @endauth
    <a href="{{ route('apartamentos.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
