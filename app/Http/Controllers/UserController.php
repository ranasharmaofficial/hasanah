<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function registers(){
       return view('user/register');
    }
    public function login(){
        return view('user/login');
    }
    public function workList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/worklist',$data);
    }
    public function workDetails(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/workdetails',$data);
    }
    public function appliedProject(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/appliedproject',$data);
    }
    public function myProject(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/myproject',$data);
    }
    public function uploadImage(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/uploadimage',$data);
    }
    public function uploadVideo(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/uploadvideo',$data);
    }
    
}