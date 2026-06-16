<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nome',  'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('nif',   'like', "%$s%");
            });
        }

        $order = in_array($request->order, ['id', 'nome']) ? $request->order : 'id';
        $query->orderBy($order);

        $clientes = $query->paginate(10)->withQueryString();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|unique:clientes',
            'telefone' => 'required|string|max:20',
            'morada'   => 'required|string|max:255',
            'nif'      => 'required|string|size:9|unique:clientes',
        ]);
        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefone' => 'required|string|max:20',
            'morada'   => 'required|string|max:255',
            'nif'      => 'required|string|size:9|unique:clientes,nif,' . $cliente->id,
        ]);
        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente apagado com sucesso!');
    }
}
