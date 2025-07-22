

@extends('adminlte::page')

@section('title', 'Documentos dos Veículos')

@section('content_header')
    <h1 class="text-dark">Documentos dos Veículos</h1>
    <hr>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col">
            <a class="btn float-end rounded-pill bluebtn" href="{{ route('documentos.create') }}">
                <i class="fa fa-plus"></i> Novo Documento
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
                <th>Veículo</th>
                <th>Tipo</th>
                <th>Data de Emissão</th>
                <th>Arquivo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos ?? [] as $documento)
                <tr>
                    <td>{{ $documento->id }}</td>
                    <td>{{ $documento->veiculo->modelo ?? 'N/A' }}</td>
                    <td>{{ ucfirst($documento->tipo_documento) }}</td>
                    <td>{{ \Carbon\Carbon::parse($documento->data_emissao)->format('d/m/Y') }}</td>
                    <td>
                        @if ($documento->arquivo)
                            <a href="{{ asset('storage/' . $documento->arquivo) }}" target="_blank" class="btn btn-sm btn-primary">Ver</a>
                        @else
                            <span class="text-muted">Não enviado</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-warning btn-sm rounded-pill">
                            ✏️ Editar
                        </a>
                        <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Deseja realmente excluir este documento?')">
                                🗑️ Excluir
                            </button>
                        </form>
                    </td>
                </tr>
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

        .btn-warning {
            background-color: rgb(238, 255, 0);
            border-color: rgb(5, 16, 116);
            color: black;
        }

        .btn-danger {
            background-color: rgb(204, 14, 0);
            border-color: #F44336;
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
@stop