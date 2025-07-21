<div class="modal fade" id="modal-view-{{ $empresa->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detalhes da Empresa</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <div class="text-center mb-4">
                    <h3 class="text-primary">{{ $empresa->nome }}</h3>
                </div>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Informações da Empresa</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">ID:</dt>
                        <dd class="col-sm-8">{{ $empresa->id }}</dd>

                        <dt class="col-sm-4">CNPJ:</dt>
                        <dd class="col-sm-8">{{ $empresa->cnpj ?? 'Não informado' }}</dd>

                        <dt class="col-sm-4">Telefone:</dt>
                        <dd class="col-sm-8">{{ $empresa->telefone ?? 'Não informado' }}</dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">{{ $empresa->email ?? 'Não informado' }}</dd>

                        <dt class="col-sm-4">Endereço:</dt>
                        <dd class="col-sm-8">{{ $empresa->endereco ?? 'Não informado' }}</dd>
                    </dl>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
