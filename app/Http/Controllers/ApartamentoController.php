<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartamentoController extends Controller
{

    public function index(Request $request)
    {
        $query = Apartamento::query();

        // Pesquisa
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('referencia', 'like', "%$s%")
                    ->orWhere('tipologia', 'like', "%$s%")
                    ->orWhere('morada', 'like', "%$s%");
            });
        }

        // Ordenação
        $order = $request->get('order', 'id');
        $allowed = ['id', 'tipologia', 'area', 'preco'];
        if (in_array($order, $allowed)) {
            $query->orderBy($order);
        }

        $apartamentos = $query->paginate(10)->withQueryString();
        return view('apartamentos.index', compact('apartamentos'));
    }

    public function create()
    {
        return view('apartamentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'referencia' => 'required|string|unique:apartamentos',
            'tipologia'  => 'required|string',
            'morada'     => 'required|string',
            'area'       => 'required|numeric|min:1',
            'preco'      => 'required|numeric|min:0',
            'fotografia' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('fotografia');
        $data['estado'] = 'Disponível';

        if ($request->hasFile('fotografia')) {
            $data['fotografia'] = $request->file('fotografia')->store('apartamentos', 'public');
        }

        Apartamento::create($data);
        return redirect()->route('apartamentos.index')->with('success', 'Apartamento criado com sucesso!');
    }

    public function show(Apartamento $apartamento)
    {
        return view('apartamentos.show', compact('apartamento'));
    }

    public function edit(Apartamento $apartamento)
    {
        return view('apartamentos.edit', compact('apartamento'));
    }

    public function update(Request $request, Apartamento $apartamento)
    {
        $request->validate([
            'referencia' => 'required|string|unique:apartamentos,referencia,' . $apartamento->id,
            'tipologia'  => 'required|string',
            'morada'     => 'required|string',
            'area'       => 'required|numeric|min:1',
            'preco'      => 'required|numeric|min:0',
            'fotografia' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('fotografia');

        if ($request->hasFile('fotografia')) {
            if ($apartamento->fotografia) {
                Storage::disk('public')->delete($apartamento->fotografia);
            }
            $data['fotografia'] = $request->file('fotografia')->store('apartamentos', 'public');
        }

        $apartamento->update($data);
        return redirect()->route('apartamentos.index')->with('success', 'Apartamento atualizado com sucesso!');
    }

    public function destroy(Apartamento $apartamento)
    {
        if ($apartamento->fotografia) {
            Storage::disk('public')->delete($apartamento->fotografia);
        }
        $apartamento->delete();
        return redirect()->route('apartamentos.index')->with('success', 'Apartamento apagado com sucesso!');
    }
}
