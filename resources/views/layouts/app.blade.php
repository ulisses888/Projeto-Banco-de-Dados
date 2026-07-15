<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo', 'Projetos CDTec')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('projetos.index') }}">CDTec - Projetos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('programas.index') }}">Programas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('projetos.index') }}">Projetos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('acoes.index') }}">Ações</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('articulacoes.index') }}">Articulações</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('alunos.index') }}">Alunos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('servidores.index') }}">Servidores</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('outros.index') }}">Outros</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('conteudo')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
