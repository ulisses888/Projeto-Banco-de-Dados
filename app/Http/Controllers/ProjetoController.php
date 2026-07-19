<?php

namespace App\Http\Controllers;

use App\Repositories\ProjetoRepository;
use App\Repositories\AlunoRepository;
use App\Repositories\ServidorRepository;
use App\Repositories\OutroRepository;
use App\Repositories\ArticulacaoRepository;
use App\Repositories\AcaoRepository;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    public function index(Request $request)
    {
        $termo = $request->query('search');

        $projetos = $termo
            ? ProjetoRepository::buscar_projetos($termo)
            : ProjetoRepository::projetos();

        return view('projetos.index', compact('projetos'));
    }

    public function create()
    {
        return view('projetos.form', ['projeto' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'eixo' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'ano' => 'required|string|max:10',
        ]);

        ProjetoRepository::adicionar_projeto(
            $data['nome'], $data['eixo'], $data['status'], $data['ano']
        );

        return redirect()->route('projetos.index')->with('sucesso', 'Projeto cadastrado com sucesso.');
    }

    public function edit(int $codigo)
    {
        $projeto = $this->buscarOuFalhar($codigo);
        return view('projetos.form', compact('projeto'));
    }

    public function update(Request $request, int $codigo)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'eixo' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'ano' => 'required|integer',
        ]);

        ProjetoRepository::atualizar_nome($codigo, $data['nome']);
        ProjetoRepository::atualizar_eixo($codigo, $data['eixo']);
        ProjetoRepository::atualizar_status($codigo, $data['status']);
        ProjetoRepository::atualizar_ano($codigo, (int) $data['ano']);

        return redirect()->route('projetos.index')->with('sucesso', 'Projeto atualizado com sucesso.');
    }

    public function destroy(int $codigo)
    {
        ProjetoRepository::deletar_projeto($codigo);
        return redirect()->route('projetos.index')->with('sucesso', 'Projeto removido com sucesso.');
    }

    // Tela de detalhes / gestão de equipe, ações e articulações
    public function show(int $codigo)
    {
        $projeto = $this->buscarOuFalhar($codigo);

        $alunosDoProjeto = ProjetoRepository::alunos($codigo);
        $servidoresDoProjeto = ProjetoRepository::servidores($codigo);
        $outrosDoProjeto = ProjetoRepository::outros($codigo);
        $acoes = AcaoRepository::acoes_do_projeto($codigo);
        $articulacoes = ArticulacaoRepository::articulacoes_do_projeto($codigo);

        // Para os selects de "adicionar", pega todo mundo que ainda não está no projeto
        $matriculasNoProjeto = collect($alunosDoProjeto)->pluck('matricula')->all();
        $siapesNoProjeto = collect($servidoresDoProjeto)->pluck('siape')->all();
        $cpfsNoProjeto = collect($outrosDoProjeto)->pluck('cpf')->all();

        $alunosDisponiveis = collect(AlunoRepository::alunos())
            ->whereNotIn('matricula', $matriculasNoProjeto)->values();
        $servidoresDisponiveis = collect(ServidorRepository::servidores())
            ->whereNotIn('siape', $siapesNoProjeto)->values();
        $outrosDisponiveis = collect(OutroRepository::outros())
            ->whereNotIn('cpf', $cpfsNoProjeto)->values();

        return view('projetos.show', compact(
            'projeto', 'alunosDoProjeto', 'servidoresDoProjeto', 'outrosDoProjeto',
            'acoes', 'articulacoes', 'alunosDisponiveis', 'servidoresDisponiveis', 'outrosDisponiveis'
        ));
    }

    public function adicionarAluno(Request $request, int $codigo)
    {
        $data = $request->validate([
            'matricula' => 'required|integer',
            'bolsista' => 'nullable|boolean',
        ]);

        ProjetoRepository::adicionar_aluno($codigo, (int) $data['matricula'], (bool) ($data['bolsista'] ?? false));

        return back()->with('sucesso', 'Aluno adicionado à equipe.');
    }

    public function removerAluno(int $codigo, int $matricula)
    {
        ProjetoRepository::remover_aluno($codigo, $matricula);
        return back()->with('sucesso', 'Aluno removido da equipe.');
    }

    public function adicionarServidor(Request $request, int $codigo)
    {
        $data = $request->validate([
            'siape' => 'required|integer',
            'funcao' => 'nullable|boolean',
        ]);

        ProjetoRepository::adicionar_servidor($codigo, (int) $data['siape'], (bool) ($data['funcao'] ?? false));

        return back()->with('sucesso', 'Servidor adicionado à equipe.');
    }

    public function removerServidor(int $codigo, int $siape)
    {
        ProjetoRepository::remover_servidor($codigo, $siape);
        return back()->with('sucesso', 'Servidor removido da equipe.');
    }

    public function adicionarOutro(Request $request, int $codigo)
    {
        $data = $request->validate([
            'cpf' => 'required|string|max:14',
        ]);

        ProjetoRepository::adicionar_outro($codigo, $data['cpf']);

        return back()->with('sucesso', 'Participante adicionado à equipe.');
    }

    public function removerOutro(int $codigo, string $cpf)
    {
        ProjetoRepository::remover_outro($codigo, $cpf);
        return back()->with('sucesso', 'Participante removido da equipe.');
    }

    private function buscarOuFalhar(int $codigo)
    {
        $rows = ProjetoRepository::projeto_por_codigo($codigo);
        $projeto = $rows[0] ?? null;
        abort_if(!$projeto, 404);
        return $projeto;
    }
}
