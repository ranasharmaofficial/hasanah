<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Distributor;
use App\Models\Project;
use App\Models\Project_request;
use App\Models\Company;
use App\Models\User_login_history;
use App\Models\Project_category;
use App\Models\User_project;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function login(){
        return view('employee/auth/login');
    }

    public function employeeAuthLogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        
        $ip=$_SERVER['REMOTE_ADDR'];
        $userLoginHistory = User_login_history::create([
            "user_id" => "$request->username",
            "ip_address" => "$ip"
        ]);
        
        $userInfo = User::where('user_id','=',$request->username)->where('role', '2')->where('status', '1')->first();
        if (!$userInfo) {
            return redirect()->route('employee.login')->with(session()->flash('alert-warning', 'Failed! We do not recognize your username.'));
        } else if ($userInfo->status == '0') {
            return redirect()->route('employee.login')->with(session()->flash('alert-danger', 'Your account is blocked. Please! contact company for un-block.'));
        } else if ($request->password === $userInfo->password) {
            $request->session()->put('LoggedEmployee', $userInfo->id);
            return redirect('employee/home');
        } else {
            return redirect()->route('employee.login')->with(session()->flash('alert-danger', 'Failed! Incorrect Password.'));
        }
        
        
    }    
    public function employeeLogout(){
        if (session()->has('LoggedEmployee')) {
            session()->pull('LoggedEmployee');
            return redirect('employee/login')->with(session()->flash('alert-success', 'You are successfully Logged out'));
        }
    }
    
    public function employeeHome(){
        $data = ['LoggedEmployee'=>User::where('id','=', session('LoggedEmployee'))->first()];
        $employeedata = User::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $employeedetails = Employee::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $companydata = Company::where('company_id',$employeedetails->company_id)->first();
        $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->take(1)->first();;
        return view('employee/home', $data, compact('employeedata','employeedetails','companydata', 'lastLoginTime'));
    }
    
}