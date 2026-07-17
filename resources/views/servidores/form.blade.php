@extends('layouts.app')
@section('titulo', $servidor ? 'Editar servidor' : 'Novo servidor')
@section('conteudo')
    <h1 class="h3 mb-3">{{ $servidor ? 'Editar servidor' : 'Novo servidor' }}</h1>
    <form method="POST" action="{{ $servidor ? route('servidores.update', $servidor->siape) : route('servidores.store') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @if($servidor) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">SIAPE</label>
            <input type="number" name="siape" class="form-control"
                   value="{{ old('siape', $servidor->siape ?? '') }}" {{ $servidor ? 'readonly' : '' }} required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $servidor->nome ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Unidade</label>
            <input type="text" name="unidade" class="form-control" value="{{ old('unidade', $servidor->unidade ?? '') }}" required>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{ route('servidores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
