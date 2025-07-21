<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $clientes = Cliente::orderBy('nome')->get();
            return view('clientes.index', compact('clientes'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar a lista de clientes: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('clientes._form');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao abrir o formulário: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'cpf_cnpj.required' => 'O CPF ou CNPJ é obrigatório.',
            'cpf_cnpj.unique' => 'Esse CPF ou CNPJ já está cadastrado.',
            'email.email' => 'O campo email deve conter um endereço válido.',
        ];

        $rules = [
            'nome' => 'required|string|max:255',
            'cpf_cnpj' => 'required|string|max:20|unique:clientes,cpf_cnpj',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string|max:255',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $validated['empresa_id'] = Auth::user()->empresa_id;
            Cliente::create($validated);

            return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
        } catch (ValidationException $e) {
            return back()->with('error', $e->validator)->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Erro ao criar cliente: ' . $e->getMessage())->withInput();
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        try {
            return view('clientes._form', compact('cliente'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao abrir o formulário de edição: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'cpf_cnpj.required' => 'O CPF ou CNPJ é obrigatório.',
            'cpf_cnpj.unique' => 'Esse CPF ou CNPJ já está cadastrado.',
            'email.email' => 'O campo email deve conter um endereço válido.',
        ];

        $rules = [
            'nome' => 'required|string|max:255',
            'cpf_cnpj' => 'required|string|max:20|unique:clientes,cpf_cnpj,' . $cliente->id,
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string|max:255',
        ];

        try {
            $validated = $request->validate($rules, $messages);

            $cliente->update($validated);

            return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar cliente: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover cliente: ' . $e->getMessage());
        }
    }
}
