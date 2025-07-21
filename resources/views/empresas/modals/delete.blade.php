

<div class="modal fade" id="modal-delete-{{ $empresa->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel{{ $empresa->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalDeleteLabel{{ $empresa->id }}">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <p>Tem certeza que deseja excluir a empresa <strong>{{ $empresa->nome }}</strong> (CNPJ: {{ $empresa->cnpj ?? 'Não informado' }})?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sim, Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>