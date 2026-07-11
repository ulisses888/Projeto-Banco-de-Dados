<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class AlunoRepository
{
    public static function alunos(): array
    {
        return DB::select('SELECT * FROM aluno');
    }

    public static function aluno_por_matricula($matricula): array
    {
        return DB::select('SELECT * FROM aluno WHERE matricula = ?', [$matricula]);
    }

    public static function adicionar_aluno($matricula, $nome, $curso)
    {
        DB::insert('INSERT INTO aluno VALUES (?, ?, ?)', [$matricula, $nome, $curso]);
    }

    public static function deletar_aluno($matricula)
    {
        DB::delete('DELETE FROM aluno WHERE matricula = ?', [$matricula]);
    }

    public static function atualizar_nome($matricula, $nome)
    {
        DB::update('UPDATE aluno SET nome = ? WHERE matricula = ?', [$nome, $matricula]);
    }

    public static function atualizar_curso($matricula, $curso)
    {
        DB::update('UPDATE aluno SET curso = ? WHERE matricula = ?', [$curso, $matricula]);
    }
}