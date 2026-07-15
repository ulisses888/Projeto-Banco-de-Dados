@extends('layouts.app')
@section('titulo', $articulacao ? 'Editar articulação' : 'Nova articulação')
@section('conteudo')
    <h1 class="h3 mb-3">{{ $articulacao ? 'Editar articulação' : 'Nova articulação' }}</h1>
    <form method="POST" action="{{ $articulacao ? route('articulacoes.update', $articulacao->codigo) : route('articulacoes.store') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @if($articulacao) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="number" name="codigo" class="form-control"
                   value="{{ old('codigo', $articulacao->codigo ?? '') }}" {{ $articulacao ? 'readonly' : '' }} required>
        </div>

        @if(!$articulacao)
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
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $articulacao->nome ?? '') }}" required>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{ route('articulacoes.index') }}" class="btn btn-link">Cancelar</a>
    </form>
@endsection
