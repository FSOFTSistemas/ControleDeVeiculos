<div class="modal fade" id="modal-view-{{ $veiculo->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detalhes do Veículo</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <div class="text-center mb-4">
                    <h3 class="text-primary">{{ $veiculo->marca }} {{ $veiculo->modelo }}</h3>
                    <p>
                        @if ($veiculo->status == 'disponivel')
                            <span class="badge bg-success">Disponível</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($veiculo->status) }}</span>
                        @endif
                    </p>
                </div>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Informações Gerais</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">ID:</dt>
                        <dd class="col-sm-8">{{ $veiculo->id }}</dd>

                        <dt class="col-sm-4">Placa:</dt>
                        <dd class="col-sm-8">{{ $veiculo->placa }}</dd>

                        <dt class="col-sm-4">Chassi:</dt>
                        <dd class="col-sm-8">{{ $veiculo->chassi }}</dd>

                        <dt class="col-sm-4">Renavam:</dt>
                        <dd class="col-sm-8">{{ $veiculo->renavam }}</dd>

                        <dt class="col-sm-4">Cor:</dt>
                        <dd class="col-sm-8">{{ $veiculo->cor }}</dd>

                        <dt class="col-sm-4">Combustível:</dt>
                        <dd class="col-sm-8">{{ $veiculo->tipo_combustivel }}</dd>
                    </dl>
                </fieldset>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Ano e Quilometragem</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Ano Fabricação:</dt>
                        <dd class="col-sm-8">{{ $veiculo->ano_fabricacao }}</dd>

                        <dt class="col-sm-4">Ano Modelo:</dt>
                        <dd class="col-sm-8">{{ $veiculo->ano_modelo }}</dd>

                        <dt class="col-sm-4">Quilometragem:</dt>
                        <dd class="col-sm-8">{{ $veiculo->quilometragem }} km</dd>
                    </dl>
                </fieldset>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Valores e Datas</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Valor de Compra:</dt>
                        <dd class="col-sm-8">R$ {{ number_format($veiculo->valor_compra, 2, ',', '.') }}</dd>

                        <dt class="col-sm-4">Valor de Venda:</dt>
                        <dd class="col-sm-8">R$ {{ number_format($veiculo->valor_venda, 2, ',', '.') }}</dd>

                        <dt class="col-sm-4">Data da Compra:</dt>
                        <dd class="col-sm-8">{{ optional($veiculo->data_compra)->format('d/m/Y') }}</dd>

                        <dt class="col-sm-4">Data da Venda:</dt>
                        <dd class="col-sm-8">{{ optional($veiculo->data_venda)->format('d/m/Y') }}</dd>
                    </dl>
                </fieldset>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Empresa</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Empresa:</dt>
                        <dd class="col-sm-8">{{ $veiculo->empresa->nome ?? 'N/A' }}</dd>
                    </dl>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>