<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPage(){
        return view('backend.pages.Auth.login');
    }

    public function login(Request $request){
        $validated=$request->validate([
            'email'=>'required|email',
            'password'=>'required|string|min:6'
        ]);

        $credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        //login attempt if success than rediret dashboard
        if(Auth::attempt($credentials,$request->filled('remember')))
        {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');

        }
        //return error messsage
        return back()->withErrors([
            'email'=>'Wrong Credentials found!'
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');

    }
}
