

@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1 class="text-dark">Gerenciamento de Empresas</h1>
    <hr>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col">
            <a class="btn float-end rounded-pill bluebtn" href="{{ route('empresas.create') }}">
                <i class="fa fa-plus"></i> Nova Empresa
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
        'valueColumnIndex' => 1,
    ])
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empresas ?? [] as $empresa)
                <tr>
                    <td>{{ $empresa->id }}</td>
                    <td>{{ $empresa->nome }}</td>
                    <td>{{ $empresa->cnpj ?? 'Não informado' }}</td>
                    <td>{{ $empresa->telefone ?? 'Não informado' }}</td>
                    <td>{{ $empresa->email ?? 'Não informado' }}</td>
                    <td>{{ $empresa->endereco ?? 'Não informado' }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#modal-view-{{ $empresa->id }}">
                            👁️ Ver
                        </button>
                        <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-warning btn-sm rounded-pill">
                            ✏️ Editar
                        </a>
                        <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#modal-delete-{{ $empresa->id }}">
                            🗑️ Excluir
                        </button>
                    </td>
                </tr>

                {{-- Modais --}}
                @include('empresas.modals.view', ['empresa' => $empresa])
                @include('empresas.modals.delete', ['empresa' => $empresa])
            @endforeach
        </tbody>
    @endcomponent
@stop

@section('css')
    <style>
        .bluebtn {
            background-color: rgb(3, 34, 75);
            color: white;
        }

        .bluebtn:hover {
            background-color: rgb(1, 35, 78);
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
        }

        .modal-header {
            background-color: #1E3A5F;
            color: #fff;
        }
    </style>
@stop