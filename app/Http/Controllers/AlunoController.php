<?php

namespace App\Http\Controllers;

use App\Repositories\AlunoRepository;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = AlunoRepository::alunos();
        return view('alunos.index', compact('alunos'));
    }

    public function create()
    {
        return view('alunos.form', ['aluno' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'matricula' => 'required|integer',
            'nome' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
        ]);

        if (AlunoRepository::aluno_por_matricula((int) $data['matricula'])) {
            return back()->withInput()->withErrors(['matricula' => 'Já existe um aluno com essa matrícula.']);
        }

        AlunoRepository::adicionar_aluno((int) $data['matricula'], $data['nome'], $data['curso']);

        return redirect()->route('alunos.index')->with('sucesso', 'Aluno cadastrado com sucesso.');
    }

    public function edit(int $matricula)
    {
        $rows = AlunoRepository::aluno_por_matricula($matricula);
        $aluno = $rows[0] ?? null;
        abort_if(!$aluno, 404);

        return view('alunos.form', compact('aluno'));
    }

    public function update(Request $request, int $matricula)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
        ]);

        AlunoRepository::atualizar_nome($matricula, $data['nome']);
        AlunoRepository::atualizar_curso($matricula, $data['curso']);

        return redirect()->route('alunos.index')->with('sucesso', 'Aluno atualizado com sucesso.');
    }

    public function destroy(int $matricula)
    {
        AlunoRepository::deletar_aluno($matricula);
        return redirect()->route('alunos.index')->with('sucesso', 'Aluno removido com sucesso.');
    }
}
