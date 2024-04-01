<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function user(){
        return view("auth.userDashboard");
    }

    public function admin(){
        return view("auth.adminDashboard");
    }
}
