@extends('layouts.app')
@section('titulo', 'Articulações')
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Articulações</h1>
        <a href="{{ route('articulacoes.create') }}" class="btn btn-primary">Nova articulação</a>
    </div>
    <table class="table table-striped bg-white">
        <thead><tr><th>Código</th><th>Nome</th><th>Projeto</th><th></th></tr></thead>
        <tbody>
        @foreach($articulacoes as $articulacao)
            <tr>
                <td>{{ $articulacao->codigo }}</td>
                <td>{{ $articulacao->nome }}</td>
                <td>{{ $articulacao->codigo_projeto }}</td>
                <td class="text-end">
                    <a href="{{ route('articulacoes.edit', $articulacao->codigo) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    <form action="{{ route('articulacoes.destroy', $articulacao->codigo) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover esta articulação?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
