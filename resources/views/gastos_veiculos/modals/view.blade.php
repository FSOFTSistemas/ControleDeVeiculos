

<!-- Modal de Visualização -->
<div class="modal fade" id="modal-view-{{ $gasto->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detalhes do Gasto</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <div class="text-center mb-4">
                    <h3 class="text-primary">#{{ $gasto->id }}</h3>
                    <p>
                        <span class="badge bg-secondary">{{ ucfirst($gasto->tipo_gasto) }}</span>
                    </p>
                </div>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Veículo</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Veículo:</dt>
                        <dd class="col-sm-8">
                            {{ $gasto->veiculo->marca ?? '' }} {{ $gasto->veiculo->modelo ?? '' }} ({{ $gasto->veiculo->placa ?? '' }})
                        </dd>
                    </dl>
                </fieldset>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Informações do Gasto</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Descrição:</dt>
                        <dd class="col-sm-8">{{ $gasto->descricao ?? 'Não informado' }}</dd>

                        <dt class="col-sm-4">Valor:</dt>
                        <dd class="col-sm-8">R$ {{ number_format($gasto->valor, 2, ',', '.') }}</dd>

                        <dt class="col-sm-4">Data:</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($gasto->data)->format('d/m/Y') }}</dd>
                    </dl>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <a href="{{ route('gastos-veiculos.edit', $gasto->id) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>