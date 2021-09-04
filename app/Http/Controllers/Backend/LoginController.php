<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm(){
        return \view('backend.login');
    }

    public function login(Request $request){
        $cred = $request->only('email', 'password');
        // dd($cred);
        if(Auth::attempt($cred)){
            // dd(auth()->user());
            return \redirect()->route('dashboard');

        }
        return \redirect()->back();
    }

    public function logout(){
        Auth::logout();
        return \redirect()->route('admin.login');
    }
}
