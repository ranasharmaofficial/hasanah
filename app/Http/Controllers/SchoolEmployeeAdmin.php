<?php

namespace App\Http\Controllers;

use App\Models\Academicyear;
use App\Models\Admission;
use App\Models\Admit_hostel;
use App\Models\Employee;
use App\Models\Employee_user;
use App\Models\Hostel_fee;
use App\Models\Manage_room;
use App\Models\Student;
use App\Models\Teacher_category;
use Illuminate\Http\Request;

class SchoolEmployeeAdmin extends Controller
{
    public function schoolEmployeeLogin(){
        return view('schoolemployee/auth/login');
    }

    public function schoolEmployeeLoginSection(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        
        $schoolEmployeeAdminInfo = Employee_user::where('user_id','=',$request->username)->where('status', '1')->first();
        if (!$schoolEmployeeAdminInfo) {
            return redirect()->route('schoolemployee.login')->with(session()->flash('alert-warning', 'Failed! We do not recognize your username.'));
        } else if ($schoolEmployeeAdminInfo->status == '0') {
            return redirect()->route('schoolemployee.login')->with(session()->flash('alert-danger', 'Your account is blocked.'));
        } else if ($request->password === $schoolEmployeeAdminInfo->password) {
            $request->session()->put('LoggedSchoolEmployee', $schoolEmployeeAdminInfo->id);
            return redirect('schoolemployee/home');
        } else {
            return redirect()->route('schoolemployee.login')->with(session()->flash('alert-danger', 'Failed! Incorrect Password.'));
        }
    }
    public function schoolEmployeeLogout(){
        if (session()->has('LoggedSchoolEmployee')) {
            session()->pull('LoggedSchoolEmployee');
            return redirect('schoolemployee/login')->with(session()->flash('alert-success', 'You are successfully Logged out'));
        }
    }
    public function schoolEmployeeHome(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];        
        return view('schoolemployee/home', $data);
    }

    public function studentView(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()]; 
        $studentlists = Student::paginate(10);
        return view('schoolemployee/student-view', $data, compact('studentlists'));
    }

    public function addTeacher(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $teachercategory = Teacher_category::all(); 
        return view('schoolemployee/add-teacher', $data, compact('teachercategory'));
    }

    public function uploadTeacherData(Request $request){
        $request->validate([
            'teachercategory' => 'required',
            'joining_date' => 'required',
            'qualification' => 'required|max:150',
            'experience' => 'required|max:10',
            'fullname' => 'required',
            'dob' => 'required',
            'gender' => 'required|string',
            'aadharnumber' => 'required',
            'panno' => 'required',
            'mobileno' => 'required',
            'email' => 'required|email|max:150',
            'passportimage' => 'required|max:500|image|mimes:jpg,jpeg,png',
            'addressone' => 'required|max:150',
            'city' => 'required|max:90',
            'state' => 'required|max:90',
            'country' => 'required|max:90',
            'pincode' => 'required|min:6|max:10',
            'currentaddressone' => 'required|max:150',
            'currentcity' => 'required|max:90',
            'currentstate' => 'required|max:90',
            'currentcountry' => 'required|max:90',
            'currentpincode' => 'required|min:6|max:10'
        ]);

        // $lastregistrationNumber = Employee::orderBy('id', 'desc')->first();
        $employeeid = Employee::orderBy('id', 'desc')->first();
        $teacherIDGene = Employee::orderBy('id', 'desc')->first();
        $teacherdata = new Employee;
        // Registration Number Generate Start
        if (isset($employeeid)) {
            // Sum 1 + last id
            $registrationnumber = 'HET-' . ($employeeid->employeeID + 1) . '-' . date('Y');
        } else {
            $registrationnumber = 'HET-'.date('d') . '22'.'-'. date('Y');
        }
        // Registration Number Generate End

        // Employee ID Generate Start
        if (isset($employeeid)) {
            // Sum 1 + last id
            $employeeidgen = $employeeid->employeeID + 1;
        } else {
            // $employeeidgen = date('d') . '22101';
            $employeeidgen = date('d') . '22';
        }
        // Employee ID Generate End

        // Teacher ID Generate Start
        if (isset($teacherIDGene)) {
            // Sum 1 + last id
            $teacherid = $teacherIDGene->user_id + 1;
        } else {
            // $teacherid = date('md') . '22101';
            $teacherid = date('d') . '02';
        }
        // Teacher ID Generate End
        
        $teacherdata->user_id = $teacherid;
        $teacherdata->employeeID = $employeeidgen;
        $teacherdata->registrationNumber = $registrationnumber;
        $teacherdata->employeeName = $request->fullname;
        $teacherdata->dob = $request->dob;
        $teacherdata->gender = $request->gender;
        $teacherdata->aadharNumber = $request->aadharnumber;
        $teacherdata->panNumber = $request->panno;
        $teacherdata->qualification = $request->qualification;
        $teacherdata->experience = $request->experience;
        $teacherdata->addressOne = $request->addressone;
        $teacherdata->addressTwo = $request->addresstwo;
        $teacherdata->city = $request->city;
        $teacherdata->state = $request->state;
        $teacherdata->country = $request->country;
        $teacherdata->pinCode = $request->pincode;
        $teacherdata->presentAddressOne = $request->currentaddressone;
        $teacherdata->presentAddressTwo = $request->currentaddresstwo;
        $teacherdata->presentCity = $request->currentcity;
        $teacherdata->presentState = $request->currentstate;
        $teacherdata->presentCountry = $request->currentcountry;
        $teacherdata->presentPinCode = $request->currentpincode;
        $teacherdata->altMobile = $request->altmobile;
        $teacherdata->teacherCategory = $request->teachercategory;
        if ($request->hasfile('passportimage')) {
            $file = $request->file('passportimage');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'teacher-' . time() . '.' . $extenstion;
            $file->move(public_path('uploads/employees'), $filename);
        }
        $teacherdata->passportPhoto = $filename;
        $teacherdata->joiningDate = $request->joining_date;

        $teacherdata->save();

        $teacherregister = new Employee_user;
        $teacherregister->user_id = $teacherid;
        $teacherregister->password = $request->mobileno;
        $teacherregister->name = $request->fullname;
        $teacherregister->email = $request->email;
        $teacherregister->mobile = $request->mobileno;
        $teacherregister->role = 2;
        $teacherregister->save();

        if ($teacherdata && $teacherregister) {
            return redirect()->back()->with(session()->flash('alert-success', 'Teacher Data Successfully Uploaded'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        
    }

    public function teacherList(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()]; 
        $employeelists = Employee_user::paginate(10);
        return view('schoolemployee/teacher-list', $data, compact('employeelists'));
    }

    public function viewProfile(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $employeedetails = Employee::where('user_id', '=', $data['LoggedSchoolEmployeeInfo']->user_id)->first();
        return view('schoolemployee/view-profile', $data, compact('employeedetails'));
    }

    public function manageRoom(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/manage-room', $data);
    }

    public function manageRoomBed(Request $request){
        $request->validate([
            'roomno' => 'required',
            'totalbed' => 'required',
        ]);

        $manageroom = new Manage_room;
        $manageroom->room_no = $request->roomno;
        $manageroom->total_bed = $request->totalbed;
        $manageroom->save();
        if ($manageroom) {
            return redirect()->back()->with(session()->flash('alert-success', 'Room data successfully uploaded.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public function admitStudent(){        
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/admit-student', $data);
    }

    public function viewStudentDetails(Request $request){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $admissionno = $request->get('admissionno');
        $studentdetails = Admission::where('admissionNumber', '=', $admissionno)->join('students', 'students.student_id', '=', 'admissions.student_id')->select('admissions.*', 'students.*')->first();
        $rooms = Manage_room::where('status', '1')->get();
        $sessions = Academicyear::get();
        if (!$studentdetails) {
            return redirect()->back()->with(session()->flash('alert-danger', 'Please! enter valid admission number.'));
        }
        return view('schoolemployee/view-student-details', $data, compact('studentdetails', 'rooms', 'sessions'));
    }

    public function admitInHostel(Request $request){
        $request->validate([
            'room_no' => 'required',
            'bed_no' => 'required',
            'annual_hostel_fee' => 'required',
        ]);
        $allottenoget = Admit_hostel::orderBy('id', 'desc')->first();
        if ($allottenoget) {
            $allote_no = $allottenoget->allotte_no + 1;
        } else {
            $allote_no = time();
        }
        
        $admithostel = new Admit_hostel;
        $admithostel->allotte_no = $allote_no;
        $admithostel->student_id = $request->studentid;
        $admithostel->admission_number = $request->admissionno;
        $admithostel->session = $request->session;
        $admithostel->room_id = $request->room_no;
        $admithostel->bed_no = $request->bed_no;
        $admithostel->annual_hostel_fee = $request->annual_hostel_fee;
        $admithostel->paid_amount = 0;
        $admithostel->save();
        if ($admithostel) {
            return redirect()->back()->with(session()->flash('alert-success', 'Hostel successfully appointed'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try angain later.'));
    }

    public function receiveHostelFee(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $sessions = Academicyear::get();
        return view('schoolemployee/receive-hostel-fee', $data, compact('sessions'));
    }

    public function getPaymentDetails(Request $request){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $admissionno = $request->get('admission_no');
        $session = $request->get('session');

        $getdetails = Admit_hostel::where('admission_number', $admissionno)->where('session', $session)->orderBy('id', 'desc')->first();
        // dd($getdetails); die;
        $paymentdetails = Hostel_fee::where('admission_number', $getdetails->admission_number)->where('session', $getdetails->session)->get();
        $studentdetails = Student::where('student_id', $getdetails->student_id)->first();
        if (!$getdetails) {
            return redirect()->back()->with(session()->flash('alert-danger', 'Please! enter valid admission number or session.'));
        }
        return view('schoolemployee/payment-details', $data, compact('getdetails', 'paymentdetails', 'studentdetails'));
    }

    public function receiveHostelPayment(Request $request){
        // dd($request->all()); die;
        $request->validate([
            'studentid' => 'required',
            'admission_number' => 'required',
            'session' => 'required',
            'hostel_fee' => 'required',
            'paid_amount' => 'required',
            'month' => 'required',
            'amount' => 'required',
        ]);

        $getpaidamount = Admit_hostel::where('student_id', $request->studentid)->where('session', $request->session)->first();
        $totalpaid = $getpaidamount->paid_amount + $request->amount;

        $receiveamount = new Hostel_fee;
        $receiveamount->student_id = $request->studentid;
        $receiveamount->admission_number = $request->admission_number;
        $receiveamount->session = $request->session;
        $receiveamount->receive_amount = $request->amount;
        $receiveamount->month = $request->month;
        $receiveamount->save();

        $updatehostelfee = Admit_hostel::where('student_id', $request->studentid)
                                        ->where('session', $request->session)
                                        ->update([
                                            'paid_amount' => $totalpaid,
                                        ]);
        if ($receiveamount && $updatehostelfee) {
            return redirect()->back()->with(session()->flash('alert-success', 'Hostel fee successfully received.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }
}
