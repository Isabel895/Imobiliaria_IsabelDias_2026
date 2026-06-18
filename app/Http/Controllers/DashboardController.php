<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Apartamento;
use App\Models\Venda;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes        = Cliente::count();
        $totalApartamentos     = Apartamento::count();
        $apartamentosVendidos  = Apartamento::where('estado', 'Vendido')->count();
        $totalVendas           = Venda::sum('valor_venda');

        return view('dashboard', compact(
            'totalClientes',
            'totalApartamentos',
            'apartamentosVendidos',
            'totalVendas'
        ));
    }
}
