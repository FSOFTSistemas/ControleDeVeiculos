@extends('adminlte::page')

@section('title', 'Gastos com Veículos')

@section('content_header')
    <h1 class="text-dark">Gastos com Veículos</h1>
    <hr>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col">
            <a class="btn float-end rounded-pill bluebtn" href="{{ route('gastos-veiculos.create') }}">
                <i class="fa fa-plus"></i> Novo Gasto
            </a>
        </div>
    </div>

    @component('components.data-table', [
        'responsive' => [
            ['responsivePriority' => 1, 'targets' => 0],
            ['responsivePriority' => 2, 'targets' => 1],
            ['responsivePriority' => 3, 'targets' => 2],
            ['responsivePriority' => 4, 'targets' => -1],
        ],
        'itemsPerPage' => 10,
        'showTotal' => false,
        'valueColumnIndex' => 3,
    ])
        <thead style="background-color: #1E3A5F;">
            <tr>
                <th>ID</th>
                <th>Veículo</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gastos as $gasto)
                <tr>
                    <td>{{ $gasto->id }}</td>
                    <td>{{ $gasto->veiculo->marca ?? '' }} {{ $gasto->veiculo->modelo ?? '' }} ({{ $gasto->veiculo->placa ?? '' }})</td>
                    <td>{{ ucfirst($gasto->tipo_gasto) }}</td>
                    <td>R$ {{ number_format($gasto->valor, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($gasto->data)->format('d/m/Y') }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#modal-view-{{ $gasto->id }}">
                            👁️ Ver
                        </button>
                        <a href="{{ route('gastos-veiculos.edit', $gasto->id) }}" class="btn btn-warning btn-sm rounded-pill">
                            ✏️ Editar
                        </a>
                        <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#modal-delete-{{ $gasto->id }}">
                            🗑️ Excluir
                        </button>
                    </td>
                </tr>

                @include('gastos_veiculos.modals.view', ['gasto' => $gasto])
                @include('gastos_veiculos.modals.delete', ['gasto' => $gasto])
            @endforeach
        </tbody>
    @endcomponent
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        .bluebtn {
            background-color: rgb(3, 34, 75);
            color: white;
        }

        .bluebtn:hover {
            background-color: rgb(1, 35, 78);
            color: white;
        }

        .btn-warning {
            background-color: rgb(238, 255, 0);
            border-color: rgb(5, 16, 116);
            color: black;
        }

        .btn-danger {
            background-color: rgb(204, 14, 0);
            border-color: #F44336;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #138496;
        }

        .dataTable thead th {
            background-color: #1E3A5F;
            color: #fff;
        }

        .btn-sm {
            padding: 6px 12px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
@stop