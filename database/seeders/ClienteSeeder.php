<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::insert([
            ['nome' => 'Ana Silva',    'email' => 'ana@email.com',   'telefone' => '912000001', 'morada' => 'Rua A, Lisboa',  'nif' => '123456789', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bruno Costa',  'email' => 'bruno@email.com', 'telefone' => '913000002', 'morada' => 'Av. B, Porto',   'nif' => '234567890', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Carla Mendes', 'email' => 'carla@email.com', 'telefone' => '914000003', 'morada' => 'Rua C, Braga',   'nif' => '345678901', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
