<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\OutroController;
use App\Http\Controllers\ArticulacaoController;
use App\Http\Controllers\AcaoController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\ProgramaController;
use Illuminate\Support\Facades\Route;

// Alunos
Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index');
Route::get('/alunos/novo', [AlunoController::class, 'create'])->name('alunos.create');
Route::post('/alunos', [AlunoController::class, 'store'])->name('alunos.store');
Route::get('/alunos/{matricula}/editar', [AlunoController::class, 'edit'])->name('alunos.edit');
Route::put('/alunos/{matricula}', [AlunoController::class, 'update'])->name('alunos.update');
Route::delete('/alunos/{matricula}', [AlunoController::class, 'destroy'])->name('alunos.destroy');

// Servidores
Route::get('/servidores', [ServidorController::class, 'index'])->name('servidores.index');
Route::get('/servidores/novo', [ServidorController::class, 'create'])->name('servidores.create');
Route::post('/servidores', [ServidorController::class, 'store'])->name('servidores.store');
Route::get('/servidores/{siape}/editar', [ServidorController::class, 'edit'])->name('servidores.edit');
Route::put('/servidores/{siape}', [ServidorController::class, 'update'])->name('servidores.update');
Route::delete('/servidores/{siape}', [ServidorController::class, 'destroy'])->name('servidores.destroy');

// Outros participantes
Route::get('/outros', [OutroController::class, 'index'])->name('outros.index');
Route::get('/outros/novo', [OutroController::class, 'create'])->name('outros.create');
Route::post('/outros', [OutroController::class, 'store'])->name('outros.store');
Route::get('/outros/{cpf}/editar', [OutroController::class, 'edit'])->name('outros.edit');
Route::put('/outros/{cpf}', [OutroController::class, 'update'])->name('outros.update');
Route::delete('/outros/{cpf}', [OutroController::class, 'destroy'])->name('outros.destroy');

// Articulações
Route::get('/articulacoes', [ArticulacaoController::class, 'index'])->name('articulacoes.index');
Route::get('/articulacoes/nova', [ArticulacaoController::class, 'create'])->name('articulacoes.create');
Route::post('/articulacoes', [ArticulacaoController::class, 'store'])->name('articulacoes.store');
Route::get('/articulacoes/{codigo}/editar', [ArticulacaoController::class, 'edit'])->name('articulacoes.edit');
Route::put('/articulacoes/{codigo}', [ArticulacaoController::class, 'update'])->name('articulacoes.update');
Route::delete('/articulacoes/{codigo}', [ArticulacaoController::class, 'destroy'])->name('articulacoes.destroy');

// Ações
Route::get('/acoes', [AcaoController::class, 'index'])->name('acoes.index');
Route::get('/acoes/nova', [AcaoController::class, 'create'])->name('acoes.create');
Route::post('/acoes', [AcaoController::class, 'store'])->name('acoes.store');
Route::get('/acoes/{codigo}/editar', [AcaoController::class, 'edit'])->name('acoes.edit');
Route::put('/acoes/{codigo}', [AcaoController::class, 'update'])->name('acoes.update');
Route::delete('/acoes/{codigo}', [AcaoController::class, 'destroy'])->name('acoes.destroy');

// Projetos
Route::get('/projetos', [ProjetoController::class, 'index'])->name('projetos.index');
Route::get('/projetos/novo', [ProjetoController::class, 'create'])->name('projetos.create');
Route::post('/projetos', [ProjetoController::class, 'store'])->name('projetos.store');
Route::get('/projetos/{codigo}', [ProjetoController::class, 'show'])->name('projetos.show');
Route::get('/projetos/{codigo}/editar', [ProjetoController::class, 'edit'])->name('projetos.edit');
Route::put('/projetos/{codigo}', [ProjetoController::class, 'update'])->name('projetos.update');
Route::delete('/projetos/{codigo}', [ProjetoController::class, 'destroy'])->name('projetos.destroy');

// Equipe do projeto
Route::post('/projetos/{codigo}/alunos', [ProjetoController::class, 'adicionarAluno'])->name('projetos.alunos.adicionar');
Route::delete('/projetos/{codigo}/alunos/{matricula}', [ProjetoController::class, 'removerAluno'])->name('projetos.alunos.remover');
Route::post('/projetos/{codigo}/servidores', [ProjetoController::class, 'adicionarServidor'])->name('projetos.servidores.adicionar');
Route::delete('/projetos/{codigo}/servidores/{siape}', [ProjetoController::class, 'removerServidor'])->name('projetos.servidores.remover');
Route::post('/projetos/{codigo}/outros', [ProjetoController::class, 'adicionarOutro'])->name('projetos.outros.adicionar');
Route::delete('/projetos/{codigo}/outros/{cpf}', [ProjetoController::class, 'removerOutro'])->name('projetos.outros.remover');

// Programas
Route::get('/programas', [ProgramaController::class, 'index'])->name('programas.index');
Route::get('/programas/novo', [ProgramaController::class, 'create'])->name('programas.create');
Route::post('/programas', [ProgramaController::class, 'store'])->name('programas.store');
Route::get('/programas/{codigo}', [ProgramaController::class, 'show'])->name('programas.show');
Route::get('/programas/{codigo}/editar', [ProgramaController::class, 'edit'])->name('programas.edit');
Route::put('/programas/{codigo}', [ProgramaController::class, 'update'])->name('programas.update');
Route::delete('/programas/{codigo}', [ProgramaController::class, 'destroy'])->name('programas.destroy');

// Projetos do programa
Route::post('/programas/{codigo}/projetos', [ProgramaController::class, 'adicionarProjeto'])->name('programas.projetos.adicionar');
Route::delete('/programas/{codigo}/projetos/{codigo_projeto}', [ProgramaController::class, 'removerProjeto'])->name('programas.projetos.remover');


Route::get('/', function () {
    return view('window');
});

Route::get('/teste', function () {
    return view('window');
});

