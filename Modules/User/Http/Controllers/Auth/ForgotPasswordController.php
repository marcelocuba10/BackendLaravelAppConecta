<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//add
//use DB; 
//use Mail;
//use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\User\Entities\User;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('user::auth.forgetPassword');
    }

    public function showRecoveryOptionsForm()
    {
        return view('user::auth.recoveryOptions');
    }

    public function templateEmail(){
        return view('user::layouts.email.forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('reset_password_users')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('user::layouts.email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Restablecer la contraseña en Conectacode');
        });

        return back()->with('message', '¡Le hemos enviado por correo electrónico un enlace para restablecimiento de contraseña!');
    }

    public function showResetPasswordForm($token)
    {
        return view('user::auth.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {

        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required|max:50|min:5|same:password',
        ]);

        $updatePassword = DB::table('reset_password_users')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Email inválido, verifique datos por favor.');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('reset_password_users')->where(['email' => $request->email])->delete();

        return redirect()->to('/user/login')->with('message', '¡Tu contraseña ha sido cambiada!');
    }
}
