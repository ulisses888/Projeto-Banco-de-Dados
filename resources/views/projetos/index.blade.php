<div class="card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Projetos</h2>
        <div>
            <form method="GET" action="/projetos" class="d-inline">
                <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}" class="form-control d-inline" style="width:200px; display:inline;">
                <button class="btn btn-outline-secondary">Buscar</button>
            </form>
            <a href="/projetos/novo" class="btn btn-primary">+ Novo</a>
        </div>
    </div>
    
    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Eixo</th>
                <th>Status</th>
                <th>Ano</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projetos as $p)
            <tr>
                <td>{{ $p->codigo }}</td>
                <td>{{ $p->nome }}</td>
                <td>{{ $p->eixo }}</td>
                <td><span class="badge bg-{{ $p->status == 'Ativo' ? 'success' : 'secondary' }}">{{ $p->status }}</span></td>
                <td>{{ $p->ano }}</td>
                <td>
                    <a href="/projetos/{{ $p->codigo }}/editar" class="btn btn-sm btn-warning">Editar</a>
                    <form action="/projetos/{{ $p->codigo }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este projeto?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Nenhum projeto cadastrado</td></tr>
            @endforelse
        </tbody>
    </table>
</div>