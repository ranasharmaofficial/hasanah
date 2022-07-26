<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\School_admin;
use App\Models\Student;
use App\Models\A_class;
use App\Models\Academicyear;
use App\Models\Admission_fee;
use App\Models\Fee;
use App\Models\Batchtime;
use App\Models\Course;
use App\Models\Employee;
use App\Models\Employee_user;
use App\Models\Entrance_exam_form;
use App\Models\Exam_schedule;
use App\Models\School;
use App\Models\Teacher_category;
use App\Models\Admission;
use App\Models\Student_admission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $schoolCount = School::count();
        $classCount = A_class::count();
        $totalAdmission = Admission::count();
        $totalStudent = Student::count();
        $employeeCount = Employee_user::where('role', '=', '1')->count();
        $teacherCount = Employee_user::where('role', '=', '2')->count();
        return view('schooladmin/home', $data, compact('totalStudent','totalAdmission','schoolCount', 'classCount','employeeCount', 'teacherCount'));
    }
    public function addStudent(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $classes = A_class::get();
        $school = School::get();
        $academicyears = Academicyear::get();
        return view('schooladmin/add-student', $data, compact('classes','school','academicyears'));
    }
    
    public function AddStudetnAdmission(Request $request){
        $request->validate([
            'academic_year' => 'required',
            'school_id' => 'required',
            'class_id' => 'required',
            'fullname' => 'required|max:100',
            'email' => 'required|max:190',
            // 'mobile' => 'required|max:10',
            'mobile' => 'required|max:10|unique:students,mobile',
            
             
        ]);
        // dd($request);
        // die;
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
            "name" => "$request->fullname",
            "email" => "$request->email",
            "mobile" => "$request->mobile",
            "password" => "$request->mobile",
        ]);
        
         $lastStdentId = Student::orderBy('id', 'desc')->first();
        
         $lastRollNumber = Admission::orderBy('id', 'desc')->first();
        $userIDGene = Admission::orderBy('id', 'desc')->first();
        
         
        $student = new Student_admission;
        $student->student_id = $lastStdentId->student_id;
        $student->session = $request->academic_year;
        $student->school_id = $request->school_id;
        $student->courseID = $request->class_id;
        $student->save();
        
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
        $admission->student_id = $lastStdentId->student_id;
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
        $feedetails = Admission_fee::where('course_id', $request->class_id)->first();
        $paymentfee = new Fee;
        $paymentfee->student_id = $lastStdentId->student_id;
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
            return redirect()->back()->with(session()->flash('alert-success', 'Student Added Successfully!.'));
            // return redirect('admin/studentreceiving'.'/'.$request->studentid);
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }
    
    public function studentList(Request $request){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        // $studentlist = Student::paginate(10);
        $sort_search = null;
		$studentlist = Student::join('admissions', 'admissions.student_id', '=', 'students.student_id');
        if ($request->search != null){
            $studentlist = $studentlist->where('students.name', 'like', '%'.$request->search.'%')
							->orWhere('admissions.student_id', "like", "%" . $request->search . "%");
							$sort_search = $request->search;
        }
		$studentlist = $studentlist ->select('students.name as studentName','students.password as studentPass','students.mobile as studentMobile','students.email as studentEmail', 'admissions.*')
                               ->paginate(35);
        return view('schooladmin/studentlist', $data, compact('studentlist','sort_search'));
    }
    public function admissionList(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $admissionlist = Admission::paginate(10);
        return view('schooladmin/admissionlist', $data, compact('admissionlist'));
    }
    public function studentAdmissionDetails($id){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $admissiondetails = Admission::where('id', '=', $id)->first();
        return view('schooladmin/studadmissiondetails', $data, compact('admissiondetails'));
    }

    public function schoolemployeeList(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $employeelists = Employee_user::paginate(10);
        return view('schooladmin/schoolemployeelist', $data, compact('employeelists'));
    }
    public function addClass(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $schools  = School::get(); 
        return view('schooladmin/addclass', $data, compact('schools'));
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
            'schoolid' => 'required',
        ]);
        $classdetails = new A_class;
        $classdetails->class_name = $request->classname;
        $classdetails->amount = $request->classamount;
        $classdetails->school_id = $request->schoolid;
        $classdetails-> save();
        if($classdetails){
            return redirect()->back()->with(session()->flash('alert-success', 'Class Added Successfully!'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 

    }

    public function schoolAdminFormPending(Request $request){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $studentformlists = Entrance_exam_form::where('status', '1')->paginate(20);
        return view('schooladmin/form-pending', $data, compact('studentformlists'));
    }
    public function getAadharCard(Request $request){
        $passreq = $request->post('studentid');
        $data = Entrance_exam_form::where('form_id',$passreq)->pluck('aadhar_card')->first();
        return $data;        
    }
    public function getFatherAadharCard(Request $request){
        $passreq = $request->post('studentid');
        $data = Entrance_exam_form::where('form_id',$passreq)->pluck('father_aadhar_card')->first();
        return $data;        
    }
    public function getMarkSheet(Request $request){
        $passreq = $request->post('studentid');
        $data = Entrance_exam_form::where('form_id',$passreq)->pluck('last_year_exam_marksheet')->first();
        return $data;        
    }

    public function entranceApprove(Request $request){
        $request->validate([
            'form_id' => 'required',
        ]);

        $entranceapprove = Entrance_exam_form::where('form_id', $request->form_id)->update(['status' => 2]);
        if ($entranceapprove) {
            return redirect()->back()->with(session()->flash('alert-success', 'Form successfully accepted.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public function entranceRejected(Request $request){
        $request->validate([
            'form_id' => 'required',
        ]);

        $entrancereject = Entrance_exam_form::where('form_id', $request->form_id)->update(['status' => 3]);
        if ($entrancereject) {
            return redirect()->back()->with(session()->flash('alert-info', 'Form successfully rejected.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public function setSchedule(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $schoollists = School::get();
        return view('schooladmin/setschedule', $data, compact('schoollists'));
    }
    public function getClassNames(Request $request){
        $schoolid = $request->post('school');
        $schooldetails = A_class::where('school_id', $schoolid)->get();
        return $schooldetails;
    }

    public function scheduleList(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $schedulelist = Exam_schedule::paginate(5);
        return view('schooladmin/schedulelist', $data, compact('schedulelist'));
    }

    public function Exam_schedules(Request $request){
        $request->validate([
            'school' => 'required',
            'class' => 'required',
            'examdate' => 'required',
            'examtimefrom' => 'required',
            'examtimeto' => 'required',
            'examcenter' => 'required',
        ]);

        $examschedule = Exam_schedule::create([
            "exam_name" => "Entrance Exam",
            "school_id" => "$request->school",
            "class" => "$request->class",
            "exam_date" => "$request->examdate",
            "exam_time_from" => "$request->examtimefrom",
            "exam_time_to" => "$request->examtimeto",
            "exam_center" => "$request->examcenter",
        ]);
        if ($examschedule) {
            return redirect()->back()->with(session()->flash('alert-info', 'Entrance exam schedule successfully created.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }
    public function addSchool(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        return view('schooladmin/addschool', $data);
    }
    public function uploadSchool(Request $request){
        $request->validate([
            'schoolname' => 'required',
        ]);
        $schooldetails = new School;
        $schooldetails->school_name = $request->schoolname;
        $schooldetails-> save();
        if($schooldetails){
            return redirect()->back()->with(session()->flash('alert-success', 'Class Added Successfully!'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }
    public function schoolList(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $schoollist = School::paginate(5);
        return view('schooladmin/schoollist', $data, compact('schoollist'));
    }
    public static function getClassName($cid){
        $className = A_class::where('id', $cid)->first();
        $class_name = $className->class_name;
        return $class_name;
    }

    public function addAcademicYear()
    {
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        return view('schooladmin/add-academic-year', $data);
    }

    public function uploadAcademicYear(Request $request)
    {
        $request->validate([
            'datefrom' => 'required',
            'dateto' => 'required',
        ]);

        $academicyear = new Academicyear;
        $academicyear->academicYear = $request->datefrom . '-' . $request->dateto;
        $academicyear->save();
        if ($academicyear) {
            return redirect()->back()->with(session()->flash('alert-info', 'Academic Year Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }
    public function addBatch()
    {
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $courses = Course::get();
        return view('schooladmin/add-batch-time', $data, compact('courses'));
    }
    public function uploadBatchTime(Request $request)
    {
        $request->validate([
            'coursename' => 'required|string',
            'batchtimefrom' => 'required',
            'batchtimeto' => 'required',
        ]);

        $batchtime = new Batchtime;
        $batchtime->courseid = $request->coursename;
        $batchtime->batchtimefrom = $request->batchtimefrom;
        $batchtime->batchtimeto = $request->batchtimeto;
        $batchtime->save();

        if ($batchtime) {
            return redirect()->back()->with(session()->flash('alert-info', 'Batchtime Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }

    public function fixAdmissionFee(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $courses = A_class::get();
        $schoollists = School::where('status', '0')->get();
        return view('schooladmin/fix-admission-fee', $data, compact('courses', 'schoollists'));
    }

    public function getSchoolClassName(Request $request){
        $classes = A_class::where('school_id', '=', $request->school_name)->get();
        $class = '<option value="" selected disabled>--Select Class--</option>';
        foreach ($classes as $key => $value) {
            $class.= '<option value="'.$value->id.'">'.$value->class_name.'</option>';
        }
        echo $class;
    }
    public function admissionsFeeList(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        //  $admissionfeelist = Admission_fee::paginate(5);
         
         $admissionfeelist = Admission_fee::join('a_classes', 'admission_fees.course_id', '=', 'a_classes.id')
                                //    ->join('project_categories', 'project_categories.project_cat_id', '=', 'project_requests.category')
                                //    ->join('users', 'users.user_id', '=', 'project_requests.user_id')
                                   ->select(['admission_fees.*', 'a_classes.class_name as className'])
                                   ->paginate(10);

         return view('schooladmin/admission-fee-list', $data, compact('admissionfeelist'));
     }

    public function uploadAdmissionFee(Request $request){
        $request->validate([
            'schoolname' => 'required',
            'coursename' => 'required',
            'admissionfee' => 'required',
            'tutionfee' => 'required',
        ]);

        $admissionfee = new Admission_fee;
        $admissionfee->school_id = $request->schoolname;
        $admissionfee->course_id = $request->coursename;
        $admissionfee->admission_fee = $request->admissionfee;
        $admissionfee->tution_fee = $request->tutionfee;
        $admissionfee->security_deposit = $request->securitydeposit;
        $admissionfee->annual_fee = $request->annualfee;
        $admissionfee->miscellanous_fee = $request->miscellanousfee;
        $admissionfee->save();
        if ($admissionfee) {
            return redirect()->back()->with(session()->flash('alert-info', 'Admission Fee Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }

    public function addEmployee(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        return view('schooladmin/add-employee', $data);
    }

    public function uploadEmployeeData(Request $request){
        $request->validate([
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
            $registrationnumber = 'HET-' . ($employeeid->employeeID + 1) . '22'.'-' . date('Y');
        } else {
            $registrationnumber = 'HET-'.date('d').'-' . date('Y');
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
        if ($request->hasfile('passportimage')) {
            $file = $request->file('passportimage');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'employee-' . time() . '.' . $extenstion;
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
        $teacherregister->role = 1;
        $teacherregister->save();

        if ($teacherdata && $teacherregister) {
            return redirect()->back()->with(session()->flash('alert-success', 'Employee Data Successfully Uploaded'));
        } 
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
    }

    public function teacherCategory()
    {
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        return view('schooladmin/teacher-category', $data);
    }
    public function uploadTeacherCategory(Request $request){
        $request->validate([
            'teacher_category' => 'required|max:150',
        ]);
        $teachercategory = new Teacher_category;
        $teachercategory->category = $request->teacher_category;
        $teachercategory->save();
        if ($teachercategory) {
            return redirect()->back()->with(session()->flash('alert-success', 'Teacher Category Successfully Uploaded'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
    }
    public function addTeacher(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];        
        $teachercategory = Teacher_category::all();
        return view('schooladmin/add-teacher', $data, compact('teachercategory'));
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

    public function entranceResult(){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $classlists = A_class::get();
        $fetchstudentscheck = false;
        return view('schooladmin/entrance-result', $data, compact('classlists', 'fetchstudentscheck'));
    }

    public function entranceExamResult(Request $request){
        $data = ['LoggedSchoolAdminInfo'=>School_admin::where('id','=', session('LoggedSchoolAdmin'))->first()];
        $classlists = A_class::get();
        $fetchstudents = Entrance_exam_form::where('class_id', $request->class)->get();
        // dd($fetchstudents); die;
        $subject = $request->subject;
        $fetchstudentscheck = true;
        return view('schooladmin/entrance-result', $data, compact('classlists', 'fetchstudents', 'subject', 'fetchstudentscheck'));
    }

    public function saveEnteranceResult(Request $request){
        for($i = 0; $i < $request->length; $i++){
            $rows[] = array('student_id' => $request->student_id[$i], 'name' => $request->name[$i], 'subject' => $request->subject[$i], 'total_mark' => $request->total_mark[$i], 'obtain_mark' => $request->obtain_mark[$i], 'ap' => $request->ap[$i]);
        }   

        $entranceresults = DB::table('entrance_results')->insert($rows);
        if ($entranceresults) {
            return redirect('schooladmin/entrance-result')->with(session()->flash('alert-success', 'Results successfully inserted.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again.'));
    }
   
}