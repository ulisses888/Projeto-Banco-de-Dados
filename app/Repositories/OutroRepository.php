<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class OutroRepository
{
    public static function outros(): array
    {
        return DB::select('SELECT * FROM outros');
    }

    public static function outro_por_cpf(string $cpf): array
    {
        return DB::select('SELECT * FROM outros WHERE cpf = ?', [$cpf]);
    }

    public static function adicionar_outro(string $cpf, string $nome)
    {
        DB::insert('INSERT INTO outros VALUES (?, ?)', [$cpf, $nome]);
    }

    public static function deletar_outro(string $cpf)
    {
        DB::delete('DELETE FROM outros WHERE cpf = ?', [$cpf]);
    }

    public static function atualizar_nome(string $cpf, string $nome)
    {
        DB::update('UPDATE outros SET nome = ? WHERE cpf = ?', [$nome, $cpf]);
    }
}