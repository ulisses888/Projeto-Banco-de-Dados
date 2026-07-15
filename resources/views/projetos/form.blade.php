@extends('layouts.app')
@section('titulo', $projeto ? 'Editar projeto' : 'Novo projeto')
@section('conteudo')
    <h1 class="h3 mb-3">{{ $projeto ? 'Editar projeto' : 'Novo projeto' }}</h1>
    <form method="POST" action="{{ $projeto ? route('projetos.update', $projeto->codigo) : route('projetos.store') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @if($projeto) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="number" name="codigo" class="form-control"
                   value="{{ old('codigo', $projeto->codigo ?? '') }}" {{ $projeto ? 'readonly' : '' }} required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $projeto->nome ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Eixo</label>
            <input type="text" name="eixo" class="form-control" value="{{ old('eixo', $projeto->eixo ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="{{ old('status', $projeto->status ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ano</label>
            <input type="number" name="ano" class="form-control" value="{{ old('ano', $projeto->ano ?? '') }}" required>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{ route('projetos.index') }}" class="btn btn-link">Cancelar</a>
    </form>
@endsection
