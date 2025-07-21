


@extends('adminlte::page')

@section('title', isset($fornecedor) ? 'Editar Fornecedor' : 'Novo Fornecedor')

@section('content_header')
    <h1 class="m-0 text-dark">{{ isset($fornecedor) ? 'Editar Fornecedor' : 'Novo Fornecedor' }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ isset($fornecedor) ? 'Atualizar dados do fornecedor' : 'Cadastro de novo fornecedor' }}</h3>
        </div>

        <form action="{{ isset($fornecedor) ? route('fornecedores.update', $fornecedor->id) : route('fornecedores.store') }}" method="POST">
            @csrf
            @if (isset($fornecedor))
                @method('PUT')
            @endif

            <div class="card-body">
                <div class="border rounded p-3 mb-4 bg-light">
                    <h5 class="mb-3">Informações do Fornecedor</h5>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control"
                                value="{{ old('nome', $fornecedor->nome ?? '') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cpf_cnpj">CPF/CNPJ</label>
                            <input type="text" name="cpf_cnpj" class="form-control"
                                value="{{ old('cpf_cnpj', $fornecedor->cpf_cnpj ?? '') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="telefone">Telefone</label>
                            <input type="text" name="telefone" class="form-control"
                                value="{{ old('telefone', $fornecedor->telefone ?? '') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $fornecedor->email ?? '') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" class="form-control"
                            value="{{ old('endereco', $fornecedor->endereco ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row w-100">
                    <div class="col-md-6">
                        <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary btn-block shadow">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-block shadow">
                            <i class="fas fa-save mr-1"></i> {{ isset($fornecedor) ? 'Atualizar' : 'Salvar' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {
            $('input[name="cpf_cnpj"]').mask('000.000.000-00');
            $('input[name="telefone"]').mask('(00) 00000-0000');
        });
    </script>
@endsection