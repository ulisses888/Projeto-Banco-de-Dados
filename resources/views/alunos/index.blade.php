@extends('layouts.app')
@section('titulo', 'Alunos')
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Alunos</h1>
        <a href="{{ route('alunos.create') }}" class="btn btn-primary">+ Novo</a>
    </div>
    <table class="table table-striped bg-white align-middle">
        <thead>
            <tr><th>Matrícula</th><th>Nome</th><th>Curso</th><th></th></tr>
        </thead>
        <tbody>
        @foreach($alunos as $aluno)
            <tr>
                <td>{{ $aluno->matricula }}</td>
                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->curso }}</td>
                <td class="text-end">
                    <a href="{{ route('alunos.edit', $aluno->matricula) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('alunos.destroy', $aluno->matricula) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este aluno?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
