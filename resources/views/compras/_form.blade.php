@extends('adminlte::page')

@section('title', 'Compras de Veículos')

@section('content_header')
    <h1 class="text-dark">Compras de Veículos</h1>
    <hr>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ isset($compra) ? 'Editar Compra' : 'Nova Compra' }}</h3>
    </div>

    <form action="{{ isset($compra) ? route('compras.update', $compra->id) : route('compras.store') }}" method="POST">
        @csrf
        @if (isset($compra))
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="border rounded p-3 mb-4 bg-light">
                <h5 class="mb-3">Informações da Compra</h5>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="veiculo_id">Veículo</label>
                        <div class="input-group">
                            <select name="veiculo_id" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach ($veiculos??[] as $veiculo)
                                    <option value="{{ $veiculo->id }}" @selected(old('veiculo_id', $compra->veiculo_id ?? '') == $veiculo->id)>
                                        {{ $veiculo->marca }} {{ $veiculo->modelo }} ({{ $veiculo->placa }})
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-add-veiculo">
                                +
                            </button>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="fornecedor_id">Fornecedor</label>
                        <div class="input-group">
                            <select name="fornecedor_id" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach ($fornecedores??[] as $fornecedor)
                                    <option value="{{ $fornecedor->id }}" @selected(old('fornecedor_id', $compra->fornecedor_id ?? '') == $fornecedor->id)>
                                        {{ $fornecedor->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-add-fornecedor">
                                +
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-md-4">
                        <label for="data_compra">Data da Compra</label>
                        @php
                            $dataCompraFormatada = old('data_compra', isset($compra->data_compra) ? \Carbon\Carbon::parse($compra->data_compra)->format('Y-m-d') : '');
                        @endphp
                        <input type="date" name="data_compra" class="form-control" value="{{ $dataCompraFormatada }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="valor_total">Valor Total</label>
                        <input type="number" step="0.01" name="valor_total" class="form-control"
                            value="{{ old('valor_total', $compra->valor_total ?? '') }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="forma_pagamento">Forma de Pagamento</label>
                        <select name="forma_pagamento" class="form-control" required>
                            <option value="">Selecione</option>
                            <option value="dinheiro" @selected(old('forma_pagamento', $compra->forma_pagamento ?? '') == 'dinheiro')>Dinheiro</option>
                            <option value="cartao" @selected(old('forma_pagamento', $compra->forma_pagamento ?? '') == 'cartao')>Cartão</option>
                            <option value="pix" @selected(old('forma_pagamento', $compra->forma_pagamento ?? '') == 'pix')>PIX</option>
                            <option value="boleto" @selected(old('forma_pagamento', $compra->forma_pagamento ?? '') == 'boleto')>Boleto</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="observacoes">Observações</label>
                    <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes', $compra->observacoes ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row w-100">
                <div class="col-md-6">
                    <a href="{{ route('compras.index') }}" class="btn btn-secondary btn-block shadow">
                        <i class="fas fa-arrow-left mr-1"></i> Cancelar
                    </a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary btn-block shadow">
                        <i class="fas fa-save mr-1"></i> {{ isset($compra) ? 'Atualizar' : 'Salvar' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modais para adicionar veículo e fornecedor -->
@include('compras.modals.fornecedor-create-inline')
@include('compras.modals.veiculo-create-inline')
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Atualiza a lista de veículos após o envio do modal
        const veiculoForm = document.querySelector('#formAddVeiculo');
        veiculoForm?.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(veiculoForm);

            fetch(veiculoForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
            .then(data => {
                if (data?.id) {
                    const select = document.querySelector('select[name="veiculo_id"]');
                    const option = new Option(`${data.marca} ${data.modelo} (${data.placa})`, data.id, true, true);
                    select.append(option).dispatchEvent(new Event('change'));
                    bootstrap.Modal.getInstance(document.getElementById('modal-add-veiculo')).hide();
                }
            });
        });

        // Atualiza a lista de fornecedores após o envio do modal
        const fornecedorForm = document.querySelector('#formAddFornecedor');
        fornecedorForm?.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(fornecedorForm);

            fetch(fornecedorForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
            .then(data => {
                if (data?.id) {
                    const select = document.querySelector('select[name="fornecedor_id"]');
                    const option = new Option(data.nome, data.id, true, true);
                    select.append(option).dispatchEvent(new Event('change'));
                    bootstrap.Modal.getInstance(document.getElementById('modal-add-fornecedor')).hide();
                }
            });
        });
    });
</script>
@endsection