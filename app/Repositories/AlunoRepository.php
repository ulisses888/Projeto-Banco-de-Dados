<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class AlunoRepository
{
    public static function alunos(): array
    {
        return DB::select('SELECT * FROM alunos');
    }

    public static function aluno_por_matricula(int $matricula): array
    {
        return DB::select('SELECT * FROM alunos WHERE matricula = ?', [$matricula]);
    }

    public static function adicionar_aluno(int $matricula, string $nome, string $curso)
    {
        DB::insert('INSERT INTO alunos VALUES (?, ?, ?)', [$matricula, $nome, $curso]);
    }

    public static function deletar_aluno(int $matricula)
    {
        DB::delete('DELETE FROM alunos WHERE matricula = ?', [$matricula]);
    }

    public static function atualizar_nome(int $matricula, string $nome)
    {
        DB::update('UPDATE alunos SET nome = ? WHERE matricula = ?', [$nome, $matricula]);
    }

    public static function atualizar_curso(int $matricula, string $curso)
    {
        DB::update('UPDATE alunos SET curso = ? WHERE matricula = ?', [$curso, $matricula]);
    }
}