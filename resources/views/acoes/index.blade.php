@extends('layouts.app')
@section('titulo', 'Ações')
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Ações</h1>
        <a href="{{ route('acoes.create') }}" class="btn btn-primary">+ Nova</a>
    </div>
    <table class="table table-striped bg-white align-middle">
        <thead><tr><th>Código</th><th>Título</th><th>Gênero</th><th>Status</th><th>Projeto</th><th></th></tr></thead>
        <tbody>
        @foreach($acoes as $acao)
            <tr>
                <td>{{ $acao->codigo }}</td>
                <td>{{ $acao->titulo }}</td>
                <td>{{ $acao->genero }}</td>
                <td>{{ $acao->status }}</td>
                <td>{{ $acao->nome }}</td>
                <td class="text-end">
                    <a href="{{ route('acoes.edit', $acao->codigo) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('acoes.destroy', $acao->codigo) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover esta ação?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
