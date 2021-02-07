<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login() {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }

        return view('site.login');
    }

    public function loginAuthUser(Login $request) {

        $credentials = ["email" => $request->email, "password" => $request->password];

        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login');
        }
    }

    public function register() {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }

        return view('site.register');
    }


    public function registerNewUser(Register $request) {
        //validar o usuario
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->Password = $request->password;

        $user->save();

        return redirect()->route('login');
    }

    public function logout() {

        if(!Auth::check()){
            return redirect()->route('login');
        }

        Auth::logout();

        //mudar essa rota para home
        return redirect()->route('login');
    }
}
