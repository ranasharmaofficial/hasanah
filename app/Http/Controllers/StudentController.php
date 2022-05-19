<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\A_class;
use App\Models\Academicyear;
use App\Models\Admission;
use App\Models\Admission_fee;
use App\Models\Batchtime;
use App\Models\Course;
use App\Models\Entrance_exam_form;
use App\Models\Entrance_exam_process;
use App\Models\Exam_schedule;
use App\Models\Fee;
use App\Models\User_login_history;
use App\Models\School;
use App\Models\Student_admission;
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
        $academicyears = Academicyear::get();
        $getformappliedornot = Entrance_exam_form::where('student_id', $data['LoggedStudentInfo']->student_id)->first();
        return view('student/applyforexam', $data, compact('classes', 'school', 'getformappliedornot', 'academicyears'));
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
                //Send Message
                $msg = 'Dear Student, Your registration details are: Username : '.$studentidgen.' Password : '.$request->password.' Visit : https://bit.ly/3uA3gaJ Regards - HASANAH EDUCATIONAL TRUST';
        $phones = $mobile;
        $url = "http://45.249.108.134/api.php";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=hasanahtrust&password=752761&sender=HETRST&sendto=".$phones."&message=".$msg."&PEID=1301164733895014972&templateid=1307164922596635229&type=3");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);

                session()->forget(['mobileotp', 'mobilenumber']);
                return redirect('thankyou')->with(session()->flash('alert-success', 'You have successfully registered in Hasanah Educational Trust.'));
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
        // dd($request->all()); die;
        $request->validate([
            'academic_year' => 'required',
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
            "academic_year" => "$request->academic_year",
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
        $getdetails = Entrance_exam_process::where('token_no',$tokenno)
                                            ->join('academicyears', 'academicyears.id', '=', 'entrance_exam_processes.academic_year')
                                            ->join('a_classes', 'a_classes.id', '=', 'entrance_exam_processes.class_id')
                                            ->select('entrance_exam_processes.*', 'academicyears.academicYear AS academicyear', 'a_classes.class_name AS className')->first();
        // $classname = A_class::where('id', $getdetails->class_id)->first();
        // dd($getdetails); die;
        return view('student/entrance-exam-preview', $data, compact('getdetails'));
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
            $formfilled->academic_year = $request->academic_year;
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
        $class_name = A_class::where('id', $studendetails->class_id)->first();
                                //    ->join('a_classes', 'a_classes.id', '=', 'entrance_exam_forms.class_id')
                                //    ->select(['entrance_exam_forms.*', 'a_classes.id as className'])
                                //    ->get();
        return view('student/entrance-form-receiept', $data, compact('studendetails', 'class_name'));
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
        $examschedules = Exam_schedule::where('class', '=', $studentdetails->class_id)->where('school_id', '=', $studentdetails->school_id)->first();
        //   dd($examschedules); die;
        // $pdf = PDF::loadView('student/myAdmitCard', compact('studentdetails'));    
        // return $pdf->download($request->exam_type.'-'.$studentdetails['form_id'].'.pdf');
        if($examschedules && $studentdetails){
            $trytodo = true;
            return view('student/myAdmitCard', $data, compact('studentdetails', 'examschedules', 'trytodo'));
        } else{
            $trytodo = false;
            return view('student/myAdmitCard', $data, compact('trytodo'));
        }
    }

    public function getClassNames(Request $request){
        $schoolid = $request->post('school');
        $schooldetails = A_class::where('school_id', $schoolid)->get();
        return $schooldetails;
    }

    public function studentAdmissionForm(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        // $courses = Course::get();
        // $academicyears = Academicyear::get();
        // $batchtimes = Batchtime::get();
        $entrancedata = Entrance_exam_form::where('student_id', '=', $data['LoggedStudentInfo']->student_id)
                                            ->join('schools', 'schools.id', '=', 'entrance_exam_forms.school_id')
                                            ->join('a_classes', 'a_classes.id', '=', 'entrance_exam_forms.class_id')
                                            ->join('academicyears', 'academicyears.id', '=', 'entrance_exam_forms.academic_year')
                                            ->select('entrance_exam_forms.*','schools.id AS schoolid', 'schools.school_name AS schoolname', 'a_classes.id AS classid', 'a_classes.class_name AS classname', 'academicyears.academicYear AS academicYearGet')->first();
        // dd($entrancedata); die;
        $admissionfees = Admission_fee::where('school_id', '=', $entrancedata->school_id)->where('course_id', '=', $entrancedata->class_id)->first();
        return view('student/admission-form', $data, compact('entrancedata', 'admissionfees'));
    }
    public function getBatchTime(Request $request)
    {
        $courseid = $request->post('courseid');
        $courseids = Batchtime::where('courseid', '=', $courseid)->get();
        $batchtiming = '<option selected disabled value="">Select Batch Time</option>';
        foreach ($courseids as $list) {
            $batchtiming .= '<option value="' . $list->id . '">' . date("g:i a", strtotime($list->batchtimefrom)) . ' - ' . date("g:i a", strtotime($list->batchtimeto)) . '</option>';
        }
        echo $batchtiming;
    }
    public function getAdmissionFee(Request $request)
    {
        $courseid = $request->post('courseid');
        $fees = Admission_fee::where('course_id', '=', $courseid)->where('status', '1')->first();
        echo $fees;
    }

    public function studentAdmissionApply(Request $request)
    {
        $request->validate([
            'studentid' => 'required',
            'academic_year' => 'required',
            'school_name' => 'required',
            'course_name' => 'required',
            'fullname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'bloodgroup' => 'required',
            'nationality' => 'required',
            'category' => 'required',
            'aadharnumber' => 'required',
            'mobilenumber' => 'required|min:10|max:10',
            'studentphoto' => 'required',
            'addresslineone' => 'required|max:150',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'guardianname' => 'required',
            'relation' => 'required',
            'guardianaddresslineone' => 'required|max:150',
            'guardiancity' => 'required',
            'guardianstate' => 'required',
            'guardiancountry' => 'required',
            'guardianpincode' => 'required',
            'guardianmobile' => 'required|min:10|max:10',
            'admissionfee' => 'required',
            'tutionfee' => 'required',
        ]);

       //$lastAdmission = Admission::orderBy('id', 'desc')->first();
        $lastRollNumber = Admission::orderBy('id', 'desc')->first();
        $userIDGene = Admission::orderBy('id', 'desc')->first();
        $admission = new Admission;
        // Admission Number Generate Start
        if (isset($lastRollNumber)) {
            // Sum 1 + last id
            $admission->admissionNumber = 'HET-' . ($lastRollNumber->rollNumber + 1) . '-' . date('Y');
        } else {
            $admission->admissionNumber = 'HET-'.date('d') . '11'.'-' . date('Y');
        }
        // Admission Number Generate End

        // Roll Number Generate Start
        if (isset($lastRollNumber)) {
            // Sum 1 + last id
            $rollnumber = $lastRollNumber->rollNumber + 1;
        } else {
            // $rollnumber = date('d') . '10121';
            $rollnumber = date('d') . '11';
        }
        // Roll Number Generate End
        if ($request->hasfile('studentphoto')) {
            $file = $request->file('studentphoto');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'student-' . time() . '.' . $extenstion;
            $file->move(public_path('uploads/student-documents'), $filename);
        }
        
        // $admission->admissionNumber = date('Ymd') . rand(1111, 9999);
        $student = new Student_admission;
        $student->student_id = $request->studentid;
        $student->session = $request->academic_year;
        $student->school_id = $request->schoolid;
        $student->courseID = $request->courseid;
        $student->save();
        
        $admission->student_id = $request->studentid;
        $admission->rollNumber = $rollnumber;
        $admission->bloodGroup = $request->bloodgroup;
        $admission->birthPlace = $request->birthplace;
        $admission->aadharNumber = $request->aadharnumber;
        $admission->studentPhoto = $filename;
        $admission->gurdianName = $request->guardianname;
        $admission->guardianMobile = $request->guardianmobile;
        $admission->guardianAadhar = $request->guardianaadhar;
        $admission->relation = $request->relation;
        $admission->gurdiandob = $request->guardiandob;
        $admission->gurdianeducation = $request->education;
        $admission->gurdianoccupation = $request->occupation;
        $admission->gurdianincome = $request->income;
        $admission->dob = $request->dob;
        $admission->gender = $request->gender;
        $admission->nationality = $request->nationality;
        $admission->category = $request->category;
        $admission->religion = $request->religion;
        $admission->addresslineone = $request->addresslineone;
        $admission->addresslinetwo = $request->addresslinetwo;
        $admission->city = $request->city;
        $admission->state = $request->state;
        $admission->country = $request->country;
        $admission->pincode = $request->pincode;
        $admission->gurdianaddresslineone = $request->guardianaddresslineone;
        $admission->gurdianaddresslinetwo = $request->guardianaddresslinetwo;
        $admission->gurdiancity = $request->guardiancity;
        $admission->gurdianstate = $request->guardianstate;
        $admission->gurdiancountry = $request->guardiancountry;
        $admission->gurdianpincode = $request->guardianpincode;
        // $admission->admissionFee = $request->admissionfee;
        // $admission->tutionFee = $request->tutionfee;
        $admission->joiningDate = now();
        $admission->save();
        $feedetails = Admission_fee::where('course_id', $request->courseid)->first();
        $paymentfee = new Fee;
        $paymentfee->student_id = $request->studentid;
        $paymentfee->rollNumber = $rollnumber;
        $paymentfee->session = $request->academic_year;
        $paymentfee->admissionFee = $feedetails->admission_fee;
        $paymentfee->tutionFee = $feedetails->tution_fee;
        $paymentfee->security_deposit = $feedetails->security_deposit;
        $paymentfee->annual_fee = $feedetails->annual_fee;
        $paymentfee->miscellanous_fee = $feedetails->miscellanous_fee;
        $paymentfee->status = 2;
        // $paymentfee->discount = $request->discount;
        $paymentfee->save();

        if ($student && $admission && $paymentfee) {
            return redirect('student/admission-fee')->with(session()->flash('alert-success', 'Admission form successfully filled. Please! Pay admission fee.'));
            // return redirect('admin/studentreceiving'.'/'.$request->studentid);
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }

    public function studentAdmissionFee(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $feedata = Fee::where('student_id', '=', $data['LoggedStudentInfo']->student_id)->first();
        if ($feedata) {
            $studentdata = Student::where('student_id', '=', $feedata->student_id)->first();
            return view('student/admission-fee', $data, compact('feedata', 'studentdata'));
        }
        return view('student/admission-fee', $data, compact('feedata'));
    }

    public function admissionPaymentPai(Request $request){
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
            
        // dd($response); die;
            $studentid = Student::where('id','=', session('LoggedStudent'))->first();

            $payment_update = Fee::where('student_id', '=', $studentid->student_id)
                                            ->where('status', '=', '2')
                                            ->update([
                                                'receipt_no' => time().$studentid->id,
                                                'payment_mobile' => $response->contact,
                                                'payment_email' => $response->email,
                                                'payment_id' => $request->razorpay_payment_id,
                                                'transaction_id' => time().rand(11,99).date('yd'),
                                                'transaction_date' => now(),
                                                'payment_status' => $response->status,
                                                'payment_card_id' => $response->card_id,
                                                'method' => $response->method,
                                                'wallet' => $response->wallet,
                                                'payment_vpa' => $response->vpa,
                                                'international_payment' => $response->international,
                                                'error_reason' => $response->error_reason,
                                                'status' => 1,
                                            ]);
        }
        //   dd($payment_update); die;
        if ($payment_update) {
            return redirect('student/admission')->with(session()->flash('alert-success', 'Transaction successful.'));
        } else{
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        }
    }

    public function studentAdmissionReceipt(Request $request, $studentid){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $getfeedetails = Fee::where('student_id',$studentid)->first();
        $getdetails = Student::where('student_id', $studentid)->first();
        $getadmissiondetails = Admission::where('student_id', $studentid)->first();
        $getcdetails = Student_admission::where('student_id', $studentid)->first();
        $getcourse = A_class::where('id', $getcdetails->courseID)->first();
        $getsession = Academicyear::where('id', $getcdetails->session)->first();
        // dd($getdetails); die;
        return view('student/admission-receiept', $data, compact('getfeedetails', 'getdetails', 'getadmissiondetails', 'getcourse', 'getsession'));
    }

    public function studentAdmissionPaymentReceipt($studentid){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $getfeedetails = Fee::where('student_id',$studentid)->first();
        $getdetails = Student::where('student_id', $studentid)->first();
        $getadmissiondetails = Admission::where('student_id', $studentid)->first();
        $getcdetails = Student_admission::where('student_id', $studentid)->first();
        $getcourse = A_class::where('id', $getcdetails->courseID)->first();
        $getsession = Academicyear::where('id', $getcdetails->session)->first();
        // dd($getdetails); die;
        return view('student/admission-payment-receipt', $data, compact('getfeedetails', 'getdetails', 'getadmissiondetails', 'getcourse', 'getsession'));
    }

    public function studentAdmission(){
        $data = ['LoggedStudentInfo'=>Student::where('id','=', session('LoggedStudent'))->first()];
        $admissionstatus = Fee::where('student_id', $data['LoggedStudentInfo']->student_id)->first();
        return view('student/admission', $data, compact('admissionstatus'));
    }
    
}