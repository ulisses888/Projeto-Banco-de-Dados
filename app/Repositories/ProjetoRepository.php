<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProjetoRepository
{
    public static function projetos(): array
    {
        return DB::select('SELECT * FROM projetos');
    }

    public static function projeto_por_codigo(int $codigo): array
    {
        return DB::select('SELECT * FROM projetos WHERE codigo = ?', [$codigo]);
    }

    public static function adicionar_projeto(int $codigo, string $nome, string $eixo, string $status, string $ano)
    {
        DB::insert('INSERT INTO projetos VALUES (?, ?, ?, ?, ?)', [$codigo, $nome, $eixo, $status, $ano]);
    }

    public static function deletar_projeto(int $codigo)
    {
        DB::delete('DELETE FROM projetos WHERE codigo = ?', [$codigo]);
    }

    public static function atualizar_nome(int $codigo, string $nome)
    {
        DB::update('UPDATE projetos SET nome = ? WHERE codigo = ?', [$nome, $codigo]);
    }

    public static function atualizar_eixo(int $codigo, string $eixo)
    {
        DB::update('UPDATE projetos SET eixo = ? WHERE codigo = ?', [$eixo, $codigo]);
    }

    public static function atualizar_status(int $codigo, string $status)
    {
        DB::update('UPDATE projetos SET status = ? WHERE codigo = ?', [$status, $codigo]);
    }

    public static function atualizar_ano(int $codigo, int $ano)
    {
        DB::update('UPDATE projetos SET ano = ? WHERE codigo = ?', [$ano, $codigo]);
    }

    // Relações
    
    public static function alunos(int $codigo): array
    {
        return DB::select('SELECT * FROM alunos NATURAL JOIN aluno_participa WHERE codigo = ?', [$codigo]);
    }

    public static function adicionar_aluno(int $codigo, int $matricula, bool $bolsista)
    {
        DB::insert('INSERT INTO aluno_participa VALUES (?, ?, ?)', [$matricula, $codigo, $bolsista]);
    }

    public static function remover_aluno(int $codigo, int $matricula)
    {
        DB::delete('DELETE FROM aluno_participa WHERE codigo = ? AND matricula = ?', [$codigo, $matricula]);
    }

    public static function servidores(int $codigo): array
    {
        return DB::select('SELECT * FROM servidores NATURAL JOIN servidor_participa WHERE codigo = ?', [$codigo]);
    }

    public static function adicionar_servidor(int $codigo, int $siape, bool $funcao)
    {
        DB::insert('INSERT INTO servidor_participa VALUES (?, ?, ?)', [$siape, $codigo, $funcao]);
    }

    public static function remover_servidor(int $codigo, int $siape)
    {
        DB::delete('DELETE FROM servidor_participa WHERE codigo = ? AND siape = ?', [$codigo, $siape]);
    }

    public static function outros(int $codigo): array
    {
        return DB::select('SELECT * FROM outros NATURAL JOIN outro_participa WHERE codigo = ?', [$codigo]);
    }

    public static function adicionar_outro(int $codigo, int $cpf)
    {
        DB::insert('INSERT INTO outro_participa VALUES (?, ?)', [$cpf, $codigo]);
    }

    public static function remover_outro(int $codigo, int $cpf)
    {
        DB::delete('DELETE FROM outro_participa WHERE codigo = ? AND cpf = ?', [$codigo, $cpf]);
    }
}
