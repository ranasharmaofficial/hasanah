<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\A_class;
use App\Models\Entrance_exam_form;
use App\Models\Entrance_exam_process;
use App\Models\User_login_history;
use App\Models\School;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    public function studentHome(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $userloginhistory = User_login_history::where('user_id', $data['LoggedStudentInfo']->student_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedStudentInfo']->student_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedStudentInfo']->student_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        return view('student/home', $data, compact('lastLoginTime'));
    }
    public function applyforexam(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        // dd($data); die;
        $classes = A_class::get();
        $school = School::get();
        $getformappliedornot = Entrance_exam_form::where('student_id', $data['LoggedStudentInfo']->student_id)->first();
        return view('student/applyforexam', $data, compact('classes', 'school', 'getformappliedornot'));
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
        
        $ip=$_SERVER['REMOTE_ADDR'];
        $userLoginHistory = User_login_history::create([
            "user_id" => "$request->username",
            "ip_address" => "$ip"
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
            'school_id' => 'required',
            'class_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|min:10|max:10',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'passport_photo' => 'required|max:500|image|mimes:jpg,jpeg,png',
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
        if ($request->hasfile('passport_photo')) {
            $file = $request->file('passport_photo');
            $extenstion = $file->getClientOriginalExtension();
            $passport_photo = 'passport_photo-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $passport_photo);
        }

        $tokenno = time().rand(1111,9999);
        $studentid = Student::where('id','=', session('LoggedStudent'))->first();
        $entrancepost = Entrance_exam_process::create([
            "token_no" => "$tokenno",
            "student_id" => "$studentid->student_id",
            "school_id" => "$request->school_id",
            "class_id" => "$request->class_id",
            "name" => "$request->name",
            "email" => "$request->email",
            "mobile" => "$request->mobile",
            "country" => "$request->country",
            "state" => "$request->state",
            "city" => "$request->city",
            "pincode" => "$request->pincode",
            "passport_photo" => "$passport_photo",
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
            $studentid = Student::where('id','=', session('LoggedStudent'))->first();
            $form_id = rand(111,999).time();
            $formfilled = new Entrance_exam_form;
            $formfilled->student_id = $studentid->student_id;
            $formfilled->form_id = $form_id;
            $formfilled->class_id = $request->class_id;
            $formfilled->school_id = $request->school_id;
            $formfilled->name = $request->name;
            $formfilled->mobile = $request->mobile;
            $formfilled->email = $request->email;
            $formfilled->country = $request->country;
            $formfilled->state = $request->state;
            $formfilled->city = $request->city;
            $formfilled->pincode = $request->pincode;
            $formfilled->passport_photo = $request->passport_photo;
            $formfilled->aadhar_card = $request->aadhar_card;
            $formfilled->father_aadhar_card = $request->father_aadhar_card;
            $formfilled->last_year_exam_marksheet = $request->last_year_exam_marksheet;
            $formfilled->registration_fee = $request->registration_fee;
            $formfilled->transaction_id = time().rand(11,99).date('yd');
            $formfilled->payment_id = $request->razorpay_payment_id;
            $formfilled->status = 1;
            $formfilled->save();
            
            $tokenupdate = Entrance_exam_process::where('token_no', $request->tokenno)->update([
                'status' => 2,
            ]);
        }
          
        if ($formfilled && $tokenupdate) {
            return redirect('student/entrance-form-receiept'.'/'.$form_id)->with(session()->flash('alert-success', 'Form successfully received.'));
        } else{
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        }
        // Session::put('success', 'Payment successful');
        // return redirect()->back();
    }

    public function studentEntranceFinalReceipt($form_id){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $studendetails = Entrance_exam_form::where('form_id', $form_id)->first();
        return view('student/entrance-form-receiept', $data, compact('studendetails'));
    }

    public function editStudentDetails($token_no){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $classes  = A_class::get();
        $school = School::get();
        $studendetails = Entrance_exam_process::where('token_no', $token_no)->first();
        $getappliedornot = Entrance_exam_form::where('student_id', $data['LoggedStudentInfo']->student_id)->first();
        return view('student/editexampapplyform', $data, compact('studendetails', 'classes', 'school', 'getappliedornot'));
    }

    public function studentEntranceExamEdit(Request $request){
        $request->validate([
            'school_id' => 'required',
            'class_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|min:10|max:10',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'registration_fee' => 'required',
        ]);

        $entrancepostedit = Entrance_exam_process::where('token_no',$request->token_no)->where('student_id',$request->student_id)->update([
            'school_id' => $request->school_id,
            'class_id' => $request->class_id,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'registration_fee' => $request->registration_fee,
            'status' => 1,
        ]);

        if ($request->hasfile('aadhar_card')) {
            $request->validate([
                'school_id' => 'required',
                'class_id' => 'required',
                'name' => 'required|string',
                'email' => 'required|email',
                'mobile' => 'required|min:10|max:10',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'aadhar_card' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'registration_fee' => 'required',
            ]);
            $file = $request->file('aadhar_card');
            $extenstion = $file->getClientOriginalExtension();
            $aadhar_card = 'aadhar_card-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $aadhar_card);

            $entrancepostedit = Entrance_exam_process::where('token_no',$request->token_no)->where('student_id',$request->student_id)->update([
                'school_id' => $request->school_id,
                'class_id' => $request->class_id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'aadhar_card' => $aadhar_card,
                'registration_fee' => $request->registration_fee,
                'status' => 1,
            ]);
            if($entrancepostedit) {
                return redirect('student/entrance-exam-preview'.'/'.$request->token_no);
            }
            return redirect('student/entrance-exam-preview'.'/'.$request->token_no)->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        }

        if ($request->hasfile('father_aadhar_card') && $request->hasfile('aadhar_card')) {
            $request->validate([
                'school_id' => 'required',
                'class_id' => 'required',
                'name' => 'required|string',
                'email' => 'required|email',
                'mobile' => 'required|min:10|max:10',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'father_aadhar_card' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'aadhar_card' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'registration_fee' => 'required',
            ]);
            $file = $request->file('aadhar_card');
            $extenstion = $file->getClientOriginalExtension();
            $aadhar_card = 'aadhar_card-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $aadhar_card);

            $file = $request->file('father_aadhar_card');
            $extenstion = $file->getClientOriginalExtension();
            $father_aadhar_card = 'father_aadhar_card-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $father_aadhar_card);

            $entrancepostedit = Entrance_exam_process::where('token_no',$request->token_no)->where('student_id',$request->student_id)->update([
                'school_id' => $request->school_id,
                'class_id' => $request->class_id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'aadhar_card' => $aadhar_card,
                'father_aadhar_card' => $father_aadhar_card,
                'registration_fee' => $request->registration_fee,
                'status' => 1,
            ]);
            if($entrancepostedit) {
                return redirect('student/entrance-exam-preview'.'/'.$request->token_no);
            }
            return redirect('student/entrance-exam-preview'.'/'.$request->token_no)->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        }

        if ($request->hasfile('last_year_marksheet') && $request->hasfile('father_aadhar_card') && $request->hasfile('aadhar_card')) {
            $request->validate([
                'school_id' => 'required',
                'class_id' => 'required',
                'name' => 'required|string',
                'email' => 'required|email',
                'mobile' => 'required|min:10|max:10',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'last_year_marksheet' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'father_aadhar_card' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'aadhar_card' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'registration_fee' => 'required',
            ]);
            $file = $request->file('last_year_marksheet');
            $extenstion = $file->getClientOriginalExtension();
            $last_year_marksheet = 'last_year_marksheet-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $last_year_marksheet);
            
            $file = $request->file('aadhar_card');
            $extenstion = $file->getClientOriginalExtension();
            $aadhar_card = 'aadhar_card-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $aadhar_card);
            
            $file = $request->file('father_aadhar_card');
            $extenstion = $file->getClientOriginalExtension();
            $father_aadhar_card = 'father_aadhar_card-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $father_aadhar_card);

            $entrancepostedit = Entrance_exam_process::where('token_no',$request->token_no)->where('student_id',$request->student_id)->update([
                'school_id' => $request->school_id,
                'class_id' => $request->class_id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'aadhar_card' => $aadhar_card,
                'father_aadhar_card' => $father_aadhar_card,
                'last_year_exam_marksheet' => $last_year_marksheet,
                'registration_fee' => $request->registration_fee,
                'status' => 1,
            ]);
            if($entrancepostedit) {
                return redirect('student/entrance-exam-preview'.'/'.$request->token_no);
            }
            return redirect('student/entrance-exam-preview'.'/'.$request->token_no)->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        }
        if ($request->hasfile('passport_photo') && $request->hasfile('last_year_marksheet') && $request->hasfile('father_aadhar_card') && $request->hasfile('aadhar_card')) {
            $request->validate([
                'school_id' => 'required',
                'class_id' => 'required',
                'name' => 'required|string',
                'email' => 'required|email',
                'mobile' => 'required|min:10|max:10',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'passport_photo' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'last_year_marksheet' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'father_aadhar_card' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'aadhar_card' => 'required|max:500|image|mimes:jpg,jpeg,png',
                'registration_fee' => 'required',
            ]);
            $file = $request->file('passport_photo');
            $extenstion = $file->getClientOriginalExtension();
            $passport_photo = 'passport_photo-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $passport_photo);
            
            $file = $request->file('last_year_marksheet');
            $extenstion = $file->getClientOriginalExtension();
            $last_year_marksheet = 'last_year_marksheet-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $last_year_marksheet);
            
            $file = $request->file('aadhar_card');
            $extenstion = $file->getClientOriginalExtension();
            $aadhar_card = 'aadhar_card-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $aadhar_card);
            
            $file = $request->file('father_aadhar_card');
            $extenstion = $file->getClientOriginalExtension();
            $father_aadhar_card = 'father_aadhar_card-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/student-documents'), $father_aadhar_card);

            $entrancepostedit = Entrance_exam_process::where('token_no',$request->token_no)->where('student_id',$request->student_id)->update([
                'school_id' => $request->school_id,
                'class_id' => $request->class_id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'passport_photo' => $passport_photo,
                'aadhar_card' => $aadhar_card,
                'father_aadhar_card' => $father_aadhar_card,
                'last_year_exam_marksheet' => $last_year_marksheet,
                'registration_fee' => $request->registration_fee,
                'status' => 1,
            ]);
            if($entrancepostedit) {
                return redirect('student/entrance-exam-preview'.'/'.$request->token_no);
            }
            return redirect('student/entrance-exam-preview'.'/'.$request->token_no)->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        }
        if($entrancepostedit) {
            return redirect('student/entrance-exam-preview'.'/'.$request->token_no);
        }
        return redirect('student/entrance-exam-preview'.'/'.$request->token_no)->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public static function getClassName($cid){
        $className = A_class::where('id', $cid)->first();
        $class_name = $className->class_name;
        return $class_name;
    }
    public function getPassportPhoto(Request $request){
        $passreq = $request->post('studentid');
        $data = Entrance_exam_process::where('id',$passreq)->pluck('passport_photo')->first();
        return $data;        
    }
    public function getAadharCard(Request $request){
        $passreq = $request->post('studentid');
        $data = Entrance_exam_process::where('id',$passreq)->pluck('aadhar_card')->first();
        return $data;        
    }
    public function getFatherAadharCard(Request $request){
        $passreq = $request->post('studentid');
        $data = Entrance_exam_process::where('id',$passreq)->pluck('father_aadhar_card')->first();
        return $data;        
    }
    public function getMarkSheet(Request $request){
        $passreq = $request->post('studentid');
        $data = Entrance_exam_process::where('id',$passreq)->pluck('last_year_exam_marksheet')->first();
        return $data;        
    }

    public function studentAdmitCard(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        // dd($data); die;
        $getadmitcard = Entrance_exam_form::where('student_id', $data['LoggedStudentInfo']->student_id)->where('status', '2')->first();
        return view('student/admit-card', $data, compact('getadmitcard'));
    }

    public function changeOldPassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'cpassword' => 'required',
        ]);
        $oldpass = Student::where('id','=', session('LoggedStudent'))->first();
        if ($request->oldpassword == $oldpass->password) {
            if ($request->newpassword == $request->cpassword) {
                $updatepass = Student::where('id','=', session('LoggedStudent'))->update(['password' => $request->newpassword,]);
                if ($updatepass) {
                    return redirect()->back()->with(session()->flash('alert-success', 'Your password successfully changed.'));
                }
            } else{
                return redirect()->back()->with(session()->flash('alert-danger', 'Password and Confirm Password Not Matched.'));
            }
        } else{
            return redirect()->back()->with(session()->flash('alert-danger', 'Please! Enter Correct Old Password.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public function generateAdmitCardPDF(Request $request){
        $request->validate([
            'exam_type' => 'required',
        ]);
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];

        $studentid = Student::where('id','=', session('LoggedStudent'))->first();
        $studentdetails = Entrance_exam_form::where('student_id','=', $studentid->student_id)->first();
        //   dd($studentdetails); die;
        // $pdf = PDF::loadView('student/myAdmitCard', compact('studentdetails'));    
        // return $pdf->download($request->exam_type.'-'.$studentdetails['form_id'].'.pdf');
        return view('student/myAdmitCard', $data, compact('studentdetails'));
    }

    public function getClassNames(Request $request){
        $schoolid = $request->post('school');
        $schooldetails = A_class::where('school_id', $schoolid)->get();
        return $schooldetails;
    }
    
}