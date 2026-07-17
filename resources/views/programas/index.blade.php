@extends('layouts.app')
@section('titulo', 'Programas')
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Programas</h1>
        <a href="{{ route('programas.create') }}" class="btn btn-primary">+ Novo</a>
    </div>
    <table class="table table-striped bg-white align-middle">
        <thead><tr><th>Código</th><th>Nome</th><th></th></tr></thead>
        <tbody>
        @foreach($programas as $programa)
            <tr>
                <td>{{ $programa->codigo }}</td>
                <td>{{ $programa->nome }}</td>
                <td class="text-end">
                    <a href="{{ route('programas.show', $programa->codigo) }}" class="btn btn-sm btn-secondary">Detalhes</a>
                    <a href="{{ route('programas.edit', $programa->codigo) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('programas.destroy', $programa->codigo) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este programa?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
