@extends('adminlte::master')

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php
    $loginUrl = View::getSection('login_url') ?? config('adminlte.login_url', 'login');
    $registerUrl = View::getSection('register_url') ?? config('adminlte.register_url', 'register');
    $passResetUrl = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset');

    if (config('adminlte.use_route_url', false)) {
        $loginUrl = $loginUrl ? route($loginUrl) : '';
        $registerUrl = $registerUrl ? route($registerUrl) : '';
        $passResetUrl = $passResetUrl ? route($passResetUrl) : '';
    } else {
        $loginUrl = $loginUrl ? url($loginUrl) : '';
        $registerUrl = $registerUrl ? url($registerUrl) : '';
        $passResetUrl = $passResetUrl ? url($passResetUrl) : '';
    }
@endphp


@section('body')
    <style>
        .login-wrapper {
            display: flex;
            height: 100vh;
        }

        .login-image {
            flex: 1;
            background-color: black;
            background-image: url('{{ asset('img/logo.png') }}');
            background-repeat: no-repeat;
            background-size: 200%;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-form {
            flex: 1;
            background: white;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .login-form h1 {
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 20px;
        }

        .login-form .btn-primary {
            background-color: #1e3a8a;
            border: none;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons i {
            font-size: 20px;
            margin: 0 10px;
            cursor: pointer;
        }
    </style>

    <div class="login-wrapper">
        <div class="login-image"></div>
        <div class="login-form">
            <h1>FSOFT AUTO</h1>

            <form action="{{ $loginUrl }}" method="post" style="width: 100%; max-width: 320px;">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="Email" autofocus>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Senha">
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="form-group form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Lembrar-me</label>
                </div>

                {{-- Button --}}
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>

                {{-- Forgot/Signup --}}
                <div class="text-center mt-3">
                    @if($passResetUrl)
                        <a href="{{ $passResetUrl }}">Esqueceu a senha?</a>
                    @endif
                    <br>
                    @if($registerUrl)
                        <a href="{{ $registerUrl }}">Criar nova conta</a>
                    @endif
                </div>
            </form>

            {{-- Social --}}
            <div class="social-icons">
                <i class="fab fa-facebook text-primary"></i>
                <i class="fab fa-twitter text-info"></i>
                <i class="fab fa-google text-danger"></i>
            </div>
        </div>
    </div>
@endsection

