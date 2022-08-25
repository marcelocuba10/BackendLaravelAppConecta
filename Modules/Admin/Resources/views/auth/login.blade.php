@extends('admin::layouts.auth.auth-master-admin')

@section('content')

<div class="container">
    <div class="left"></div>
    <div class="right">
        <div class="ergts">
            <a href="/"><button class="ththhf" type="button" class="btn btn-block create-account">Página Web</button></a>
            <a href="/user/login"><button class="ththhf" type="button" class="btn btn-block create-account">Usuarios</button></a>
        </div>    
        <div class="login-texto">
            <p class="login-title">Panel Administrativo</p>
            <p class="login-message">Gestiona tu empresa de un solo lugar!</p>
        </div>
    </div>    
</div> 

<div class="registration-form">
    
    <form method="post" action="/admin/login">

        <div class="form-icon"><img class="img-logo" src="/img/conectacode.png"></div>
        <p class="login-message2">Iniciar sesión en ConectaCode</p>
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-warning" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="form-group">
            <input name="email" value="{{ old('email') }}" type="text" class="form-control item" placeholder="Email" required>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group">
            <input name="password" value="{{ old('password') }}" type="password" class="form-control item" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-check checkbox-style mb-30">
                  <input class="form-check-input" type="checkbox" name="remember" value="1" id="checkbox-remember">
                  <label class="form-check-label" for="remember"><small>Recordarme</small></label>
                </div>
            </div>
            <div class="col-sm-6" style="display: none">
                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                  <a href="#" style="color: #212529;" class="hover-underline">
                    <small>¿Has olvidado tu contraseña?</small>
                  </a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">Entrar</button>
        </div>

        {{-- <a class="pokioj" href="/admin/forget-password"><small>¿Has olvidado tu contraseña?</small></a> --}}
    </form>
</div>

@endsection