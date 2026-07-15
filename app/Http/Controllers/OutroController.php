<?php

namespace App\Http\Controllers;

use App\Repositories\OutroRepository;
use Illuminate\Http\Request;

class OutroController extends Controller
{
    public function index()
    {
        $outros = OutroRepository::outros();
        return view('outros.index', compact('outros'));
    }

    public function create()
    {
        return view('outros.form', ['outro' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cpf' => 'required|string|max:14',
            'nome' => 'required|string|max:255',
        ]);

        if (OutroRepository::outro_por_cpf($data['cpf'])) {
            return back()->withInput()->withErrors(['cpf' => 'Já existe um registro com esse CPF.']);
        }

        OutroRepository::adicionar_outro($data['cpf'], $data['nome']);

        return redirect()->route('outros.index')->with('sucesso', 'Registro cadastrado com sucesso.');
    }

    public function edit(string $cpf)
    {
        $rows = OutroRepository::outro_por_cpf($cpf);
        $outro = $rows[0] ?? null;
        abort_if(!$outro, 404);

        return view('outros.form', compact('outro'));
    }

    public function update(Request $request, string $cpf)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        OutroRepository::atualizar_nome($cpf, $data['nome']);

        return redirect()->route('outros.index')->with('sucesso', 'Registro atualizado com sucesso.');
    }

    public function destroy(string $cpf)
    {
        OutroRepository::deletar_outro($cpf);
        return redirect()->route('outros.index')->with('sucesso', 'Registro removido com sucesso.');
    }
}
