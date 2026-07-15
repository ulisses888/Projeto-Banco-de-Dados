@extends('layouts.app')
@section('titulo', 'Projetos')
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Projetos</h1>
        <a href="{{ route('projetos.create') }}" class="btn btn-primary">Novo projeto</a>
    </div>
    <table class="table table-striped bg-white">
        <thead><tr><th>Código</th><th>Nome</th><th>Eixo</th><th>Status</th><th>Ano</th><th></th></tr></thead>
        <tbody>
        @foreach($projetos as $projeto)
            <tr>
                <td>{{ $projeto->codigo }}</td>
                <td>{{ $projeto->nome }}</td>
                <td>{{ $projeto->eixo }}</td>
                <td>{{ $projeto->status }}</td>
                <td>{{ $projeto->ano }}</td>
                <td class="text-end">
                    <a href="{{ route('projetos.show', $projeto->codigo) }}" class="btn btn-sm btn-outline-primary">Detalhes</a>
                    <a href="{{ route('projetos.edit', $projeto->codigo) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    <form action="{{ route('projetos.destroy', $projeto->codigo) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este projeto?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
