<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FornecedorController extends Controller
{
    public function index()
    {
        try {
            $fornecedores = Fornecedor::orderBy('nome')->paginate(15);
            return view('fornecedores.index', compact('fornecedores'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao listar fornecedores: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('fornecedores.create');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao abrir o formulário: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'nome' => 'required|string|max:255',
            'cpf_cnpj' => 'nullable|string|max:20|unique:fornecedores,cpf_cnpj',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string|max:255',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O valor de :attribute já está em uso.',
            'email' => 'O campo :attribute deve conter um e-mail válido.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            Fornecedor::create($validated);

            return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao cadastrar fornecedor: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Fornecedor $fornecedor)
    {
        try {
            return view('fornecedores.show', compact('fornecedor'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao exibir fornecedor: ' . $e->getMessage());
        }
    }

    public function edit(Fornecedor $fornecedor)
    {
        try {
            return view('fornecedores.edit', compact('fornecedor'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao abrir formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Fornecedor $fornecedor)
    {
        $rules = [
            'nome' => 'required|string|max:255',
            'cpf_cnpj' => 'nullable|string|max:20|unique:fornecedores,cpf_cnpj,' . $fornecedor->id,
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string|max:255',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O valor de :attribute já está em uso.',
            'email' => 'O campo :attribute deve conter um e-mail válido.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $fornecedor->update($validated);

            return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar fornecedor: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Fornecedor $fornecedor)
    {
        try {
            $fornecedor->delete();
            return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover fornecedor: ' . $e->getMessage());
        }
    }
}
