<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ArticulacaoRepository
{
    public static function articulacoes(): array
    {
        return DB::select('SELECT articulacoes.codigo, articulacoes.nome, projetos.nome AS nome_projeto FROM articulacoes INNER JOIN projetos ON articulacoes.codigo_projeto = projetos.codigo');
    }

    public static function articulacao_por_codigo(int $codigo): array
    {
        return DB::select('SELECT * FROM articulacoes WHERE codigo = ?', [$codigo]);
    }

    public static function articulacoes_do_projeto(int $codigo_projeto): array
    {
        return DB::select('SELECT * FROM articulacoes WHERE codigo_projeto = ?', [$codigo_projeto]);
    }

    public static function adicionar_articulacao(int $codigo_projeto, string $nome)
    {
        DB::insert(
            'INSERT INTO articulacoes (codigo_projeto, nome) VALUES (?, ?)',
            [$codigo_projeto, $nome]
        );
    }

    public static function deletar_articulacao(int $codigo)
    {
        DB::delete('DELETE FROM articulacoes WHERE codigo = ?', [$codigo]);
    }

    public static function atualizar_nome(int $codigo, string $nome)
    {
        DB::update('UPDATE articulacoes SET nome = ? WHERE codigo = ?', [$nome, $codigo]);
    }
}