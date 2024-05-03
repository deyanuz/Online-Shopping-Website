<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = User::orderBy("created_at","desc")->paginate(5);
        $admins = User::where('utype','adm')->pluck('id');
        return view('auth.users',["users"=>$users,'admins'=>$admins]);
    }
    public function grantPrivilege($id){
        $user = User::find($id);

        if ($user) {
            $user->utype = 'adm';
            $user->updated_at = now();
            $user->save();
        }
        return redirect()->route('admin.users')->with('success','Admin Added Successfully');
    }
    public function revokePrivilege($id){
        $user = User::find($id);

        if ($user) {
            $user->utype = 'usr';
            $user->updated_at = now();
            $user->save();
        }
        return redirect()->route('user.dashboard')->with('success','Admin Removed Successfully');
    }
}
