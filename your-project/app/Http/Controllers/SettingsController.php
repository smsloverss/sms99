<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function show()
    {
        return view('settings');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
           'password' => 'required',
        ]);

        $user = auth()->user();

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('dashboard');
    }
}
