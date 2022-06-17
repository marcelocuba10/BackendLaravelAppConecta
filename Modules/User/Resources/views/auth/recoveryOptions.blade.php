@extends('user::tema.auth-master')

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
                    <a href="/user/login"><i class="fa fa-arrow-left" aria-hidden="true"></i> <span class="dfdfdf">Back</span></a>
                </div>
                <h2 class="font-bold">Need Some Help?</h2>
                <p>Select one of the options for regaining access to your account</p>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox collapsed" style="margin-bottom: 0px">
                            <div class="ibox-title">
                                <i class="icddd fa fa-envelope-open" aria-hidden="true"></i>
                                <a style="color: #000;" href="/user/forget-password"><h5>Send Recovery Password by Email</h5></a>
                                <p class="llpl">
                                    Give us the email address you used to sign in to Conectacode and we'll send you instructions to reset your password.
                                </p>
                            </div>
                        </div>
                        <div class="ibox collapsed" style="margin-bottom: 0px">
                            <div class="ibox-title">
                                <i class=" icddd fa fa-keyboard-o" aria-hidden="true"></i>
                                <a style="color: #000;" href="#"><h5>12 word seed phrase key</h5></a>
                                <p class="llpl">
                                    Use your 12 word Secret Private Key Recovery Phrase to access your Wallet.
                                </p>
                            </div>
                        </div>
                        <div class="ibox collapsed" style="margin-bottom: 0px">
                            <div class="ibox-title">
                                <i class="icddd fa fa-google" aria-hidden="true"></i>
                                <a style="color: #000;" href="#"><h5>Use Google Authenticator</h5></a>
                                <p class="llpl">
                                    Reset your 2FA right now to gain access to your Wallet.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 style="text-align: center;margin-top:10px" class="font-bold">Still need help? <a href="#" target="_blank">Contact Support</a></h3>
            </div>
        </div>
    </div>
</div>

@endsection
