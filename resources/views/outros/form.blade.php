@extends('layouts.app')
@section('titulo', $outro ? 'Editar registro' : 'Novo registro')
@section('conteudo')
    <h1 class="h3 mb-3">{{ $outro ? 'Editar registro' : 'Novo registro' }}</h1>
    <form method="POST" action="{{ $outro ? route('outros.update', $outro->cpf) : route('outros.store') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @if($outro) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control"
                   value="{{ old('cpf', $outro->cpf ?? '') }}" {{ $outro ? 'readonly' : '' }} required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $outro->nome ?? '') }}" required>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{ route('outros.index') }}" class="btn btn-link">Cancelar</a>
    </form>
@endsection
