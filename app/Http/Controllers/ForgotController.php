<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Facades\Hash;
class ForgotController extends Controller
{
    public function index()
    {
        return view("auth.forgot");
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->count();
        if ($user == 0) {
            return redirect()->route('auth.forgotPage')->with('error', 'User does not exist.');
        }
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);
        Mail::send('emails.resetLink', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return redirect()->route('auth.forgotPage')->with('success', 'Reset link sent to the given mail');
    }
    public function resetPassword($token)
    {
        return view('auth.resetPassword', ['token' => $token]);
    }
    public function updatePassword(Request $request)
    {
        if ($request->npassword != $request->cpassword) {
            return  redirect()->route('auth.resetPassword', ['token' => $request->token])->with('error', 'Password Does Not Match');
        }
        $updatePasswordUser=DB::table('password_reset_tokens')->where([
            'token'=>$request->token
        ])->first();
        $user=User::where('email',$updatePasswordUser->email)->first();
        $user->password = Hash::make($request->input('npassword'));
        $user->updated_at=now();
        $user->save();
        return redirect()->route('auth.login')->with('success','Password Reset Successful');
    }
}
