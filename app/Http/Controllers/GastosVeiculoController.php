<?php

namespace App\Http\Controllers;

use App\Models\GastosVeiculo;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class GastosVeiculoController extends Controller
{
    public function index()
    {
        try {
            $gastos = GastosVeiculo::with('veiculo')->orderByDesc('data')->paginate(15);
            return view('gastos_veiculos.index', compact('gastos'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao listar os gastos: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $veiculos = Veiculo::where('empresa_id', Auth::user()->empresa_id)->get();
            return view('gastos_veiculos._form', compact('veiculos'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar o formulário: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'tipo_gasto' => 'required|string|max:100',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data' => 'required|date',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $validated['empresa_id'] = Auth::user()->empresa_id;
            GastosVeiculo::create($validated);

            return redirect()->route('gastos-veiculos.index')->with('success', 'Gasto registrado com sucesso!');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao registrar gasto: ' . $e->getMessage())->withInput();
        }
    }


    public function edit($id)
    {
        try {
            $gasto = GastosVeiculo::find($id);
            $veiculos = Veiculo::where('empresa_id', Auth::user()->empresa_id)->get();
            return view('gastos_veiculos._form', compact('gasto', 'veiculos'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar o formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, GastosVeiculo $gastosVeiculo)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'tipo' => 'required|string|max:100',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data' => 'required|date',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $gastosVeiculo->update($validated);

            return redirect()->route('gastos-veiculos.index')->with('success', 'Gasto atualizado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar gasto: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(GastosVeiculo $gastosVeiculo)
    {
        try {
            $gastosVeiculo->delete();
            return redirect()->route('gastos-veiculos.index')->with('success', 'Gasto removido com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover gasto: ' . $e->getMessage());
        }
    }
}
