@extends('layouts.app')
@section('content')
<h1>Novo Cliente</h1>
<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
               value="{{ old('nome') }}">
        @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror"
               value="{{ old('telefone') }}">
        @error('telefone')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Morada</label>
        <input type="text" name="morada" class="form-control @error('morada') is-invalid @enderror"
               value="{{ old('morada') }}">
        @error('morada')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">NIF</label>
        <input type="text" name="nif" class="form-control @error('nif') is-invalid @enderror"
               value="{{ old('nif') }}" maxlength="9">
        @error('nif')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
