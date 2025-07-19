<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VendaController extends Controller
{
    public function index()
    {
        try {
            $vendas = Venda::with('veiculo', 'cliente')->orderByDesc('data_venda')->paginate(15);
            return view('vendas.index', compact('vendas'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao listar vendas: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('vendas.create');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao abrir o formulário: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'data_venda' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string|max:50',
            'observacoes' => 'nullable|string',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            Venda::create($validated);

            return redirect()->route('vendas.index')->with('success', 'Venda registrada com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao registrar venda: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Venda $venda)
    {
        try {
            return view('vendas.show', compact('venda'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao exibir a venda: ' . $e->getMessage());
        }
    }

    public function edit(Venda $venda)
    {
        try {
            return view('vendas.edit', compact('venda'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao abrir o formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Venda $venda)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'data_venda' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string|max:50',
            'observacoes' => 'nullable|string',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $venda->update($validated);

            return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar venda: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Venda $venda)
    {
        try {
            $venda->delete();
            return redirect()->route('vendas.index')->with('success', 'Venda removida com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover venda: ' . $e->getMessage());
        }
    }
}
