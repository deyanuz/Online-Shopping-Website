<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function user()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view("auth.userDashboard", ['orders' => $orders]);
    }

    public function admin()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        $admins = User::where('utype', 'adm')->pluck('id')->count();
        return view("auth.adminDashboard", ['orders' => $orders, 'admins' => $admins]);
    }
    public function updateUser(Request $request)
    {
        $userType = Auth::user()->utype == 'adm' ? 'admin' : 'user';
        //new and confirm password matching condition
        if ($request->input('npassword') == $request->input('cpassword')) {
            $credetials = [
                'email' => Auth::user()->email,
                'password' => $request->password,
            ];
            //current password validity check
            if (Auth::attempt($credetials)) {
                $user = User::find(auth()->id());
                $emailExists = User::where('email', $request->input('email'))->first();
                //availablity of email
                if ($emailExists->id != auth()->id()) {
                    return redirect()->route($userType . '.dashboard')->with('error', 'Email Already Exists!');
                }
                if ($user) {
                    $user->name = $request->input('name');
                    $user->email = $request->input('email');
                    if ($request->input('npassword')) {
                        $user->password = Hash::make($request->input('npassword'));
                    }
                    $user->updated_at = now(); // Update the 'updated_at' timestamp
                    $user->save();
                }
                return redirect()->route($userType . '.dashboard')->with('success', 'Account Updated Successfully!');
            } else {
                return redirect()->route($userType . '.dashboard')->with('error', 'Wrong Email Or Password!');
            }
        } else {
            return redirect()->route($userType . '.dashboard')->with('error', 'Password Does not match!');
        }
    }
}
