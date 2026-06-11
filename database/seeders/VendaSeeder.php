<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Venda;
use App\Models\Apartamento;

class VendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Venda::create([
            'cliente_id'     => 1,
            'apartamento_id' => 1,
            'data_venda'     => '2025-03-15',
            'valor_venda'    => 248000,
            'observacoes'    => 'Pagamento a pronto.',
        ]);
        Apartamento::find(1)->update(['estado' => 'Vendido']);
    }
}
