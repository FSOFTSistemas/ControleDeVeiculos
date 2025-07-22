

<!-- Modal de Exclusão -->
<div class="modal fade" id="modal-delete-{{ $gasto->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel{{ $gasto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalDeleteLabel{{ $gasto->id }}">Confirmar Exclusão</h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir o gasto <strong>#{{ $gasto->id }}</strong> do veículo 
                <strong>{{ $gasto->veiculo->marca ?? '' }} {{ $gasto->veiculo->modelo ?? '' }} ({{ $gasto->veiculo->placa ?? '' }})</strong>?
                <br>Esta ação não poderá ser desfeita.
            </div>
            <div class="modal-footer">
                <form action="{{ route('gastos-veiculos.destroy', $gasto->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sim, excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>