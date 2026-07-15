<?php

namespace App\Http\Controllers;

use App\Repositories\ServidorRepository;
use Illuminate\Http\Request;

class ServidorController extends Controller
{
    public function index()
    {
        $servidores = ServidorRepository::servidores();
        return view('servidores.index', compact('servidores'));
    }

    public function create()
    {
        return view('servidores.form', ['servidor' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'siape' => 'required|integer',
            'nome' => 'required|string|max:255',
            'unidade' => 'required|string|max:255',
        ]);

        if (ServidorRepository::servidor_por_siape((int) $data['siape'])) {
            return back()->withInput()->withErrors(['siape' => 'Já existe um servidor com esse SIAPE.']);
        }

        ServidorRepository::adicionar_servidor((int) $data['siape'], $data['nome'], $data['unidade']);

        return redirect()->route('servidores.index')->with('sucesso', 'Servidor cadastrado com sucesso.');
    }

    public function edit(int $siape)
    {
        $rows = ServidorRepository::servidor_por_siape($siape);
        $servidor = $rows[0] ?? null;
        abort_if(!$servidor, 404);

        return view('servidores.form', compact('servidor'));
    }

    public function update(Request $request, int $siape)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'unidade' => 'required|string|max:255',
        ]);

        ServidorRepository::atualizar_nome($siape, $data['nome']);
        ServidorRepository::atualizar_unidade($siape, $data['unidade']);

        return redirect()->route('servidores.index')->with('sucesso', 'Servidor atualizado com sucesso.');
    }

    public function destroy(int $siape)
    {
        ServidorRepository::deletar_servidor($siape);
        return redirect()->route('servidores.index')->with('sucesso', 'Servidor removido com sucesso.');
    }
}
