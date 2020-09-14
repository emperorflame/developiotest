<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class LoginController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_email' => 'required|email',
            'login_password' => 'required|alphaNum|min:3'
        ]);

        $userData = [
            'email' => $request->get('login_email'),
            'password' => $request->get('login_password')
        ];

        if(Auth::attempt($userData)){
            return redirect('tickets');
        }else{
            return back()->withErrors('Hibás felhasználónév vagy jelszó!');
        }

    }

    public function logout ()
    {
        Auth::logout();
    }
}
