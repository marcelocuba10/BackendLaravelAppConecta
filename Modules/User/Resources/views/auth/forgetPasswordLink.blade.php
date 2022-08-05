@extends('user::layouts.auth.auth-master')

@section('content')

<div class="container">
    <div class="left"></div>
    <div class="right">
        <div class="ergts">
            <a href="/"><button class="ththhf" type="button" class="btn btn-block create-account">Página Web</button></a>
        </div>    
        <div class="login-texto">
            <p class="login-title">Bienvenido a ConectaCode</p>
            <p class="login-message">Facilidades increíbles para tu empresa! :)</p>
        </div>
    </div>    
</div> 

<div class="registration-form">
    
    <form method="post" action="/user/reset-password">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-icon"><img class="img-logo" src="/img/conectacode.png"></div>
        <p class="login-message2">Restablecer la Contraseña</p>
        
        <div class="form-group">
            <input name="email" type="email" value="{{ old('email') }}" class="form-control item" placeholder="Email" required>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group">
            <input name="password" type="password" value="{{ old('password') }}" class="form-control item" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group">
            <input name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="form-control item" placeholder="Confirm Password" required>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">Restablecer Contraseña</button>
        </div>

        <p class="text-muted text-center" style="margin-bottom: 0px;margin-top: 15px;"><small>¿Ya tienes una cuenta?</small></p>
        <a class="btn btn-sm btn-white btn-block" style="text-decoration: underline;" href="/user/login">Iniciar Sesión</a>
    </form>
</div>

@endsection