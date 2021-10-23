<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function index()
    {
        return view('contents.dashboard');
    }

    public function login()
    {
        return view('welcome');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/')->with('success', 'Success logout');
    }

    public function verified_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $kredensil = $request->only('username', 'password');

        $userInfo = User::where('username', '=', $request->username)->first();

        if (!$userInfo) {
            return back()->with('fail', 'Username not found');
        } else {

            //check password
            if (Hash::check($request->password, $userInfo->password)) {
                if (Auth::attempt($kredensil)) {
                    $user = Auth::user();
                    return redirect()->intended('dashboard')->with('success', 'Login berhasil.');
                } else {
                    return redirect('/');
                }
            } else {
                return back()->with('fail', 'Password incorrect');
            }
        }
    }
}
