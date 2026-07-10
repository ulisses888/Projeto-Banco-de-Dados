<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class AcaoRepository
{
    public static function acoes(): array
    {
        return DB::select('SELECT * FROM acoes');
    }

    public static function acao_por_codigo($codigo): array
    {
        return DB::select('SELECT * FROM acoes WHERE codigo = ?', [$codigo]);
    }

    public static function acoes_do_projeto($codigo_projeto): array
    {
        return DB::select('SELECT * FROM acoes WHERE codigo_projeto = ?', [$codigo_projeto]);
    }

    public static function adicionar_acao($codigo, $codigo_projeto, $titulo, $genero, $status, $descricao)
    {
        DB::insert(
            'INSERT INTO acoes VALUES (?, ?, ?, ?, ?, ?)',
            [$codigo, $codigo_projeto, $titulo, $genero, $status, $descricao]
        );
    }

    public static function deletar_acao($codigo)
    {
        DB::delete('DELETE FROM acoes WHERE codigo = ?', [$codigo]);
    }

    public static function atualizar_titulo($codigo, $titulo)
    {
        DB::update('UPDATE acoes SET titulo = ? WHERE codigo = ?', [$titulo, $codigo]);
    }

    public static function atualizar_genero($codigo, $genero)
    {
        DB::update('UPDATE acoes SET genero = ? WHERE codigo = ?', [$genero, $codigo]);
    }

    public static function atualizar_status($codigo, $status)
    {
        DB::update('UPDATE acoes SET status = ? WHERE codigo = ?', [$status, $codigo]);
    }

    public static function atualizar_descricao($codigo, $descricao)
    {
        DB::update('UPDATE acoes SET descricao = ? WHERE codigo = ?', [$descricao, $codigo]);
    }
}