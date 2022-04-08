<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\School_admin;
use App\Models\Student;
use App\Models\A_class;
use Illuminate\Http\Request;

class SchoolAdminController extends Controller
{
    public function login(){
        return view('schooladmin/auth/login');
    }
    public function schooladminLogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        $schoolAdminInfo = School_admin::where('user_id','=',$request->username)->where('status', '1')->first();
        if (!$schoolAdminInfo) {
            return redirect()->route('schooladmin/login')->with(session()->flash('alert-warning', 'Failed! We do not recognize your username.'));
        } else if ($schoolAdminInfo->status == '0') {
            return redirect()->route('schooladmin/login')->with(session()->flash('alert-danger', 'Your account is blocked.'));
        } else if ($request->password === $schoolAdminInfo->password) {
            $request->session()->put('LoggedSchoolAdmin', $schoolAdminInfo->id);
            return redirect('schooladmin/home');
        } else {
            return redirect()->route('schooladmin/login')->with(session()->flash('alert-danger', 'Failed! Incorrect Password.'));
        }
    }
    public function schoolAdminLogout(){
        if (session()->has('LoggedSchoolAdmin')) {
            session()->pull('LoggedSchoolAdmin');
            return redirect('schooladmin/login')->with(session()->flash('alert-success', 'You are successfully Logged out'));
        }
    }
    public function schoolAdminHome(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        return view('schooladmin/home', $data);
    }
    public function studentList(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $studentlist = Student::paginate(10);
        return view('schooladmin/studentlist', $data, compact('studentlist'));
    }
    public function addClass(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        return view('schooladmin/addclass', $data);
    }
    public function classList(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $classlist = A_class::paginate(10);
        return view('schooladmin/classlist',$data, compact('classlist'));
    }
    public function uploadClass(Request $request){
        $request->validate([
            'classname' => 'required',
            'classamount' => 'required',
        ]);
        $classdetails = new A_class;
        $classdetails->class_name = $request->classname;
        $classdetails->amount = $request->classamount;
        $classdetails-> save();
        if($classdetails){
            return redirect()->back()->with(session()->flash('alert-success', 'Class Added Successfully!'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 

    }
   
}