<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DocumentoController extends Controller
{
    public function index()
    {
        try {
            $documentos = Documento::orderByDesc('created_at')->paginate(15);
            return view('documentos.index', compact('documentos'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao listar documentos: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('documentos.create');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar formulário: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'tipo_documento' => 'required|string|max:100',
            'arquivo' => 'required|string|max:255',
            'data_emissao' => 'nullable|date',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            Documento::create($validated);

            return redirect()->route('documentos.index')->with('success', 'Documento cadastrado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao cadastrar documento: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Documento $documento)
    {
        try {
            return view('documentos.show', compact('documento'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao exibir documento: ' . $e->getMessage());
        }
    }

    public function edit(Documento $documento)
    {
        try {
            return view('documentos.edit', compact('documento'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Documento $documento)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'tipo_documento' => 'required|string|max:100',
            'arquivo' => 'required|string|max:255',
            'data_emissao' => 'nullable|date',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            $documento->update($validated);

            return redirect()->route('documentos.index')->with('success', 'Documento atualizado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar documento: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Documento $documento)
    {
        try {
            $documento->delete();
            return redirect()->route('documentos.index')->with('success', 'Documento removido com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover documento: ' . $e->getMessage());
        }
    }
}
