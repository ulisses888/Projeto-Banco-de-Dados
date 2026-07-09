<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProjetoRepository
{
    public static function projetos(): array
    {
        return DB::select('SELECT * FROM projetos');
    }

    public static function projeto_por_codigo($codigo): array
    {
        return DB::select('SELECT * FROM projetos WHERE codigo = ?', [$codigo]);
    }

    public static function adicionar_projeto($codigo, $nome, $eixo, $status, $ano)
    {
        DB::insert('INSERT INTO projetos VALUES (?, ?, ?, ?, ?)', [$codigo, $nome, $eixo, $status, $ano]);
    }

    public static function deletar_projeto($codigo)
    {
        DB::insert('DELETE FROM projetos WHERE codigo = ?', [$codigo]);
    }

    public static function atualizar_nome($codigo, $nome)
    {
        DB::insert('UPDATE projetos SET nome = ? WHERE codigo = ?', [$nome, $codigo]);
    }

    public static function atualizar_eixo($codigo, $eixo)
    {
        DB::insert('UPDATE projetos SET eixo = ? WHERE codigo = ?', [$nome, $eixo]);
    }

    public static function atualizar_status($codigo, $status)
    {
        DB::insert('UPDATE projetos SET status = ? WHERE codigo = ?', [$status, $codigo]);
    }

    public static function atualizar_ano($codigo, $ano)
    {
        DB::insert('UPDATE projetos SET ano = ? WHERE codigo = ?', [$ano, $codigo]);
    }
}
