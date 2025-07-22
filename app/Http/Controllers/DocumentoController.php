<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DocumentoController extends Controller
{
    public function index()
    {
        try {
            $documentos = Documento::orderByDesc('created_at')->get();
            return view('documentos.index', compact('documentos'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao listar documentos: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $veiculos = Veiculo::where('empresa_id', Auth::user()->empresa_id)->get();
            return view('documentos._form', compact('veiculos'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar formulário: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'tipo_documento' => 'required|string|max:100',
            'arquivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'data_emissao' => 'nullable|date',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            if (!$request->hasFile('arquivo') || !$request->file('arquivo')->isValid()) {
                throw new \Exception('Erro no upload do arquivo. Verifique se o arquivo está válido.');
            }

            $path = $request->file('arquivo')->store('documentos', 'public');
            $validated['arquivo'] = $path;
            $validated['empresa_id'] = Auth::user()->empresa_id;
            Documento::create($validated);

            return redirect()->route('documentos.index')->with('success', 'Documento cadastrado com sucesso!');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao cadastrar documento: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Documento $documento)
    {
        try {
            return view('documentos._form', compact('documento'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao carregar formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Documento $documento)
    {
        $rules = [
            'veiculo_id' => 'required|exists:veiculos,id',
            'tipo_documento' => 'required|string|max:100',
            'arquivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'data_emissao' => 'nullable|date',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O valor de :attribute não é válido.',
            'date' => 'O campo :attribute deve conter uma data válida.',
        ];

        try {
            $validated = $request->validate($rules, $messages);
            if ($request->hasFile('arquivo')) {
                $path = $request->file('arquivo')->store('documentos', 'public');
                $validated['arquivo'] = $path;
            } else {
                unset($validated['arquivo']);
            }

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
