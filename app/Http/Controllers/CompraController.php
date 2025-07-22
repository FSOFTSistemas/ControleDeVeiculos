<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Fornecedor;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CompraController extends Controller
{
    public function index()
    {
        try {
            $compras = Compra::orderByDesc('data_compra')->get();
            return view('compras.index', compact('compras'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao listar compras: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $veiculos = Veiculo::where('empresa_id', Auth::user()->empresa_id)->get();
            $fornecedores = Fornecedor::where('empresa_id', Auth::user()->empresa_id)->get();
            return view('compras._form', compact('veiculos', 'fornecedores'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar formulário: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'fornecedor_id' => 'required|exists:fornecedors,id',
            'data_compra' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string|max:50',
            'observacoes' => 'nullable|string',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'date' => 'O campo :attribute deve ser uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $validated['empresa_id'] = Auth::user()->empresa_id;
            Compra::create($validated);

            return redirect()->route('compras.index')->with('success', 'Compra registrada com sucesso!');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao registrar compra: ' . $e->getMessage())->withInput();
        }
    }

   

    public function edit(Compra $compra)
    {
        try {
            $veiculos = Veiculo::where('empresa_id', Auth::user()->empresa_id)->get();
            $fornecedores = Fornecedor::where('empresa_id', Auth::user()->empresa_id)->get();
            return view('compras._form', compact('compra', 'veiculos', 'fornecedores'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Compra $compra)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'fornecedor_id' => 'required|exists:fornecedors,id',
            'data_compra' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string|max:50',
            'observacoes' => 'nullable|string',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'date' => 'O campo :attribute deve ser uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $compra->update($validated);

            return redirect()->route('compras.index')->with('success', 'Compra atualizada com sucesso!');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar compra: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Compra $compra)
    {
        try {
            $compra->delete();
            return redirect()->route('compras.index')->with('success', 'Compra removida com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover compra: ' . $e->getMessage());
        }
    }
}
