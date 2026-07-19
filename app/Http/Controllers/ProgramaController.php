<?php

namespace App\Http\Controllers;

use App\Repositories\ProgramaRepository;
use App\Repositories\ProjetoRepository;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    public function index()
    {
        $programas = ProgramaRepository::programas();
        return view('programas.index', compact('programas'));
    }

    public function create()
    {
        return view('programas.form', ['programa' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        ProgramaRepository::adicionar_programa($data['nome']);

        return redirect()->route('programas.index')->with('sucesso', 'Programa cadastrado com sucesso.');
    }

    public function edit(int $codigo)
    {
        $programa = $this->buscarOuFalhar($codigo);
        return view('programas.form', compact('programa'));
    }

    public function update(Request $request, int $codigo)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        ProgramaRepository::atualizar_nome($codigo, $data['nome']);

        return redirect()->route('programas.index')->with('sucesso', 'Programa atualizado com sucesso.');
    }

    public function destroy(int $codigo)
    {
        ProgramaRepository::deletar_programa($codigo);
        return redirect()->route('programas.index')->with('sucesso', 'Programa removido com sucesso.');
    }

    public function show(int $codigo)
    {
        $programa = $this->buscarOuFalhar($codigo);
        $projetosDoPrograma = ProgramaRepository::projetos($codigo);

        $codigosNoPrograma = collect($projetosDoPrograma)->pluck('codigo')->all();
        $projetosDisponiveis = collect(ProjetoRepository::projetos())
            ->whereNotIn('codigo', $codigosNoPrograma)->values();

        return view('programas.show', compact('programa', 'projetosDoPrograma', 'projetosDisponiveis'));
    }

    public function adicionarProjeto(Request $request, int $codigo)
    {
        $data = $request->validate([
            'codigo_projeto' => 'required|integer',
        ]);

        ProgramaRepository::adicionar_projeto($codigo, (int) $data['codigo_projeto']);

        return back()->with('sucesso', 'Projeto vinculado ao programa.');
    }

    public function removerProjeto(int $codigo, int $codigo_projeto)
    {
        ProgramaRepository::remover_projeto($codigo, $codigo_projeto);
        return back()->with('sucesso', 'Projeto desvinculado do programa.');
    }

    private function buscarOuFalhar(int $codigo)
    {
        $rows = ProgramaRepository::programa_por_codigo($codigo);
        $programa = $rows[0] ?? null;
        abort_if(!$programa, 404);
        return $programa;
    }
}
