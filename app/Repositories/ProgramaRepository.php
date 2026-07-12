<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProgramaRepository
{
    public static function programas(): array
    {
        return DB::select('SELECT * FROM programas');
    }

    public static function programa_por_codigo(int $codigo): array
    {
        return DB::select('SELECT * FROM programas WHERE codigo = ?', [$codigo]);
    }

    public static function projetos(int $codigo): array
    {
        return DB::select('SELECT * FROM programa_contem
                           INNER JOIN projetos ON programa_contem.codigo_projeto = projetos.codigo
                           WHERE codigo_programa = ?', [$codigo]);
    }

    public static function adicionar_programa(int $codigo, string $nome)
    {
        DB::insert(
            'INSERT INTO programas VALUES (?, ?)',
            [$codigo, $nome]
        );
    }

    public static function deletar_programa(int $codigo)
    {
        DB::delete('DELETE FROM programas WHERE codigo = ?', [$codigo]);
    }

    public static function adicionar_projeto(int $codigo, int $codigo_projeto)
    {
        DB::insert('INSERT INTO programa_contem VALUES (?, ?)', [$codigo, $codigo_projeto]);
    }

    public static function remover_projeto(int $codigo, int $codigo_projeto)
    {
        DB::delete('DELETE FROM programa_contem WHERE codigo_programa = ? AND codigo_projeto = ?', 
            [$codigo, $codigo_projeto]
        );
    }

    public static function atualizar_nome(int $codigo, string $nome)
    {
        DB::update('UPDATE programas SET nome = ? WHERE codigo = ?', [$nome, $codigo]);
    }
}