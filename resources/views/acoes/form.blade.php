@extends('layouts.app')
@section('titulo', $acao ? 'Editar ação' : 'Nova ação')
@section('conteudo')
    <h1 class="h3 mb-3">{{ $acao ? 'Editar ação' : 'Nova ação' }}</h1>
    <form method="POST" action="{{ $acao ? route('acoes.update', $acao->codigo) : route('acoes.store') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @if($acao) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="number" name="codigo" class="form-control"
                   value="{{ old('codigo', $acao->codigo ?? '') }}" {{ $acao ? 'readonly' : '' }} required>
        </div>

        @if(!$acao)
        <div class="mb-3">
            <label class="form-label">Projeto</label>
            <select name="codigo_projeto" class="form-select" required>
                <option value="">Selecione...</option>
                @foreach($projetos as $projeto)
                    <option value="{{ $projeto->codigo }}">{{ $projeto->codigo }} - {{ $projeto->nome }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $acao->titulo ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gênero</label>
            <input type="text" name="genero" class="form-control" value="{{ old('genero', $acao->genero ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="{{ old('status', $acao->status ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="4" required>{{ old('descricao', $acao->descricao ?? '') }}</textarea>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{ route('acoes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
