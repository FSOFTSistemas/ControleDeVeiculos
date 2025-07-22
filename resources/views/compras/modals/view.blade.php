

<!-- Modal de Visualização da Compra -->
<div class="modal fade" id="modal-view-{{ $compra->id }}" tabindex="-1" aria-labelledby="modalViewCompraLabel{{ $compra->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="modalViewCompraLabel{{ $compra->id }}">Detalhes da Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="text-center mb-3">
                    <h4 class="text-primary">Compra de Veículo</h4>
                    <span class="badge bg-secondary">ID #{{ $compra->id }}</span>
                </div>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Informações do Veículo</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Marca / Modelo:</dt>
                        <dd class="col-sm-8">{{ $compra->veiculo->marca }} {{ $compra->veiculo->modelo }}</dd>

                        <dt class="col-sm-4">Placa:</dt>
                        <dd class="col-sm-8">{{ $compra->veiculo->placa }}</dd>

                        <dt class="col-sm-4">Ano:</dt>
                        <dd class="col-sm-8">{{ $compra->veiculo->ano_fabricacao }} / {{ $compra->veiculo->ano_modelo }}</dd>
                    </dl>
                </fieldset>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Informações da Compra</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Fornecedor:</dt>
                        <dd class="col-sm-8">{{ $compra->fornecedor->nome ?? '-' }}</dd>

                        <dt class="col-sm-4">Data da Compra:</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}</dd>

                        <dt class="col-sm-4">Forma de Pagamento:</dt>
                        <dd class="col-sm-8">{{ ucfirst($compra->forma_pagamento) }}</dd>

                        <dt class="col-sm-4">Valor Total:</dt>
                        <dd class="col-sm-8">R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</dd>

                        <dt class="col-sm-4">Observações:</dt>
                        <dd class="col-sm-8">{{ $compra->observacoes ?? '—' }}</dd>
                    </dl>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>