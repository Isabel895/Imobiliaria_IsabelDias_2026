<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Apartamento;
use App\Models\Venda;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes        = Cliente::count();
        $totalApartamentos     = Apartamento::count();
        $apartamentosVendidos  = Apartamento::where('estado', 'Vendido')->count();
        $totalVendas           = Venda::sum('valor_venda');

        // Estatísticas mensais dos últimos 12 meses
        $meses = collect(range(11, 0))->map(function ($i) {
            return Carbon::now()->startOfMonth()->subMonths($i);
        });

        $clientesPorMes = $this->contagemMensal(Cliente::class, $meses);
        $apartamentosPorMes = $this->contagemMensal(Apartamento::class, $meses);
        $vendasPorMes = $this->contagemMensal(Venda::class, $meses, 'data_venda');

        $nomesMeses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        $mensalLabels = $meses->map(fn ($m) => $nomesMeses[$m->month - 1] . '/' . $m->format('y'))->values();

        return view('dashboard', compact(
            'totalClientes',
            'totalApartamentos',
            'apartamentosVendidos',
            'totalVendas',
            'mensalLabels',
            'clientesPorMes',
            'apartamentosPorMes',
            'vendasPorMes'
        ));
    }

    /**
     * Conta os registos de um modelo, agrupados por mês, para a lista de meses indicada.
     */
    private function contagemMensal(string $modelClass, $meses, string $coluna = 'created_at')
    {
        $registos = $modelClass::selectRaw("DATE_FORMAT($coluna, '%Y-%m') as ym, COUNT(*) as total")
            ->groupBy('ym')
            ->pluck('total', 'ym');

        return $meses->map(function ($mes) use ($registos) {
            return $registos->get($mes->format('Y-m'), 0);
        })->values();
    }
}
