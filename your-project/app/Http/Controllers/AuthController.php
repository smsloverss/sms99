<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if ($request->has(['username', 'password'])) {
            if (Auth::guard('web')->attempt([
                'name' => $request->input('username'),
                'password' => $request->input('password'),
            ])) {
                return redirect()->route('dashboard');
            }
        }
        return redirect()->back();
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['unique:users', 'required'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('name') . '@qq.cc',
            'email_verified_at' => Carbon::now(),
        ]);

        if ($user->id) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        return redirect()->back();

    }
}
