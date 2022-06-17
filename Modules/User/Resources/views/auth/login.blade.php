@extends('user::layouts.auth.auth-master')

@section('content')

<div class="container">
    <div class="left"></div>
    <div class="right">
        <div class="ergts">
            <a href="/"><button class="ththhf" type="button" class="btn btn-block create-account">Site ConectaCode</button></a>
        </div>    
        <div class="login-texto">
            <p class="login-title">Bienvenido a ConectaCode</p>
            <p class="login-message">Facilidades increíbles para tu empresa! :)</p>
        </div>
    </div>    
</div> 

<div class="registration-form">
    
    <form method="post" action="/user/login">

        <div class="form-icon">
            <img class="img-logo" src="/img/conectacode.png">
        </div>
        <p class="login-message2">Sign in to ConectaCode</p>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="form-group">
            <input name="email" value="{{ old('email') }}" type="text" class="form-control item" placeholder="Email" required>
        </div>

        <div class="form-group">
            <input name="password" value="{{ old('password') }}" type="password" class="form-control item" placeholder="Password" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">Login</button>
        </div>

        <a class="pokioj" href="#"><small>Need some help?</small></a>
        <p class="text-muted text-center" style="margin-bottom: 0px;margin-top: 15px;"><small>Don't have an
                account?</small></p>
        <a class="btn btn-sm btn-white btn-block" style="text-decoration: underline;" href="#">Create an
            account</a>
    </form>
</div>

-->

@endsection