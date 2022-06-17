@extends('user::layouts.auth.auth-master')

@section('content')

    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <a href="/"><img src="/img/login.jpg" alt="login" class="login-card-img"></a>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <img src="/img/logo.svg" alt="logo" class="logo">
                            </div>
                            <p class="login-card-description">Regístrese grátis en jahuga.com</p>
                            <form method="post" action="/user/register">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                @include('user::includes.alerts')

                                <div class="form-group">
                                    <label for="text" class="sr-only">Nombre Completo</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="form-control" placeholder="Nombre Completo" required>
                                    @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="text" class="sr-only">Nombre de la Empresa</label>
                                    <input name="company" value="{{ old('company') }}" type="text" class="form-control" placeholder="Nombre empresa" required>
                                    @if ($errors->has('company'))
                                    <span class="text-danger text-left">{{ $errors->first('company') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required>
                                    @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input name="password" value="{{ old('password') }}" type="password" class="form-control" placeholder="Contraseña">
                                    @if ($errors->has('password'))
                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input name="confirm_password" value="{{ old('confirm_password') }}" type="password" class="form-control item" placeholder="Confirme Contraseña" required>
                                    @if ($errors->has('confirm_password'))
                                        <span class="text-danger text-left">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox i-checks"><label> 
                                        <input name="terms" value="1" style="margin-right: 10px;" type="checkbox"><i></i><small>By signing up, you agree to ConectaCode <a class="sdfdd" href="#">Terms of Service</a> and <a class="sdfdd" href="#">Privacy Policy</a>. </small></label></div>
                                        @if ($errors->has('terms'))
                                            <span class="text-danger text-left">{{ $errors->first('terms') }}</span>
                                        @endif
                                </div>

                                <input type="submit" class="btn btn-block login-btn mb-4" type="button" value="Registrar Cuenta">
                            </form>
                            <a href="#!" class="forgot-password-link">Olvidó su contraseña?</a>
                            <p class="login-card-footer-text">Ya tiene una cuenta? <a href="/user/login" class="text-reset">Inicie sesión aquí</a></p>
                            <nav class="login-card-footer-nav">
                                <p>Facilidades increíbles para tu empresa! :)</p>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @endsection