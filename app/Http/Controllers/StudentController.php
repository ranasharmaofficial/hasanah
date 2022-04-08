<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studentHome(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        return view('student/home', $data);
    }
    public function applyforexam(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        return view('student/applyforexam', $data);
    }

    public function studentGetOTP(Request $request){
        $request->validate([
            'mobile' => 'required|unique:students,mobile',
        ]);
        $mobileotp = $request->mobile;
        $mobileotpsend = rand(111111,999999);
        session()->put('mobilenumber',$mobileotp);
        session()->put('mobileotp',$mobileotpsend);
        $msg = 'Dear Student, '.$mobileotpsend.' is your one time password (OTP). Please enter the OTP to proceed. Thank You, Regards - HASANAH EDUCATIONAL TRUST';
        $phones = $mobileotp;
        $url = "http://45.249.108.134/api.php";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=hasanahtrust&password=752761&sender=HETRST&sendto=".$phones."&message=".$msg."&PEID=1301164733895014972&templateid=1307164922578115135&type=3");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        return 'success';
    }

    public function studentRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|max:190',
            'mobile' => 'required|max:20|unique:students,mobile',
            'otp' => 'required',
            'password' => 'required',
            'cpassword' => 'required',
        ]);
        $mobile = $request->mobile;
        $otp = $request->otp;
        $sessotp = session()->get('mobileotp');
        $sessmob = session()->get('mobilenumber');
        if ($mobile == $sessmob && $otp == $sessotp) {
            if ($request->password == $request->cpassword) {
                $studentid = Student::orderBy('id', 'desc')->first();
                if (isset($studentid)) {
                    // Sum 1 + last id
                    $reuserid = substr($studentid->student_id, 3);
                    $userid = $reuserid + 1;
                    $studentidgen = 'HET' . $userid . '';
                } else {
                    $studentidgen = 'HET101';
                }
                Student::create([
                    "student_id" => "$studentidgen",
                    "name" => "$request->name",
                    "email" => "$request->email",
                    "mobile" => "$mobile",
                    "password" => "$request->password",
                ]);
                session()->forget(['mobileotp', 'mobilenumber']);
                return redirect()->back()->with(session()->flash('alert-success', 'You have successfully registered in Hasanah Educational Trust.'));
            }else{
                return redirect()->back()->with(session()->flash('alert-warning', 'Password and Confirm Password not matched.'));
            }}
        return redirect()->back()->with(session()->flash('alert-danger', 'That is not the OTP that we have sent. Please check and try again.'));
    }

    public function studentLogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        
        
        $studentInfo = Student::where('student_id','=',$request->username)->where('status', '1')->first();
        if (!$studentInfo) {
            return redirect()->route('login')->with(session()->flash('alert-warning', 'Failed! We do not recognize your username.'));
        } else if ($studentInfo->status == '0') {
            return redirect()->route('login')->with(session()->flash('alert-danger', 'Your account is blocked.'));
        } else if ($request->password === $studentInfo->password) {
            $request->session()->put('LoggedStudent', $studentInfo->id);
            return redirect('student/home');
        } else {
            return redirect()->route('login')->with(session()->flash('alert-danger', 'Failed! Incorrect Password.'));
        }
        
        
    }
    public function studentLogout(){
        if (session()->has('LoggedStudent')) {
            session()->pull('LoggedStudent');
            return redirect('login')->with(session()->flash('alert-success', 'You are successfully Logged out'));
        }
    }
}