@extends('layouts.app')
@section('titulo', 'Outros participantes')
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Outros participantes</h1>
        <a href="{{ route('outros.create') }}" class="btn btn-primary">+ Novo</a>
    </div>
    <table class="table table-striped bg-white align-middle">
        <thead><tr><th>CPF</th><th>Nome</th><th></th></tr></thead>
        <tbody>
        @foreach($outros as $outro)
            <tr>
                <td>{{ $outro->cpf }}</td>
                <td>{{ $outro->nome }}</td>
                <td class="text-end">
                    <a href="{{ route('outros.edit', $outro->cpf) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('outros.destroy', $outro->cpf) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este registro?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
