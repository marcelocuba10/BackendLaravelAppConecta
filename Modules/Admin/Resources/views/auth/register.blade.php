@extends('admin::layouts.auth-master')

@section('content')

    <div class="container">
        <div class="left"></div>
        <div style="right">
            <div class="rwedrt">
                <a href="/user/login/"><button class="ththhf" type="button" class="btn btn-block create-account">User Login</button></a>
                <a href="/"><button class="ththhf" type="button" class="btn btn-block create-account">Site ConectaCode</button></a>
            </div>
            <div class="register-texto">
                <p class="login-title">Sea parte de ConectaCode</p>
                <p class="login-message">Facilidades increíbles para tu empresa! :)</p>
            </div>
        </div>
    </div>

    <div class="registration-form-2">
        
        <form class="m-t" role="form" method="post" action="/admin/register">
            <div class="form-icon">
                <img class="img-logo" src="/img/apiscrowd.png">
            </div>
            <p class="login-message2">Sign up to ApisCrowd</p>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            @include('admin::includes.alerts')

            <div class="form-group">
                <input name="name" value="{{ old('name') }}" type="text" class="form-control item" placeholder="Name" required>
                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input name="username" value="{{ old('username') }}" type="text" class="form-control item" placeholder="Username" required>
                @if ($errors->has('username'))
                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input name="email" value="{{ old('email') }}" type="email" class="form-control item" placeholder="Email" required>
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
            <div class="form-group">
                <input name="confirm_password" value="{{ old('confirm_password') }}" type="password" class="form-control item" placeholder="Confirm Password" required>
                @if ($errors->has('confirm_password'))
                    <span class="text-danger text-left">{{ $errors->first('confirm_password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox i-checks"><label> <input name="terms" value="1" style="margin-right: 10px;" type="checkbox"><i></i><small>By signing up, you agree to ConectaCode <a class="sdfdd" href="#">Terms of Service</a> and <a class="sdfdd" href="#">Privacy Policy</a>. </small></label></div>
                @if ($errors->has('terms'))
                    <span class="text-danger text-left">{{ $errors->first('terms') }}</span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Registrar</button>
            </div>
            
            <p class="text-muted text-center" style="margin-bottom: 0px;margin-top: 15px;"><small>Already have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" style="text-decoration: underline;" href="/admin/login">Sign In</a>
        </form>
    </div>
    
@endsection

