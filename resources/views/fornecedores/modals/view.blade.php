

<!-- Modal de Visualização -->
<div class="modal fade" id="modal-view-{{ $fornecedor->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detalhes do Fornecedor</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <div class="text-center mb-4">
                    <h3 class="text-primary">{{ $fornecedor->nome }}</h3>
                </div>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Informações do Fornecedor</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">ID:</dt>
                        <dd class="col-sm-8">{{ $fornecedor->id }}</dd>

                        <dt class="col-sm-4">CPF/CNPJ:</dt>
                        <dd class="col-sm-8">{{ $fornecedor->cpf_cnpj ?? 'Não informado' }}</dd>

                        <dt class="col-sm-4">Telefone:</dt>
                        <dd class="col-sm-8">{{ $fornecedor->telefone ?? 'Não informado' }}</dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">{{ $fornecedor->email ?? 'Não informado' }}</dd>

                        <dt class="col-sm-4">Endereço:</dt>
                        <dd class="col-sm-8">{{ $fornecedor->endereco ?? 'Não informado' }}</dd>
                    </dl>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>