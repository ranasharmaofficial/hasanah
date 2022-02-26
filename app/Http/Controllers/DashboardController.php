<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(){
        return view('dashboard.home');
    }
    public function login(){
        return view('dashboard.auth.login');
    }
    public function forgetPassword(){
        return view('dashboard.auth.forget-password');
    }
    public function profile(){
        return view('dashboard.profile');
    }
}
