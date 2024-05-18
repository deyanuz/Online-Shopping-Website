<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy("created_at", "desc")->paginate(5);
        $admins = User::where('utype', 'adm')->pluck('id');
        return view('auth.users', ["users" => $users, 'admins' => $admins]);
    }
    public function grantPrivilege($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->utype = 'adm';
            $user->updated_at = now();
            $user->save();
        }
        return redirect()->route('admin.users')->with('success', 'Admin Added Successfully');
    }
    public function revokePrivilege($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->utype = 'usr';
            $user->updated_at = now();
            $user->save();
        }
        return redirect()->route('user.dashboard')->with('success', 'Admin Removed Successfully');
    }
    public function searchUser(Request $request)
    {
        $q = $request->input('q');
        $users = User::where('name', 'like', '%' . $q . '%')
            ->orWhere('email', 'like', '%' . $q . '%')
            ->paginate(5);
        $admins = User::where('utype', 'adm')->pluck('id');
        return view('auth.searchUser', ['users' => $users, 'admins' => $admins, 'q' => $q]);
    }
    public function deleteAccount(){
        $user = Auth::user();
        // Delete the user
        $user->delete();
        Auth::logout();
        return redirect()->route("auth.register")->with("success", "Account Removed Successfully!");
    }
}
