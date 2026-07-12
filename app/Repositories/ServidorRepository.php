<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ServidorRepository
{
    public static function servidores(): array
    {
        return DB::select('SELECT * FROM servidores');
    }

    public static function servidor_por_siape(int $siape): array
    {
        return DB::select('SELECT * FROM servidores WHERE siape = ?', [$siape]);
    }

    public static function adicionar_servidor(int $siape, string $nome, string $unidade)
    {
        DB::insert('INSERT INTO servidores VALUES (?, ?, ?)', [$siape, $nome, $unidade]);
    }

    public static function deletar_servidor(int $siape)
    {
        DB::delete('DELETE FROM servidores WHERE siape = ?', [$siape]);
    }

    public static function atualizar_nome(int $siape, string $nome)
    {
        DB::update('UPDATE servidores SET nome = ? WHERE siape = ?', [$nome, $siape]);
    }

    public static function atualizar_unidade(int $siape, string $unidade)
    {
        DB::update('UPDATE servidores SET unidade = ? WHERE siape = ?', [$unidade, $siape]);
    }
}