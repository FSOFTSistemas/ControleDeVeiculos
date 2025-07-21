@extends('adminlte::page')

@section('title', isset($veiculo) ? 'Editar Veículo' : 'Novo Veículo')

@section('content_header')
    <h1 class="m-0 text-dark">{{ isset($veiculo) ? 'Editar Veículo' : 'Novo Veículo' }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ isset($veiculo) ? 'Atualizar dados do veículo' : 'Cadastro de novo veículo' }}</h3>
        </div>

        <form action="{{ isset($veiculo) ? route('veiculos.update', $veiculo->id) : route('veiculos.store') }}" method="POST">
            @csrf
            @if (isset($veiculo))
                @method('PUT')
            @endif

            <div class="card-body">
                <div class="border rounded p-3 mb-4 bg-light">
                    <h5 class="mb-3">Informações do Veículo</h5>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="marca">Marca</label>
                            <select name="marca" id="marca" class="form-control select2" required>
                                <option value="">Selecione</option>
                                @foreach (['Chevrolet', 'Fiat', 'Ford', 'Honda', 'Hyundai', 'Jeep', 'Nissan', 'Peugeot', 'Renault', 'Toyota', 'Volkswagen'] as $marca)
                                    <option value="{{ $marca }}" @selected(old('marca', $veiculo->marca ?? '') == $marca)>{{ $marca }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="modelo">Modelo</label>
                            <select name="modelo" id="modelo" class="form-control select2" required>
                                <option value="{{ old('modelo', $veiculo->modelo ?? '') }}">{{ old('modelo', $veiculo->modelo ?? '') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="ano_fabricacao">Ano Fabricação</label>
                            <select name="ano_fabricacao" class="form-control">
                                @for ($ano = date('Y') + 1; $ano >= date('Y') - 20; $ano--)
                                    <option value="{{ $ano }}" @selected(old('ano_fabricacao', $veiculo->ano_fabricacao ?? '') == $ano)>{{ $ano }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="ano_modelo">Ano Modelo</label>
                            <select name="ano_modelo" class="form-control">
                                @for ($ano = date('Y') + 1; $ano >= date('Y') - 20; $ano--)
                                    <option value="{{ $ano }}" @selected(old('ano_modelo', $veiculo->ano_modelo ?? '') == $ano)>{{ $ano }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="placa">Placa</label>
                            <input type="text" name="placa" class="form-control" value="{{ old('placa', $veiculo->placa ?? '') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="chassi">Chassi</label>
                            <input type="text" name="chassi" class="form-control" value="{{ old('chassi', $veiculo->chassi ?? '') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="renavam">Renavam</label>
                            <input type="text" name="renavam" class="form-control" value="{{ old('renavam', $veiculo->renavam ?? '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="cor">Cor</label>
                            <input type="text" name="cor" class="form-control" value="{{ old('cor', $veiculo->cor ?? '') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="quilometragem">Quilometragem</label>
                            <input type="number" name="quilometragem" class="form-control" value="{{ old('quilometragem', $veiculo->quilometragem ?? '') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tipo_combustivel">Combustível</label>
                            <select name="tipo_combustivel" class="form-control">
                                <option value="">Selecione</option>
                                <option value="Gasolina" @selected(old('tipo_combustivel', $veiculo->tipo_combustivel ?? '') == 'Gasolina')>Gasolina</option>
                                <option value="Etanol" @selected(old('tipo_combustivel', $veiculo->tipo_combustivel ?? '') == 'Etanol')>Etanol</option>
                                <option value="Diesel" @selected(old('tipo_combustivel', $veiculo->tipo_combustivel ?? '') == 'Diesel')>Diesel</option>
                                <option value="Flex" @selected(old('tipo_combustivel', $veiculo->tipo_combustivel ?? '') == 'Flex')>Flex</option>
                                <option value="Elétrico" @selected(old('tipo_combustivel', $veiculo->tipo_combustivel ?? '') == 'Elétrico')>Elétrico</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="valor_compra">Valor de Compra</label>
                            <input type="number" step="0.01" name="valor_compra" class="form-control" value="{{ old('valor_compra', $veiculo->valor_compra ?? '') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="valor_venda">Valor de Venda</label>
                            <input type="number" step="0.01" name="valor_venda" class="form-control" value="{{ old('valor_venda', $veiculo->valor_venda ?? '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="data_compra">Data de Compra</label>
                            <input type="date" name="data_compra" class="form-control" value="{{ old('data_compra', $veiculo->data_compra ?? '') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="data_venda">Data de Venda</label>
                            <input type="date" name="data_venda" class="form-control" value="{{ old('data_venda', $veiculo->data_venda ?? '') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="disponivel" @selected(old('status', $veiculo->status ?? '') == 'disponivel')>Disponível</option>
                            <option value="vendido" @selected(old('status', $veiculo->status ?? '') == 'vendido')>Vendido</option>
                            <option value="reservado" @selected(old('status', $veiculo->status ?? '') == 'reservado')>Reservado</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row w-100">
                    <div class="col-md-6">
                        <a href="{{ route('veiculos.index') }}" class="btn btn-secondary btn-block shadow">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-block shadow">
                            <i class="fas fa-save mr-1"></i> {{ isset($veiculo) ? 'Atualizar' : 'Salvar' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2();

        const modelosPorMarca = {
            'Chevrolet': ['Onix', 'Prisma', 'Cruze', 'S10', 'Spin', 'Tracker', 'Cobalt', 'Montana', 'Blazer', 'Captiva', 'Vectra', 'Celta', 'Astra', 'Zafira', 'Meriva'],
            'Fiat': ['Uno', 'Palio', 'Toro', 'Strada', 'Siena', 'Idea', 'Punto', 'Mobi', 'Argo', 'Cronos', 'Tempra', 'Bravo', 'Linea'],
            'Ford': ['Ka', 'Fiesta', 'Focus', 'Ranger', 'Ecosport', 'Fusion', 'Edge', 'Territory', 'Courier', 'F-250', 'F-1000'],
            'Honda': ['Civic', 'City', 'Fit', 'HR-V', 'WR-V', 'CR-V', 'Accord'],
            'Hyundai': ['HB20', 'Creta', 'Tucson', 'i30', 'Santa Fe', 'Azera', 'Elantra', 'Veloster'],
            'Jeep': ['Renegade', 'Compass', 'Commander', 'Cherokee', 'Grand Cherokee', 'Wrangler'],
            'Nissan': ['March', 'Versa', 'Kicks', 'Frontier', 'Sentra', 'Tiida', 'X-Trail', 'Livina'],
            'Peugeot': ['208', '2008', '3008', '207', '307', '406', '408', '508'],
            'Renault': ['Clio', 'Sandero', 'Duster', 'Logan', 'Kwid', 'Captur', 'Scenic', 'Megane', 'Symbol'],
            'Toyota': ['Corolla', 'Hilux', 'Yaris', 'Etios', 'SW4', 'RAV4', 'Camry', 'Prius'],
            'Volkswagen': ['Gol', 'Voyage', 'Fox', 'Polo', 'T-Cross', 'Virtus', 'Saveiro', 'Jetta', 'Passat', 'Golf', 'Tiguan', 'Amarok']
        };

        const anoPorModelo = {
            'Onix': 2022,
            'Prisma': 2021,
            'Cruze': 2021,
            'S10': 2020,
            'Spin': 2019,
            'Tracker': 2020,
            'Cobalt': 2018,
            'Montana': 2017,
            'Blazer': 2019,
            'Captiva': 2018,
            'Vectra': 2016,
            'Celta': 2015,
            'Astra': 2014,
            'Zafira': 2013,
            'Meriva': 2012,
            'Uno': 2021,
            'Palio': 2019,
            'Toro': 2022,
            'Strada': 2019,
            'Siena': 2018,
            'Idea': 2017,
            'Punto': 2016,
            'Mobi': 2019,
            'Argo': 2020,
            'Cronos': 2021,
            'Tempra': 2010,
            'Bravo': 2015,
            'Linea': 2014,
            'Ka': 2021,
            'Fiesta': 2020,
            'Focus': 2018,
            'Ranger': 2020,
            'Ecosport': 2019,
            'Fusion': 2017,
            'Edge': 2016,
            'Territory': 2018,
            'Courier': 2015,
            'F-250': 2019,
            'F-1000': 2013,
            'Civic': 2022,
            'City': 2020,
            'Fit': 2018,
            'HR-V': 2019,
            'WR-V': 2021,
            'CR-V': 2020,
            'Accord': 2017,
            'HB20': 2019,
            'Creta': 2020,
            'Tucson': 2021,
            'i30': 2018,
            'Santa Fe': 2017,
            'Azera': 2016,
            'Elantra': 2019,
            'Veloster': 2015,
            'Renegade': 2021,
            'Compass': 2020,
            'Commander': 2019,
            'Cherokee': 2018,
            'Grand Cherokee': 2017,
            'Wrangler': 2016,
            'March': 2019,
            'Versa': 2020,
            'Kicks': 2021,
            'Frontier': 2018,
            'Sentra': 2017,
            'Tiida': 2016,
            'X-Trail': 2019,
            'Livina': 2015,
            '208': 2021,
            '2008': 2020,
            '3008': 2019,
            '207': 2017,
            '307': 2016,
            '406': 2015,
            '408': 2014,
            '508': 2013,
            'Clio': 2019,
            'Sandero': 2020,
            'Duster': 2021,
            'Logan': 2018,
            'Kwid': 2017,
            'Captur': 2016,
            'Scenic': 2015,
            'Megane': 2014,
            'Symbol': 2013,
            'Corolla': 2022,
            'Hilux': 2021,
            'Yaris': 2020,
            'Etios': 2019,
            'SW4': 2018,
            'RAV4': 2017,
            'Camry': 2016,
            'Prius': 2015,
            'Gol': 2022,
            'Voyage': 2021,
            'Fox': 2020,
            'Polo': 2019,
            'T-Cross': 2018,
            'Virtus': 2017,
            'Saveiro': 2016,
            'Jetta': 2015,
            'Passat': 2014,
            'Golf': 2013,
            'Tiguan': 2012,
            'Amarok': 2011
        };

        $('#marca').on('change', function () {
            const marca = $(this).val();
            const modelos = modelosPorMarca[marca] || [];
            $('#modelo').empty().append(`<option value="">Selecione</option>`);
            modelos.forEach(modelo => {
                $('#modelo').append(`<option value="${modelo}">${modelo}</option>`);
            });
            // Limpa o ano de fabricação ao mudar a marca
            $('select[name="ano_fabricacao"]').val('').trigger('change');
        });

        $('#modelo').on('change', function () {
            const modelo = $(this).val();
            const anoFabricacao = anoPorModelo[modelo];
            if (anoFabricacao) {
                $('select[name="ano_fabricacao"]').val(anoFabricacao).trigger('change');
            }
            // Atualizar opções de ano_modelo conforme ano_fabricacao
            let anoFab = parseInt($('select[name="ano_fabricacao"]').val());
            if (!anoFab || isNaN(anoFab)) {
                anoFab = new Date().getFullYear() - 20;
            }
            $('select[name="ano_modelo"]').each(function () {
                const select = $(this);
                const selected = select.val();
                select.find('option').remove();
                const anoAtual = new Date().getFullYear();
                for (let ano = anoAtual + 1; ano >= anoFab; ano--) {
                    select.append(`<option value="${ano}" ${ano == selected ? 'selected' : ''}>${ano}</option>`);
                }
            });
        });

        // Atualizar ano_modelo ao mudar ano_fabricacao
        $('select[name="ano_fabricacao"]').on('change', function () {
            let anoFab = parseInt($(this).val());
            if (!anoFab || isNaN(anoFab)) {
                anoFab = new Date().getFullYear() - 20;
            }
            $('select[name="ano_modelo"]').each(function () {
                const select = $(this);
                const selected = select.val();
                select.find('option').remove();
                const anoAtual = new Date().getFullYear();
                for (let ano = anoAtual + 1; ano >= anoFab; ano--) {
                    select.append(`<option value="${ano}" ${ano == selected ? 'selected' : ''}>${ano}</option>`);
                }
            });
        });
    });
</script>
@stop