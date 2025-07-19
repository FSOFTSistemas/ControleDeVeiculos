<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmpresaController extends Controller
{
    public function index()
    {
        try {
            $empresas = Empresa::orderBy('nome')->paginate(15);
            return view('empresas.index', compact('empresas'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao listar empresas: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('empresas.create');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar formulário: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:20|unique:empresas,cnpj',
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
            Empresa::create($validated);

            return redirect()->route('empresas.index')->with('success', 'Empresa cadastrada com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao cadastrar empresa: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Empresa $empresa)
    {
        try {
            return view('empresas.show', compact('empresa'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao exibir empresa: ' . $e->getMessage());
        }
    }

    public function edit(Empresa $empresa)
    {
        try {
            return view('empresas.edit', compact('empresa'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao abrir formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Empresa $empresa)
    {
        $rules = [
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:20|unique:empresas,cnpj,' . $empresa->id,
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
            $empresa->update($validated);

            return redirect()->route('empresas.index')->with('success', 'Empresa atualizada com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar empresa: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Empresa $empresa)
    {
        try {
            $empresa->delete();
            return redirect()->route('empresas.index')->with('success', 'Empresa removida com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover empresa: ' . $e->getMessage());
        }
    }
}
