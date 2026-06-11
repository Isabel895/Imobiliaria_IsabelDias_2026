<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Apartamento;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index()
    {
        $vendas = Venda::with(['cliente', 'apartamento'])->get();
        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        $clientes     = Cliente::all();
        $apartamentos = Apartamento::where('estado', 'Disponível')->get();
        return view('vendas.create', compact('clientes', 'apartamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'     => 'required|exists:clientes,id',
            'apartamento_id' => 'required|exists:apartamentos,id',
            'data_venda'     => 'required|date',
            'valor_venda'    => 'required|numeric|min:0',
            'observacoes'    => 'nullable|string',
        ]);

        $apartamento = Apartamento::findOrFail($request->apartamento_id);

        if ($apartamento->estado === 'Vendido') {
            return back()->withErrors(['apartamento_id' => 'Este apartamento já foi vendido.'])->withInput();
        }

        Venda::create($request->all());
        $apartamento->update(['estado' => 'Vendido']);

        return redirect()->route('vendas.index')->with('success', 'Venda registada com sucesso!');
    }

    public function show(Venda $venda)
    {
        return view('vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        $clientes     = Cliente::all();
        $apartamentos = Apartamento::where('estado', 'Disponível')
            ->orWhere('id', $venda->apartamento_id)
            ->get();
        return view('vendas.edit', compact('venda', 'clientes', 'apartamentos'));
    }

    public function update(Request $request, Venda $venda)
    {
        $request->validate([
            'cliente_id'     => 'required|exists:clientes,id',
            'apartamento_id' => 'required|exists:apartamentos,id',
            'data_venda'     => 'required|date',
            'valor_venda'    => 'required|numeric|min:0',
            'observacoes'    => 'nullable|string',
        ]);

        $venda->update($request->all());
        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        // Repõe o apartamento como disponível
        $venda->apartamento->update(['estado' => 'Disponível']);
        $venda->delete();
        return redirect()->route('vendas.index')->with('success', 'Venda apagada com sucesso!');
    }
}
