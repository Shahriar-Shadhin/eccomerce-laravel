<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function updateProfile(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone' => 'required',
            'address' => 'required',
        ]);
        $photo = $req->file('photo');
        if ($req->hasFile('photo')) {

            if (file_exists('upload/users/'. auth()->user()->photo)) {
                
                unlink('upload/users/' . auth()->user()->photo);
            }
            
            $newName = 'user' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('upload/users', $newName);
            auth()->user()->update(['photo' => $newName]);
        }
        $data = [
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'phone' => $req->input('phone'),
            'address' => $req->input('address'),
        ];
        auth()->user()->update($data);
        return \redirect()->route('home');
    }
    public function profile()
    {
        $orders = Order::where('user_id', auth()->user()->id)->with('order_details')->orderBy('id', 'desc')->get();
        // dd($orders);
        $user = Auth::user();
        return view('frontend.profile', compact('user', 'orders'));
    }
    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->flush();
        return \redirect()->route('home');
    }
    public function register()
    {
        return view('frontend.register');
    }
    public function doRegister(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'address' => 'required',
            'password' => 'required|confirmed|min:3'
        ]);
        $date = [
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'phone' => $req->input('phone'),
            'address' => $req->input('address'),
            'password' => Hash::make($req->input('password')),
            'role' => 'customer',
        ];
        User::create($date);

        return \redirect()->route('login');
    }
    public function login()
    {
        return \view('frontend.login');
    }

    public function doLogin(Request $req)
    {
        // dd($req->all());
        $cred = $req->only('email', 'password');
        if (Auth::attempt($cred)) {
            if (auth()->user()->role == 'admin') {
                return \redirect()->route('dashboard');
            }

            return \redirect()->route('home');
        }
        return \redirect()->back();
    }
}
