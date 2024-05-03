<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view("auth.register");
    }

    public function registerUser(Request $request)
    {
        $emailExists = User::where('email', $request->input('email'))->first();
        //availablity of email
        if ($emailExists) {
            return redirect()->route('auth.register')->with('error', 'Email Already Exists!');
        }
        if ($request->input('password') != $request->input('cpassword')) {
            return redirect()->route('auth.register')->with('error', 'Password Does not match!');
        }
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return back()->with('success', 'Register successfully');
    }
}
