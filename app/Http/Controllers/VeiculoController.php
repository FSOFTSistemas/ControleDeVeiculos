<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VeiculoController extends Controller
{
    public function index()
    {
        try {
            $veiculos = Veiculo::orderBy('modelo')->paginate(15);
            return view('veiculos.index', compact('veiculos'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar os veículos: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('veiculos._form');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao abrir o formulário: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano_fabricacao' => 'required|integer',
            'ano_modelo' => 'required|integer',
            'placa' => 'required|string|max:10|unique:veiculos,placa',
            'chassi' => 'required|string|max:30|unique:veiculos,chassi',
            'renavam' => 'required|string|max:20|unique:veiculos,renavam',
            'cor' => 'required|string|max:30',
            'quilometragem' => 'required|integer',
            'tipo_combustivel' => 'required|string|max:20',
            'valor_compra' => 'nullable|numeric',
            'valor_venda' => 'nullable|numeric',
            'data_compra' => 'nullable|date',
            'data_venda' => 'nullable|date',
            'status' => 'required|string|max:20',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O valor de :attribute já está em uso.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $validated['empresa_id'] = Auth::user()->empresa_id;

            Veiculo::create($validated);

            return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao cadastrar veículo: ' . $e->getMessage())->withInput();
        }
    }


    public function edit(Veiculo $veiculo)
    {
        try {
            return view('veiculos._form', compact('veiculo'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao abrir o formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Veiculo $veiculo)
    {
        $rules = [
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano_fabricacao' => 'required|integer',
            'ano_modelo' => 'required|integer',
            'placa' => 'required|string|max:10|unique:veiculos,placa,' . $veiculo->id,
            'chassi' => 'required|string|max:30|unique:veiculos,chassi,' . $veiculo->id,
            'renavam' => 'required|string|max:20|unique:veiculos,renavam,' . $veiculo->id,
            'cor' => 'required|string|max:30',
            'quilometragem' => 'required|integer',
            'tipo_combustivel' => 'required|string|max:20',
            'valor_compra' => 'nullable|numeric',
            'valor_venda' => 'nullable|numeric',
            'data_compra' => 'nullable|date',
            'data_venda' => 'nullable|date',
            'status' => 'required|string|max:20',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O valor de :attribute já está em uso.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);

            $veiculo->update($validated);

            return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar veículo: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Veiculo $veiculo)
    {
        try {
            $veiculo->delete();
            return redirect()->route('veiculos.index')->with('success', 'Veículo removido com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover veículo: ' . $e->getMessage());
        }
    }
}
