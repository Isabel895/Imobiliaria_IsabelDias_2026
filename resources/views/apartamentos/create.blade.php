@extends('layouts.app')
@section('content')
<h1>Novo Apartamento</h1>
<form action="{{ route('apartamentos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Referência</label>
            <input type="text" name="referencia" class="form-control @error('referencia') is-invalid @enderror"
                   value="{{ old('referencia') }}">
            @error('referencia')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Tipologia</label>
            <select name="tipologia" class="form-select @error('tipologia') is-invalid @enderror">
                <option value="">-- Selecione --</option>
                @foreach(['T0','T1','T2','T3','T4','T5'] as $t)
                    <option value="{{ $t }}" {{ old('tipologia')==$t ? 'selected':'' }}>{{ $t }}</option>
                @endforeach
            </select>
            @error('tipologia')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Morada</label>
            <input type="text" name="morada" class="form-control @error('morada') is-invalid @enderror"
                   value="{{ old('morada') }}">
            @error('morada')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Área (m²)</label>
            <input type="number" step="0.01" name="area" class="form-control @error('area') is-invalid @enderror"
                   value="{{ old('area') }}">
            @error('area')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Preço (€)</label>
            <input type="number" step="0.01" name="preco" class="form-control @error('preco') is-invalid @enderror"
                   value="{{ old('preco') }}">
            @error('preco')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Fotografia</label>
            <input type="file" name="fotografia" class="form-control @error('fotografia') is-invalid @enderror"
                   accept="image/*">
            @error('fotografia')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <a href="{{ route('apartamentos.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
