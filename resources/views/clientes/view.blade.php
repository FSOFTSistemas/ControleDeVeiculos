


<!-- Modal de Visualização -->
<div class="modal fade" id="modal-view-{{ $cliente->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detalhes do Cliente</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <div class="text-center mb-4">
                    <h3 class="text-primary">{{ $cliente->nome }}</h3>
                    <p>
                        @if ($cliente->status == 'ativo')
                            <span class="badge bg-success">Ativo</span>
                        @else
                            <span class="badge bg-secondary">Inativo</span>
                        @endif
                    </p>
                </div>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Dados Pessoais</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">ID:</dt>
                        <dd class="col-sm-8">{{ $cliente->id }}</dd>

                        <dt class="col-sm-4">CPF:</dt>
                        <dd class="col-sm-8">{{ $cliente->cpf ?? 'Não informado' }}</dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">{{ $cliente->email ?? 'Não informado' }}</dd>

                        <dt class="col-sm-4">Telefone:</dt>
                        <dd class="col-sm-8">{{ $cliente->telefone ?? 'Não informado' }}</dd>
                    </dl>
                </fieldset>

                <fieldset class="border rounded p-3 mb-3">
                    <legend class="w-auto px-2 text-muted">Endereço</legend>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Endereço:</dt>
                        <dd class="col-sm-8">{{ $cliente->endereco ?? 'Não informado' }}</dd>
                    </dl>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal"
                    data-bs-target="#modal-edit-{{ $cliente->id }}">Editar</button>
            </div>
        </div>
    </div>
</div>