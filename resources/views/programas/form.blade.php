@extends('layouts.app')
@section('titulo', $programa ? 'Editar programa' : 'Novo programa')
@section('conteudo')
    <h1 class="h3 mb-3">{{ $programa ? 'Editar programa' : 'Novo programa' }}</h1>
    <form method="POST" action="{{ $programa ? route('programas.update', $programa->codigo) : route('programas.store') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @if($programa) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="number" name="codigo" class="form-control"
                   value="{{ old('codigo', $programa->codigo ?? '') }}" {{ $programa ? 'readonly' : '' }} required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $programa->nome ?? '') }}" required>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{ route('programas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
