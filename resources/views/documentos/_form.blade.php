

@extends('adminlte::page')

@section('title', isset($documento) ? 'Editar Documento' : 'Novo Documento')

@section('content_header')
    <h1 class="m-0 text-dark">{{ isset($documento) ? 'Editar Documento' : 'Novo Documento' }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ isset($documento) ? 'Atualizar Documento' : 'Cadastro de novo Documento' }}</h3>
        </div>

        <form action="{{ isset($documento) ? route('documentos.update', $documento->id) : route('documentos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($documento))
                @method('PUT')
            @endif

            <div class="card-body">
                <div class="border rounded p-3 mb-4 bg-light">
                    <h5 class="mb-3">Informações do Documento</h5>
                    <div class="form-group">
                        <label for="veiculo_id">Veículo</label>
                        <select name="veiculo_id" class="form-control" required>
                            <option value="">Selecione um veículo</option>
                            @foreach ($veiculos??[] as $veiculo)
                                <option value="{{ $veiculo->id }}" @selected(old('veiculo_id', $documento->veiculo_id ?? '') == $veiculo->id)>
                                    {{ $veiculo->marca }} {{ $veiculo->modelo }} - {{ $veiculo->placa }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tipo_documento">Tipo de Documento</label>
                        <input type="text" name="tipo_documento" class="form-control"
                            value="{{ old('tipo_documento', $documento->tipo_documento ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="data_emissao">Data de Emissão</label>
                        <input type="date" name="data_emissao" class="form-control"
                            value="{{ old('data_emissao', isset($documento->data_emissao) ? \Carbon\Carbon::parse($documento->data_emissao)->format('Y-m-d') : '') }}">
                    </div>

                    <div class="form-group">
                        <label for="arquivo">Arquivo</label>
                        <input type="file" name="arquivo" class="form-control-file">
                        @if (isset($documento) && $documento->arquivo)
                            <p class="mt-2">
                                <a href="{{ asset('storage/' . $documento->arquivo) }}" target="_blank">Arquivo atual</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row w-100">
                    <div class="col-md-6">
                        <a href="{{ route('documentos.index') }}" class="btn btn-secondary btn-block shadow">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-block shadow">
                            <i class="fas fa-save mr-1"></i> {{ isset($documento) ? 'Atualizar' : 'Salvar' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop