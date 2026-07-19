<?php

namespace App\Http\Controllers;

use App\Repositories\ArticulacaoRepository;
use App\Repositories\ProjetoRepository;
use Illuminate\Http\Request;

class ArticulacaoController extends Controller
{
    public function index()
    {
        $articulacoes = ArticulacaoRepository::articulacoes();
        return view('articulacoes.index', compact('articulacoes'));
    }

    public function create()
    {
        $projetos = ProjetoRepository::projetos();
        return view('articulacoes.form', ['articulacao' => null, 'projetos' => $projetos]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo_projeto' => 'required|integer',
            'nome' => 'required|string|max:255',
        ]);

        ArticulacaoRepository::adicionar_articulacao(
            (int) $data['codigo_projeto'], $data['nome']
        );

        return redirect()->route('articulacoes.index')->with('sucesso', 'Articulação cadastrada com sucesso.');
    }

    public function edit(int $codigo)
    {
        $rows = ArticulacaoRepository::articulacao_por_codigo($codigo);
        $articulacao = $rows[0] ?? null;
        abort_if(!$articulacao, 404);

        return view('articulacoes.form', ['articulacao' => $articulacao, 'projetos' => []]);
    }

    public function update(Request $request, int $codigo)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        ArticulacaoRepository::atualizar_nome($codigo, $data['nome']);

        return redirect()->route('articulacoes.index')->with('sucesso', 'Articulação atualizada com sucesso.');
    }

    public function destroy(int $codigo)
    {
        ArticulacaoRepository::deletar_articulacao($codigo);
        return redirect()->route('articulacoes.index')->with('sucesso', 'Articulação removida com sucesso.');
    }
}
