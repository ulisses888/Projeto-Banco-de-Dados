@extends('layouts.app')
@section('titulo', 'Servidores')
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Servidores</h1>
        <a href="{{ route('servidores.create') }}" class="btn btn-primary">Novo servidor</a>
    </div>
    <table class="table table-striped bg-white">
        <thead><tr><th>SIAPE</th><th>Nome</th><th>Unidade</th><th></th></tr></thead>
        <tbody>
        @foreach($servidores as $servidor)
            <tr>
                <td>{{ $servidor->siape }}</td>
                <td>{{ $servidor->nome }}</td>
                <td>{{ $servidor->unidade }}</td>
                <td class="text-end">
                    <a href="{{ route('servidores.edit', $servidor->siape) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    <form action="{{ route('servidores.destroy', $servidor->siape) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este servidor?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
