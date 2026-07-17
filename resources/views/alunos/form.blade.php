@extends('layouts.app')
@section('titulo', $aluno ? 'Editar aluno' : 'Novo aluno')
@section('conteudo')
    <h1 class="h3 mb-3">{{ $aluno ? 'Editar aluno' : 'Novo aluno' }}</h1>
    <form method="POST" action="{{ $aluno ? route('alunos.update', $aluno->matricula) : route('alunos.store') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @if($aluno) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Matrícula</label>
            <input type="number" name="matricula" class="form-control"
                   value="{{ old('matricula', $aluno->matricula ?? '') }}" {{ $aluno ? 'readonly' : '' }} required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $aluno->nome ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Curso</label>
            <input type="text" name="curso" class="form-control" value="{{ old('curso', $aluno->curso ?? '') }}" required>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{ route('alunos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
