<?php

namespace App\Http\Controllers;

use App\Models\FluxoDeCaixa;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FluxoDeCaixaController extends Controller
{
    public function index()
    {
        try {
            $fluxos = FluxoDeCaixa::orderByDesc('data')->paginate(15);
            return view('fluxo_caixa.index', compact('fluxos'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao listar lançamentos do caixa: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('fluxo_caixa.create');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar o formulário: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'data' => 'required|date',
            'tipo' => 'required|in:entrada,saida',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'origem' => 'nullable|string|max:100',
            'veiculo_id' => 'nullable|exists:veiculos,id',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'date' => 'O campo :attribute deve conter uma data válida.',
            'in' => 'O valor selecionado para :attribute é inválido.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'exists' => 'O valor de :attribute não é válido.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            FluxoDeCaixa::create($validated);

            return redirect()->route('fluxo-de-caixa.index')->with('success', 'Lançamento registrado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao registrar lançamento: ' . $e->getMessage())->withInput();
        }
    }

    public function show(FluxoDeCaixa $fluxoDeCaixa)
    {
        try {
            return view('fluxo_caixa.show', compact('fluxoDeCaixa'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao exibir o lançamento: ' . $e->getMessage());
        }
    }

    public function edit(FluxoDeCaixa $fluxoDeCaixa)
    {
        try {
            return view('fluxo_caixa.edit', compact('fluxoDeCaixa'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar o formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, FluxoDeCaixa $fluxoDeCaixa)
    {
        $rules = [
            'data' => 'required|date',
            'tipo' => 'required|in:entrada,saida',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'origem' => 'nullable|string|max:100',
            'veiculo_id' => 'nullable|exists:veiculos,id',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'date' => 'O campo :attribute deve conter uma data válida.',
            'in' => 'O valor selecionado para :attribute é inválido.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'exists' => 'O valor de :attribute não é válido.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $fluxoDeCaixa->update($validated);

            return redirect()->route('fluxo-de-caixa.index')->with('success', 'Lançamento atualizado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar lançamento: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(FluxoDeCaixa $fluxoDeCaixa)
    {
        try {
            $fluxoDeCaixa->delete();
            return redirect()->route('fluxo-de-caixa.index')->with('success', 'Lançamento removido com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover lançamento: ' . $e->getMessage());
        }
    }
}
