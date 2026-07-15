@extends('layouts.app')
@section('titulo', 'Projeto: ' . $projeto->nome)
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 m-0">{{ $projeto->nome }}</h1>
            <small class="text-muted">Código {{ $projeto->codigo }} · {{ $projeto->eixo }} · {{ $projeto->status }} · {{ $projeto->ano }}</small>
        </div>
        <a href="{{ route('projetos.edit', $projeto->codigo) }}" class="btn btn-outline-secondary">Editar projeto</a>
    </div>

    <div class="row g-4">
        {{-- ALUNOS --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Alunos na equipe</div>
                <ul class="list-group list-group-flush">
                    @forelse($alunosDoProjeto as $aluno)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $aluno->nome }} ({{ $aluno->matricula }}) {{ $aluno->bolsista ? '- bolsista' : '' }}</span>
                            <form action="{{ route('projetos.alunos.remover', [$projeto->codigo, $aluno->matricula]) }}" method="POST" onsubmit="return confirm('Remover aluno da equipe?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Remover</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Nenhum aluno na equipe.</li>
                    @endforelse
                </ul>
                <div class="card-body">
                    <form action="{{ route('projetos.alunos.adicionar', $projeto->codigo) }}" method="POST" class="row g-2">
                        @csrf
                        <div class="col-7">
                            <select name="matricula" class="form-select" required>
                                <option value="">Selecione um aluno...</option>
                                @foreach($alunosDisponiveis as $aluno)
                                    <option value="{{ $aluno->matricula }}">{{ $aluno->nome }} ({{ $aluno->matricula }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 form-check mt-2">
                            <input type="checkbox" name="bolsista" value="1" class="form-check-input" id="bolsista">
                            <label class="form-check-label" for="bolsista">Bolsista</label>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary w-100">+</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- SERVIDORES --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Servidores na equipe</div>
                <ul class="list-group list-group-flush">
                    @forelse($servidoresDoProjeto as $servidor)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $servidor->nome }} ({{ $servidor->siape }}) {{ $servidor->funcao ? '- coordenador' : '' }}</span>
                            <form action="{{ route('projetos.servidores.remover', [$projeto->codigo, $servidor->siape]) }}" method="POST" onsubmit="return confirm('Remover servidor da equipe?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Remover</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Nenhum servidor na equipe.</li>
                    @endforelse
                </ul>
                <div class="card-body">
                    <form action="{{ route('projetos.servidores.adicionar', $projeto->codigo) }}" method="POST" class="row g-2">
                        @csrf
                        <div class="col-7">
                            <select name="siape" class="form-select" required>
                                <option value="">Selecione um servidor...</option>
                                @foreach($servidoresDisponiveis as $servidor)
                                    <option value="{{ $servidor->siape }}">{{ $servidor->nome }} ({{ $servidor->siape }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 form-check mt-2">
                            <input type="checkbox" name="funcao" value="1" class="form-check-input" id="funcao">
                            <label class="form-check-label" for="funcao">Coordenador</label>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary w-100">+</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- OUTROS --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Outros participantes</div>
                <ul class="list-group list-group-flush">
                    @forelse($outrosDoProjeto as $outro)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $outro->nome }} ({{ $outro->cpf }})</span>
                            <form action="{{ route('projetos.outros.remover', [$projeto->codigo, $outro->cpf]) }}" method="POST" onsubmit="return confirm('Remover participante da equipe?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Remover</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Nenhum outro participante.</li>
                    @endforelse
                </ul>
                <div class="card-body">
                    <form action="{{ route('projetos.outros.adicionar', $projeto->codigo) }}" method="POST" class="row g-2">
                        @csrf
                        <div class="col-10">
                            <select name="cpf" class="form-select" required>
                                <option value="">Selecione...</option>
                                @foreach($outrosDisponiveis as $outro)
                                    <option value="{{ $outro->cpf }}">{{ $outro->nome }} ({{ $outro->cpf }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary w-100">+</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- AÇÕES E ARTICULAÇÕES --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Ações do projeto
                    <a href="{{ route('acoes.create') }}" class="btn btn-sm btn-outline-primary">Nova ação</a>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($acoes as $acao)
                        <li class="list-group-item">
                            <a href="{{ route('acoes.edit', $acao->codigo) }}">{{ $acao->titulo }}</a>
                            <span class="badge bg-secondary">{{ $acao->status }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Nenhuma ação cadastrada.</li>
                    @endforelse
                </ul>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Articulações do projeto
                    <a href="{{ route('articulacoes.create') }}" class="btn btn-sm btn-outline-primary">Nova articulação</a>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($articulacoes as $articulacao)
                        <li class="list-group-item">
                            <a href="{{ route('articulacoes.edit', $articulacao->codigo) }}">{{ $articulacao->nome }}</a>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Nenhuma articulação cadastrada.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
