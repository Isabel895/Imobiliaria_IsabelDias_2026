@extends('layouts.app')
@section('content')
<h1>Editar Venda</h1>
<form action="{{ route('vendas.update', $venda) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Cliente</label>
        <select name="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}"
                    {{ old('cliente_id', $venda->cliente_id)==$cliente->id ? 'selected':'' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>
        @error('cliente_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Apartamento</label>
        <select name="apartamento_id" class="form-select @error('apartamento_id') is-invalid @enderror">
            @foreach($apartamentos as $apt)
                <option value="{{ $apt->id }}"
                    {{ old('apartamento_id', $venda->apartamento_id)==$apt->id ? 'selected':'' }}>
                    {{ $apt->referencia }} — {{ $apt->tipologia }}
                </option>
            @endforeach
        </select>
        @error('apartamento_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Data da Venda</label>
        <input type="date" name="data_venda" class="form-control @error('data_venda') is-invalid @enderror"
               value="{{ old('data_venda', $venda->data_venda) }}">
        @error('data_venda')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Valor da Venda (€)</label>
        <input type="number" step="0.01" name="valor_venda"
               class="form-control @error('valor_venda') is-invalid @enderror"
               value="{{ old('valor_venda', $venda->valor_venda) }}">
        @error('valor_venda')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Observações</label>
        <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes', $venda->observacoes) }}</textarea>
    </div>
    <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection
