

<!-- Modal de Exclusão de Compra -->
<div class="modal fade" id="modal-delete-{{ $compra->id }}" tabindex="-1" aria-labelledby="modalDeleteCompraLabel{{ $compra->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('compras.destroy', $compra->id) }}">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalDeleteCompraLabel{{ $compra->id }}">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body bg-light">
                    <p>Tem certeza que deseja excluir a compra do veículo <strong>{{ $compra->veiculo->marca }} {{ $compra->veiculo->modelo }}</strong> realizada em <strong>{{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}</strong>?</p>
                    <p class="text-danger mb-0">Essa ação não poderá ser desfeita!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </div>
        </form>
    </div>
</div>