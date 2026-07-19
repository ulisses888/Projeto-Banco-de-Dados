@extends('layouts.app')
@section('titulo', 'Programa: ' . $programa->nome)
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 m-0">{{ $programa->nome }}</h1>
            <small class="text-muted">Código {{ $programa->codigo }}</small>
        </div>
        <a href="{{ route('programas.edit', $programa->codigo) }}" class="btn btn-warning">Editar programa</a>
    </div>

    <div class="card">
        <div class="card-header">Projetos vinculados</div>
        <ul class="list-group list-group-flush">
            @forelse($projetosDoPrograma as $projeto)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('projetos.show', $projeto->codigo) }}">{{ $projeto->nome }} ({{ $projeto->codigo }})</a>
                    <form action="{{ route('programas.projetos.remover', [$programa->codigo, $projeto->codigo]) }}" method="POST" onsubmit="return confirm('Desvincular projeto do programa?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Desvincular</button>
                    </form>
                </li>
            @empty
                <li class="list-group-item text-muted">Nenhum projeto vinculado.</li>
            @endforelse
        </ul>
        <div class="card-body">
            <form action="{{ route('programas.projetos.adicionar', $programa->codigo) }}" method="POST" class="row g-2">
                @csrf
                <div class="col-10">
                    <select name="codigo_projeto" class="form-select" required>
                        <option value="">Selecione um projeto...</option>
                        @foreach($projetosDisponiveis as $projeto)
                            <option value="{{ $projeto->codigo }}">{{ $projeto->nome }} ({{ $projeto->codigo }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary w-100">Vincular</button>
                </div>
            </form>
        </div>
    </div>
@endsection
