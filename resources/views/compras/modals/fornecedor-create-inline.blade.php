

<!-- Modal: Adicionar Novo Fornecedor -->
<div class="modal fade" id="modal-add-fornecedor" tabindex="-1" aria-labelledby="modalAddFornecedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="formAddFornecedor" method="POST" action="{{ route('fornecedores.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalAddFornecedorLabel">Adicionar Novo Fornecedor</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body bg-light">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cpf_cnpj">CPF/CNPJ</label>
                            <input type="text" name="cpf_cnpj" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col-md-6">
                            <label for="telefone">Telefone</label>
                            <input type="text" name="telefone" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Fornecedor</button>
                </div>
            </div>
        </form>
    </div>
</div>