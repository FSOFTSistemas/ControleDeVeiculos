<!-- Modal: Adicionar Novo Veículo -->
<div class="modal fade" id="modal-add-veiculo" tabindex="-1" aria-labelledby="modalAddVeiculoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="formAddVeiculo" method="POST" action="{{ route('veiculos.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalAddVeiculoLabel">Adicionar Novo Veículo</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body bg-light">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="marca">Marca</label>
                            <input type="text" name="marca" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="modelo">Modelo</label>
                            <input type="text" name="modelo" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-md-4">
                            <label for="ano_fabricacao">Ano Fabricação</label>
                            <input type="number" name="ano_fabricacao" class="form-control" min="1980" max="{{ now()->year + 1 }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ano_modelo">Ano Modelo</label>
                            <input type="number" name="ano_modelo" class="form-control" min="1980" max="{{ now()->year + 1 }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cor">Cor</label>
                            <input type="text" name="cor" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-md-6">
                            <label for="placa">Placa</label>
                            <input type="text" name="placa" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="chassi">Chassi</label>
                            <input type="text" name="chassi" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-md-6">
                            <label for="renavam">Renavam</label>
                            <input type="text" name="renavam" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="quilometragem">Quilometragem</label>
                            <input type="number" name="quilometragem" class="form-control" step="0.1">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-md-6">
                            <label for="tipo_combustivel">Tipo de Combustível</label>
                            <select name="tipo_combustivel" class="form-control">
                                <option value="">Selecione</option>
                                <option value="gasolina">Gasolina</option>
                                <option value="etanol">Etanol</option>
                                <option value="diesel">Diesel</option>
                                <option value="flex">Flex</option>
                                <option value="eletrico">Elétrico</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="disponivel">Disponível</option>
                                <option value="vendido">Vendido</option>
                                <option value="em_preparacao">Em Preparação</option>
                                <option value="manutencao">Manutenção</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Veículo</button>
                </div>
            </div>
        </form>
    </div>
</div>
