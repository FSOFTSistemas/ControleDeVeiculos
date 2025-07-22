@extends('adminlte::page')

@section('title', isset($gasto) ? 'Editar Gasto' : 'Novo Gasto')

@section('content_header')
    <h1 class="m-0 text-dark">{{ isset($gasto) ? 'Editar Gasto' : 'Novo Gasto' }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ isset($gasto) ? 'Atualizar gasto' : 'Cadastro de novo gasto' }}</h3>
        </div>

        <form action="{{ isset($gasto) ? route('gastos-veiculos.update', $gasto->id) : route('gastos-veiculos.store') }}" method="POST">
            @csrf
            @if (isset($gasto))
                @method('PUT')
            @endif

            <div class="card-body">
                <div class="border rounded p-3 mb-4 bg-light">
                    <h5 class="mb-3">Informações do Gasto</h5>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="veiculo_id">Veículo</label>
                            <select name="veiculo_id" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach($veiculos??[] as $veiculo)
                                    <option value="{{ $veiculo->id }}"
                                        {{ old('veiculo_id', $gasto->veiculo_id ?? '') == $veiculo->id ? 'selected' : '' }}>
                                        {{ $veiculo->marca }} {{ $veiculo->modelo }} ({{ $veiculo->placa }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tipo_gasto">Tipo de Gasto</label>
                            <input type="text" name="tipo_gasto" class="form-control"
                                value="{{ old('tipo_gasto', $gasto->tipo_gasto ?? '') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3">{{ old('descricao', $gasto->descricao ?? '') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="valor">Valor</label>
                            <input type="number" step="0.01" name="valor" class="form-control"
                                value="{{ old('valor', $gasto->valor ?? '') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="data">Data</label>
                            <input type="date" name="data" class="form-control"
                                value="{{ old('data', isset($gasto->data) ? \Carbon\Carbon::parse($gasto->data)->format('Y-m-d') : '') }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row w-100">
                    <div class="col-md-6">
                        <a href="{{ route('gastos-veiculos.index') }}" class="btn btn-secondary btn-block shadow">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-block shadow">
                            <i class="fas fa-save mr-1"></i> {{ isset($gasto) ? 'Atualizar' : 'Salvar' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop