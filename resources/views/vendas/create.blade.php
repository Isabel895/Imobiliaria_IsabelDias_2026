@extends('layouts.app')
@section('content')
    <h1>Nova Venda</h1>
    <form action="{{ route('vendas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
                <option value="">-- Selecione um cliente --</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }} (NIF: {{ $cliente->nif }})
                    </option>
                @endforeach
            </select>
            @error('cliente_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Apartamento Disponível</label>
            <select name="apartamento_id" class="form-select @error('apartamento_id') is-invalid @enderror">
                <option value="">-- Selecione um apartamento --</option>
                @foreach ($apartamentos as $apt)
                    <option value="{{ $apt->id }}" {{ old('apartamento_id') == $apt->id ? 'selected' : '' }}>
                        {{ $apt->referencia }} — {{ $apt->tipologia }} — {{ $apt->morada }}
                        ({{ number_format($apt->preco, 2, ',', '.') }} €)
                    </option>
                @endforeach
            </select>
            @error('apartamento_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Data da Venda</label>
            <input type="date" name="data_venda" class="form-control @error('data_venda') is-invalid @enderror"
                value="{{ old('data_venda', date('Y-m-d')) }}">
            @error('data_venda')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Valor da Venda (€)</label>
            <input type="number" step="0.01" name="valor_venda"
                class="form-control @error('valor_venda') is-invalid @enderror" value="{{ old('valor_venda') }}">
            @error('valor_venda')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Observações</label>
            <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes') }}</textarea>
        </div>
        <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Registar Venda</button>
    </form>
@endsection
