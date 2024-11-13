<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function loginSave(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);
        $user = User::where('email', $request->email)->first();
        if(isset($user->password)){
            if (Hash::check($request->password, $user->password)) {
                session(["admin" => "admin"]);
                return to_route('create');
            }else{
                return back()->withErrors([
                    'password' => "your password is incorrect!"
                ]);  
            }
        }else{
            return back()->withErrors([
                'email' => "your email dosen't exit on our sever!"
            ]);
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerSave(Request $request)
    {
        $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6'
            ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        session(["admin" => "admin"]);
        return to_route('create');
    }



    public function logout()
    {
        session()->forget('admin');
        return to_route('posts');
    }

    public function userlist()
    {
        return User::all();
    }
}
