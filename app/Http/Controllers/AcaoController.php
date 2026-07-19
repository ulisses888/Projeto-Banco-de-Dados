<?php

namespace App\Http\Controllers;

use App\Repositories\AcaoRepository;
use App\Repositories\ProjetoRepository;
use Illuminate\Http\Request;

class AcaoController extends Controller
{
    public function index()
    {
        $acoes = AcaoRepository::acoes();
        return view('acoes.index', compact('acoes'));
    }

    public function create()
    {
        $projetos = ProjetoRepository::projetos();
        return view('acoes.form', ['acao' => null, 'projetos' => $projetos]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo_projeto' => 'required|integer',
            'titulo' => 'required|string|max:255',
            'genero' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'descricao' => 'required|string',
        ]);

        AcaoRepository::adicionar_acao(
            (int) $data['codigo_projeto'],
            $data['titulo'], $data['genero'], $data['status'], $data['descricao']
        );

        return redirect()->route('acoes.index')->with('sucesso', 'Ação cadastrada com sucesso.');
    }

    public function edit(int $codigo)
    {
        $rows = AcaoRepository::acao_por_codigo($codigo);
        $acao = $rows[0] ?? null;
        abort_if(!$acao, 404);

        return view('acoes.form', ['acao' => $acao, 'projetos' => []]);
    }

    public function update(Request $request, int $codigo)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'genero' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'descricao' => 'required|string',
        ]);

        AcaoRepository::atualizar_titulo($codigo, $data['titulo']);
        AcaoRepository::atualizar_genero($codigo, $data['genero']);
        AcaoRepository::atualizar_status($codigo, $data['status']);
        AcaoRepository::atualizar_descricao($codigo, $data['descricao']);

        return redirect()->route('acoes.index')->with('sucesso', 'Ação atualizada com sucesso.');
    }

    public function destroy(int $codigo)
    {
        AcaoRepository::deletar_acao($codigo);
        return redirect()->route('acoes.index')->with('sucesso', 'Ação removida com sucesso.');
    }
}
