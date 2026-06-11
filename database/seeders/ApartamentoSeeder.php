<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartamento;

class ApartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Apartamento::insert([
            ['referencia' => 'APT001', 'tipologia' => 'T2', 'morada' => 'Rua das Flores 10, Lisboa',  'area' => 80, 'preco' => 250000, 'estado' => 'Disponível', 'created_at' => now(), 'updated_at' => now()],
            ['referencia' => 'APT002', 'tipologia' => 'T3', 'morada' => 'Av. da Liberdade 5, Porto',  'area' => 110, 'preco' => 320000, 'estado' => 'Disponível', 'created_at' => now(), 'updated_at' => now()],
            ['referencia' => 'APT003', 'tipologia' => 'T1', 'morada' => 'Rua Nova 3, Braga',          'area' => 55, 'preco' => 150000, 'estado' => 'Disponível', 'created_at' => now(), 'updated_at' => now()],
            ['referencia' => 'APT004', 'tipologia' => 'T0', 'morada' => 'Praça Central 1, Coimbra',   'area' => 35, 'preco' => 90000, 'estado' => 'Disponível', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
