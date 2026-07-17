@extends('layouts.app')
@section('titulo', 'Projetos')
@section('conteudo')
    <h1 class="h3 mb-3">{{ isset($projeto) ? 'Editar projeto' : 'Novo projeto' }}</h2>
    <form class="bg-white p-4 rounded shadow-sm" method="POST" action="{{ isset($projeto) ? '/projetos/'.$projeto->codigo : '/projetos' }}">
        @csrf
        @if(isset($projeto)) @method('PUT') @endif

        <div class="mb-2">
            <label class="form-label">Código</label>
            <input type="number" name="codigo" class="form-control" 
                value="{{ old('codigo', $projeto->codigo ?? '') }}" 
                {{ isset($projeto) ? 'readonly' : '' }} required>
        </div>
        <div class="mb-2">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" 
                value="{{ old('nome', $projeto->nome ?? '') }}" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Eixo</label>
            <input type="text" name="eixo" class="form-control" 
                value="{{ old('eixo', $projeto->eixo ?? '') }}" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Ativo" {{ (old('status', $projeto->status ?? '') == 'Ativo') ? 'selected' : '' }}>Ativo</option>
                <option value="Concluído" {{ (old('status', $projeto->status ?? '') == 'Concluído') ? 'selected' : '' }}>Concluído</option>
                <option value="Em andamento" {{ (old('status', $projeto->status ?? '') == 'Em andamento') ? 'selected' : '' }}>Em andamento</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ano</label>
            <input type="number" name="ano" class="form-control" 
                value="{{ old('ano', $projeto->ano ?? '') }}" required>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="/projetos" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection