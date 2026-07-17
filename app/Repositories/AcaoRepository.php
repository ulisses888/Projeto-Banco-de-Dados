<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class AcaoRepository
{
    public static function acoes(): array
    {
        return DB::select('SELECT * FROM acoes INNER JOIN projetos ON acoes.codigo_projeto = projetos.codigo');
    }

    public static function acao_por_codigo(int $codigo): array
    {
        return DB::select('SELECT * FROM acoes WHERE codigo = ?', [$codigo]);
    }

    public static function acoes_do_projeto(int $codigo_projeto): array
    {
        return DB::select('SELECT * FROM acoes WHERE codigo_projeto = ?', [$codigo_projeto]);
    }

    public static function adicionar_acao(
        int $codigo,int $codigo_projeto, string $titulo, string $genero, string $status, string $descricao
    ) {
        DB::insert(
            'INSERT INTO acoes VALUES (?, ?, ?, ?, ?, ?)',
            [$codigo, $codigo_projeto, $titulo, $genero, $status, $descricao]
        );
    }

    public static function deletar_acao(int $codigo)
    {
        DB::delete('DELETE FROM acoes WHERE codigo = ?', [$codigo]);
    }

    public static function atualizar_titulo(int $codigo, string $titulo)
    {
        DB::update('UPDATE acoes SET titulo = ? WHERE codigo = ?', [$titulo, $codigo]);
    }

    public static function atualizar_genero(int $codigo, string $genero)
    {
        DB::update('UPDATE acoes SET genero = ? WHERE codigo = ?', [$genero, $codigo]);
    }

    public static function atualizar_status(int $codigo, string $status)
    {
        DB::update('UPDATE acoes SET status = ? WHERE codigo = ?', [$status, $codigo]);
    }

    public static function atualizar_descricao(int $codigo, string $descricao)
    {
        DB::update('UPDATE acoes SET descricao = ? WHERE codigo = ?', [$descricao, $codigo]);
    }
}