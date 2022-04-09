<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\A_class;
use App\Models\Entrance_exam_form;
use App\Models\Entrance_exam_process;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;

class StudentController extends Controller
{
    public function studentHome(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        return view('student/home', $data);
    }
    public function applyforexam(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $classes = A_class::get();
        return view('student/applyforexam', $data, compact('classes'));
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
        if ($response) {
            return 'success';
        } else{
            session()->forget(['mobileotp', 'mobilenumber']);
            return 'failed';
        }
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
    public function viewProfile(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $studentdata = Student::where('id', '=', session('LoggedStudent'))->first();
        return view('student/viewprofile',$data, compact('studentdata'));
    }
    public function updateProfile(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $studentdata = Student::where('id', '=', session('LoggedStudent'))->first();
        return view('student/updateprofile',$data, compact('studentdata'));
    }
    public function changePassword(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $studentdata = Student::where('id', '=', session('LoggedStudent'))->first();
        return view('student/changepassword',$data, compact('studentdata'));
    }
    //Get Class Amount Start
    public function getClassAmount(Request $request){
        $cid = $request->post('cid');        
        $getamountpro = A_class::where('id', $cid)->first();
        $getamount = $getamountpro->amount;
        return $getamount;
    }
    //Get Class Amount End

    //Entrance Exam Form Process Start
    public function studentEntranceExam(Request $request){
        $request->validate([
            'class_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|min:10|max:10',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'aadhar_card' => 'required|max:500|image|mimes:jpg,jpeg,png',
            'father_aadhar_card' => 'required|max:500|image|mimes:jpg,jpeg,png',
            'last_year_marksheet' => 'required|max:500|image|mimes:jpg,jpeg,png',
            'registration_fee' => 'required',
        ]);

        if ($request->hasfile('aadhar_card')) {
            $file = $request->file('aadhar_card');
            $extenstion = $file->getClientOriginalExtension();
            $aadhar_card = 'aadhar_card-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $aadhar_card);
        }

        if ($request->hasfile('father_aadhar_card')) {
            $file = $request->file('father_aadhar_card');
            $extenstion = $file->getClientOriginalExtension();
            $father_aadhar_card = 'father_aadhar_card-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $father_aadhar_card);
        }

        if ($request->hasfile('last_year_marksheet')) {
            $file = $request->file('last_year_marksheet');
            $extenstion = $file->getClientOriginalExtension();
            $last_year_marksheet = 'last_year_marksheet-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $last_year_marksheet);
        }

        $tokenno = time().rand(1111,9999);
        $entrancepost = Entrance_exam_process::create([
            "token_no" => "$tokenno",
            "class_id" => "$request->class_id",
            "name" => "$request->name",
            "email" => "$request->email",
            "mobile" => "$request->mobile",
            "country" => "$request->country",
            "state" => "$request->state",
            "city" => "$request->city",
            "pincode" => "$request->pincode",
            "aadhar_card" => "$aadhar_card",
            "father_aadhar_card" => "$father_aadhar_card",
            "last_year_exam_marksheet" => "$last_year_marksheet",
            "registration_fee" => "$request->registration_fee",
            "status" => 1,
        ]);

        if ($entrancepost) {
            return redirect('student/entrance-exam-preview'.'/'.$tokenno);
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }
    //Entrance Exam Form Process End

    //Entrance Exam Form Preview Start
    public function studentEntranceExamPreview($tokenno){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $getdetails = Entrance_exam_process::where('token_no',$tokenno)->first();
        $classname = A_class::where('id', $getdetails->class_id)->first();
        // dd($getdetails); die;
        return view('student/entrance-exam-preview', $data, compact('getdetails', 'classname'));
    }
    //Entrance Exam Form Preview End

    public function studentEntranceFinalSubmit(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
            $form_id = rand(111,999).time();
            $formfilled = new Entrance_exam_form;
            $formfilled->form_id = $form_id;
            $formfilled->class_id = $request->class_id;
            $formfilled->name = $request->name;
            $formfilled->mobile = $request->mobile;
            $formfilled->email = $request->email;
            $formfilled->country = $request->country;
            $formfilled->state = $request->state;
            $formfilled->city = $request->city;
            $formfilled->pincode = $request->pincode;
            $formfilled->aadhar_card = $request->aadhar_card;
            $formfilled->father_aadhar_card = $request->father_aadhar_card;
            $formfilled->last_year_exam_marksheet = $request->last_year_exam_marksheet;
            $formfilled->registration_fee = $request->registration_fee;
            $formfilled->transaction_id = time().rand(11,99).date('yd');
            $formfilled->payment_id = $request->razorpay_payment_id;
            $formfilled->status = 2;
            $formfilled->save();
            
            $tokenupdate = Entrance_exam_process::where('token_no', $request->tokenno)->update([
                'status' => 2,
            ]);
        }
          
        if ($formfilled && $tokenupdate) {
            return redirect()->route('student.entrance-form-receiept'.'.'.$form_id)->with(session()->flash('alert-success', 'Form successfully received.'));
        } else{
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        }
        // Session::put('success', 'Payment successful');
        // return redirect()->back();
    }

    public function studentEntranceFinalReceipt($form_id){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        return view('student/entrance-form-receiept', $data);
    }
}