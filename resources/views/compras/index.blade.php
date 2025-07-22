@extends('adminlte::page')

@section('title', 'Compras de Veículos')

@section('content_header')
    <h1 class="text-dark">Compras de Veículos</h1>
    <hr>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col">
            <a class="btn float-end rounded-pill bluebtn" href="{{ route('compras.create') }}">
                <i class="fa fa-plus"></i> Nova Compra
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
                <th>Fornecedor</th>
                <th>Data da Compra</th>
                <th>Valor Total</th>
                <th>Forma de Pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras ?? [] as $compra)
                <tr>
                    <td>{{ $compra->id }}</td>
                    <td>{{ $compra->veiculo->marca ?? '' }} {{ $compra->veiculo->modelo ?? '' }} ({{ $compra->veiculo->placa ?? '' }})</td>
                    <td>{{ $compra->fornecedor->nome ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}</td>
                    <td>R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($compra->forma_pagamento) }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#modal-view-{{ $compra->id }}">
                            👁️ Ver
                        </button>
                        <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-warning btn-sm rounded-pill">
                            ✏️ Editar
                        </a>
                        <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#modal-delete-{{ $compra->id }}">
                            🗑️ Excluir
                        </button>
                    </td>
                </tr>

                @include('compras.modals.delete', ['compra' => $compra])
                @include('compras.modals.view', ['compra' => $compra])
            @endforeach
        </tbody>
    @endcomponent
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        .btn-primary {
            background-color: rgb(3, 34, 75);
            border-color: rgb(1, 35, 78);
        }

        .btn-primary:hover {
            background-color: rgb(3, 37, 68);
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

        .btn-sm {
            padding: 6px 12px;
        }

        .modal-header {
            background-color: #1E3A5F;
            color: #fff;
        }

        .dataTable thead th {
            background-color: #1E3A5F;
            color: #fff;
        }

        .bluebtn {
            background-color: rgb(3, 34, 75);
            color: white;
        }

        .bluebtn:hover {
            background-color: rgb(1, 35, 78);
            color: white;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop