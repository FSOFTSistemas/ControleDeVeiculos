

<!-- Modal de Visualização -->
<div class="modal fade" id="modal-view-{{ $documento->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detalhes do Documento</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <div class="text-center mb-4">
                    <h3 class="text-primary">{{ ucfirst($documento->tipo_documento) }}</h3>
                    <p>
                        <span class="badge bg-secondary">Veículo: {{ $documento->veiculo->marca ?? '' }} {{ $documento->veiculo->modelo ?? '' }} - {{ $documento->veiculo->placa ?? '' }}</span>
                    </p>
                </div>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Informações</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">ID:</dt>
                        <dd class="col-sm-8">{{ $documento->id }}</dd>

                        <dt class="col-sm-4">Tipo de Documento:</dt>
                        <dd class="col-sm-8">{{ $documento->tipo_documento }}</dd>

                        <dt class="col-sm-4">Data de Emissão:</dt>
                        <dd class="col-sm-8">
                            {{ \Carbon\Carbon::parse($documento->data_emissao)->format('d/m/Y') }}
                        </dd>

                        <dt class="col-sm-4">Arquivo:</dt>
                        <dd class="col-sm-8">
                            @if ($documento->arquivo)
                                <a href="{{ asset('storage/' . $documento->arquivo) }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver Arquivo</a>
                            @else
                                <span class="text-muted">Não enviado</span>
                            @endif
                        </dd>
                    </dl>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>