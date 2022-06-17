@extends('admin::tema.auth-master')
  
@section('content')
<div class="passwordBox animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <div class="gYHxjZ">
                <a href="/">
                    <img src="/img/conecta_branco.png" class="huRTra" color="auto" width="auto">
                </a>
            </div>
            <div class="ibox-content recovery-ibox">
                <div class="grfsd">
                    <a href="/admin/recovery-options"><i class="fa fa-arrow-left" aria-hidden="true"></i> <span class="dfdfdf">Back</span></a>
                </div>
                <h2 class="font-bold">Forgot password</h2>
                <p>Enter your email address and your password will be reset and emailed to you.</p>

                <div class="row">
                    <div class="col-lg-12">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <form class="m-t" role="form" action="/admin/forget-password" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" id="email_address" name="email" class="form-control" placeholder="Email address" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary block full-width m-b">Send new password</button>
                        </form>
                    </div>
                </div>
                <h3 style="text-align: center;margin-top:10px" class="font-bold">Still need help? .<a href="#" target="_blank">Contact Support</a></h3>
            </div>
        </div>
    </div>
</div>

@endsection