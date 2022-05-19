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
use App\Models\Notice;
use App\Models\Gallery;
use App\Models\Event;
use App\Models\Slider;
use App\Models\Social_link;
use App\Models\Contact_detail;
use App\Models\Course;
use App\Models\Logo;
use App\Models\Teacher_category;
use App\Models\User;
use App\Models\Mess_stock;
use App\Models\Contact;
use App\Models\A_class;
use App\Models\School;
use App\Models\Admission_fee;
use App\Models\Exam_schedule;
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

    public function addCourse(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/addcourse', $data);
    }
    public function courseList(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $courselists = Course::paginate(10);
        return view('schoolemployee/courselist', $data, compact('courselists'));
    }
    public function addEvent(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/addevent', $data);
    }
    public function eventList()
    {
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $eventlists = Event::paginate(10);
        return view('schoolemployee/eventlist', $data, compact('eventlists'));
    }
    public function deleteEvent(Request $request){
        $request->validate([
            'eventid' => 'required',
        ]);
        $eventdelete = Event::where('eventID',$request->eventid)->delete();
        if ($eventdelete) {
            return redirect()->back()->with(session()->flash('alert-success', 'Event Successfully Deleted'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }
    public function addNotice(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/addnotice', $data);
    }
    public function noticeList(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $noticelists = Notice::paginate(10);
        return view('schoolemployee/noticelist', $data, compact('noticelists'));
    }
    public function deleteNotice(Request $request){
        $request->validate([
            'noticeid' => 'required',
        ]);
        $noticedelete = Notice::where('noticeID',$request->noticeid)->delete();
        if ($noticedelete) {
            return redirect()->back()->with(session()->flash('alert-success', 'Notice Successfully Deleted'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }
    public function enquiryList(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $enquirylists = Contact::paginate(10);
        return view('schoolemployee/enquirylist', $data, compact('enquirylists'));
    }
    public function emailsubscriptionList(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/emailsubscribelist', $data);
    }
    public function addGallery(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/addgallery', $data);
    }
    public function uploadGalleryImage(Request $request)
    {
        $request->validate([
            'galleryTitle' => 'required',
            'galleryImage' => 'required',
            'galleryImage.*' => 'image|mimes:jpg,jpeg,png',
        ]);

        // $addgalleryimage = new Gallery;
        $files = array();
        if($request->hasfile('galleryImage')){
            foreach($request->file('galleryImage') as $file){
                $extenstion = $file->getClientOriginalExtension();
                $filename = 'gallery-image-' . time() . rand(100,9999) . '.' . $extenstion;
                $file->move(public_path('uploads/gallery'), $filename);
                
                // $name = time().rand(1,100).'.'.$file->extension();
                // $file->move(public_path('files'), $name);  
                $files[] = $filename;  
            }
         }
        // if ($request->hasfile('galleryImage')) {
        //     foreach($request->file('galleryImage') as $key => $file)
        //     {
        //         $extenstion = $file->getClientOriginalExtension();
        //         // $name = $file->getClientOriginalName();
        //         $filename = 'gallery-image-' . time() . '.' . $extenstion;
        //         $file->move(public_path('uploads/gallery'), $filename);
        //         $fileset[] = $filename; 
        //     }

            // $file = $request->file('galleryImage');
            // $extenstion = $file->getClientOriginalExtension();
            // $filename = 'gallery-image-' . time() . '.' . $extenstion;
            // $file->move(public_path('uploads/gallery'), $filename);
        // }
        $addgalleryimage = Gallery::insert([
            'galleryTitle' =>$request->galleryTitle,
            'galleryImage' =>  json_encode($files),
        ]);
        // $addgalleryimage->galleryTitle = $request->galleryTitle;
        // $addgalleryimage->galleryImage = json_encode($files);
        // $addgalleryimage->save();
        if ($addgalleryimage) {
            return redirect()->back()->with(session()->flash('alert-info', 'Gallery Image Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }
    public function galleryList()
    {
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $gallerylists = Gallery::paginate(10);
        return view('schoolemployee/gallerylist', $data, compact('gallerylists'));
    }
    public function deleteGalleryImage(Request $request){
        $request->validate([
            'galleryid' => 'required',
        ]);
        $gallerydelete = Gallery::where('id',$request->galleryid)->delete();
        if ($gallerydelete) {
            return redirect()->back()->with(session()->flash('alert-success', 'Gallery Image Successfully Deleted'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }
    public function addSlider(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/addSlider', $data);
    }
    public function sliderList(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/sliderlist', $data);
    }
    public function updateLogo(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/updatelogo', $data);
    }
    
    public function socialMediaLinks(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $sociallink = Social_link::first();
        return view('schoolemployee/updatesocialmedia', $data, compact('sociallink'));
    }
    public function uploadHeaderLogo(Request $request){
        $request->validate([
            'headerlogo' =>'required|image|mimes:jpeg,png,jpg,svg|max:300'
        ]);
        $headerlogo = new Logo();
        if ($request->hasfile('headerlogo')) {
            $file = $request->file('headerlogo');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'header-logo-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/logos'), $filename);
        }
        $headerlogo->logo_id = rand(111111, 999999);        
        $headerlogo->logo = $filename;        
        $headerlogo->logoType = 1;   
        $headerlogo->save();   
        if ($headerlogo) {
            return redirect()->back()->with(session()->flash('alert-success', 'Header Logo Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }
    public function uploadFooterLogo(Request $request){
        $request->validate([
            'footerlogo' =>'required|image|mimes:jpeg,png,jpg,svg|max:300'
        ]);
        $footerlogo = new Logo();
        if ($request->hasfile('footerlogo')) {
            $file = $request->file('footerlogo');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'footer-logo-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/logos'), $filename);
        }
        $footerlogo->logo_id = rand(111111, 999999);        
        $footerlogo->logo = $filename;        
        $footerlogo->logoType = 2;   
        $footerlogo->save();   
        if ($footerlogo) {
            return redirect()->back()->with(session()->flash('alert-success', 'Footer Logo Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }
    public function uploadFaviconLogo(Request $request){
        $request->validate([
            'faviconlogo' =>'required|image|mimes:jpeg,png,jpg,svg|max:300'
        ]);
        $faviconlogo = new Logo();
        if ($request->hasfile('faviconlogo')) {
            $file = $request->file('faviconlogo');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'favicon-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/logos'), $filename);
        }
        $faviconlogo->logo_id = rand(111111, 999999);        
        $faviconlogo->logo = $filename;        
        $faviconlogo->logoType = 3;   
        $faviconlogo->save();   
        if ($faviconlogo) {
            return redirect()->back()->with(session()->flash('alert-success', 'Favicon Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }
    public function uploadContactDetails(Request $request){
        $request->validate([
            'mobile' => 'required|max:15',
            'altmobile' => 'max:15',
            'email' => 'required|email|max:150',
            'address' => 'required|max:150'
        ]);
        $altmobile = $request->altmobile;
        $uploadcontact = new Contact_detail;
        $uploadcontact->contact_id = rand(111111,999999);
        $uploadcontact->mobile = $request->mobile;
        if ($altmobile !== '') {
            $uploadcontact->altMobile = $altmobile;
        }
        $uploadcontact->email = $request->email;
        $uploadcontact->address = $request->address;
        $uploadcontact->save();
        if ($uploadcontact) {
            return redirect()->back()->with(session()->flash('alert-success', 'Contact Details Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }

    public function updateContactDetailsU(Request $request){
        $request->validate([
            'mobile' => 'required|max:15',
            'altmobile' => 'max:15',
            'email' => 'required|email|max:150',
            'address' => 'required|max:150',
            'contactid' => 'required'
        ]);
        $altmobile = $request->altmobile;
        if ($altmobile !== '') {
            $updatecontactdetails = Contact_detail::where('contact_id', $request->contactid)
                                      ->update([
                                        'contact_id' => rand(111111,999999),
                                        'mobile' => $request->mobile,
                                        'altMobile' => $request->altmobile,
                                        'email' => $request->email,
                                        'address' => $request->address
                                        ]);
        } else {
            $updatecontactdetails = Contact_detail::where('contact_id', $request->contactid)
                                      ->update([
                                        'contact_id' => rand(111111,999999),
                                        'mobile' => $request->mobile,
                                        'email' => $request->email,
                                        'address' => $request->address
                                        ]);
        }
        
        if ($updatecontactdetails) {
            return redirect()->back()->with(session()->flash('alert-info', 'Contact Details Successfully Updated'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }

    public function uploadCourseDetails(Request $request){
        $request->validate([
            'coursename' => 'required',
            'coursetitle' => 'required',
            'coursedetails' => 'required',
            'courseimage' => 'required|max:500'
        ]);

        if ($request->hasfile('courseimage')) {
            $file = $request->file('courseimage');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'course-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/courses'), $filename);
        }

        $coursepost = Course::create([
            "course_id" => rand(111111,999999),
            "courseName" => "$request->coursename",
            "courseTitle" => "$request->coursetitle",
            "courseDetails" => "$request->coursedetails",
            "slug" => "$request->coursetitle",
            "courseImage" => "$filename"
        ]);

        if ($coursepost) {
            return redirect()->back()->with(session()->flash('alert-success', 'Course Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }

    public function getcoursedetails(Request $request){
        $courseid = $request->post('courseid');
        $data = Course::where('course_id',$courseid)->pluck('courseDetails')->first();
        return $data;        
    }

    public function uploadSocialLinks(Request $request){
        $request->validate([
            'facebook' => 'required|max:150',
            'instagram' => 'required|max:150',
            'twitter' => 'max:150',
            'linkedin' => 'max:150'
        ]);

        $sociallinks = new Social_link;
        $sociallinks->facebook = $request->facebook;
        $sociallinks->instagram = $request->instagram;
        $sociallinks->linkedin = $request->linkedin;
        $sociallinks->twitter = $request->twitter;
        $sociallinks->save();
        if ($sociallinks) {
            return redirect()->back()->with(session()->flash('alert-success', 'Social Links Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }

    public function updateSocialLinks(Request $request){
        $request->validate([
            'facebook' => 'required|max:150',
            'instagram' => 'required|max:150',
            'twitter' => 'max:150',
            'linkedin' => 'max:150',
            'socialid' => 'required'
        ]);

        $updatesociallink = Social_link::where('id', $request->socialid)
                                    ->update([
                                    'facebook' => $request->facebook,
                                    'instagram' => $request->instagram,
                                    'linkedin' => $request->linkedin,
                                    'twitter' => $request->twitter
                                    ]);

        if ($updatesociallink) {
            return redirect()->back()->with(session()->flash('alert-info', 'Social Links Successfully Updated'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }
    public function uploadSlider(Request $request){
        $request->validate([
            'title' => 'required|max:100',
            'slider' => 'required|max:500|image|mimes:jpg,jpeg,png,svg'
        ]);

        $sliderupload = new Slider;
        $sliderupload->title = $request->title;
        if ($request->hasfile('slider')) {
            $file = $request->file('slider');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'slider-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/sliders'), $filename);
            $sliderupload->sliderImage = $filename;
        }
        $sliderupload->save();
        if ($sliderupload) {
            return redirect()->back()->with(session()->flash('alert-success', 'Slider Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }

    public function updateSlider(Request $request){
        $request->validate([
            'title' => 'required|max:100',
            'slider' => 'required|max:500',
            'sliderid' => 'required'
        ]);
        if ($request->hasfile('slider')) {
            $file = $request->file('slider');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'slider-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/sliders'), $filename);
        }
        $updateslider = Slider::where('id', $request->sliderid)
                                    ->update([
                                    'title' => $request->title,
                                    'sliderImage' => $filename
                                    ]);

        if ($updateslider) {
            return redirect()->back()->with(session()->flash('alert-info', 'Slider Successfully Updated'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }

    public function uploadEvent(Request $request){
        $request->validate([
            'event_name' => 'required',
            'event_title' => 'required',
            'details' => 'required',
            'event_image' => 'required|max:300|image|mimes:jpg,jpeg,png,svg'
        ]);

        $addevent = new Event;
        if ($request->hasfile('event_image')) {
            $file = $request->file('event_image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'event-image-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/events'), $filename);
        }
        $addevent->eventID = time().date('Ym');
        $addevent->eventName = $request->event_name;
        $addevent->eventTitle = $request->event_title;
        $addevent->eventDetails = $request->details;
        $addevent->slug = $request->event_title;
        $addevent->eventImage = $filename;
        $addevent->save();
        if ($addevent) {
            return redirect()->back()->with(session()->flash('alert-info', 'Events Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }

    // public function uploadGalleryImage(Request $request){
    //     $request->validate([
    //         'galleryTitle' => 'required',
    //         'galleryImage' => 'required|max:300|image|mimes:jpg,jpeg,png,svg'
    //     ]);

    //     $addgalleryimage = new Gallery;
    //     if ($request->hasfile('galleryImage')) {
    //         $file = $request->file('galleryImage');
    //         $extenstion = $file->getClientOriginalExtension();
    //         $filename = 'gallery-image-'.time().'.'.$extenstion;
    //         $file->move(public_path('uploads/gallery'), $filename);
    //     }
    //     $addgalleryimage->galleryTitle = $request->galleryTitle;
    //     $addgalleryimage->galleryImage = $filename;
    //     $addgalleryimage->save();
    //     if ($addgalleryimage) {
    //         return redirect()->back()->with(session()->flash('alert-info', 'Gallery Image Successfully Uploaded'));
    //     } else {
    //         return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
    //     } 
    // }

    public function uploadNotice(Request $request){
        $request->validate([
            'notice_name' => 'required',
            'notice_title' => 'required',
            'details' => 'required',
            'noticeImage' => 'required|max:300|image|mimes:jpg,jpeg,png,svg'
        ]);

        $addnotice = new Notice;
        if ($request->hasfile('noticeImage')) {
            $file = $request->file('noticeImage');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'notice-image-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/notices'), $filename);
        }
        $addnotice->noticeID = time().date('Ym');
        $addnotice->noticeName = $request->notice_name;
        $addnotice->noticeTitle = $request->notice_title;
        $addnotice->noticeDetails = $request->details;
        $addnotice->slug = $request->notice_title;
        $addnotice->noticeImage = $filename;
        $addnotice->save();
        if ($addnotice) {
            return redirect()->back()->with(session()->flash('alert-info', 'Notice Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }

    public function addClass(){
       $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $schools  = School::get(); 
        return view('schoolemployee/addclass', $data, compact('schools'));
    }
    public function classList(){
       $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $classlist = A_class::paginate(10);
        return view('schoolemployee/classlist',$data, compact('classlist'));
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
    public function setSchedule(){
       $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $classlist = A_class::get();
        return view('schoolemployee/setschedule', $data, compact('classlist'));
    }

    public function scheduleList(){
       $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $schedulelist = Exam_schedule::paginate(5);
        return view('schoolemployee/schedulelist', $data, compact('schedulelist'));
    }

    public function Exam_schedules(Request $request){
        $request->validate([
            'class' => 'required',
            'examdate' => 'required',
            'examtimefrom' => 'required',
            'examtimeto' => 'required',
            'examcenter' => 'required',
        ]);

        $examschedule = Exam_schedule::create([
            "exam_name" => "Entrance Exam",
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
       $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/addschool', $data);
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
       $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $schoollist = School::paginate(5);
        return view('schoolemployee/schoollist', $data, compact('schoollist'));
    }
    public function addAcademicYear()
    {
       $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/add-academic-year', $data);
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
    public function fixAdmissionFee(){
       $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $courses = A_class::get();
        return view('schoolemployee/fix-admission-fee', $data, compact('courses'));
    }
    public function admissionFeeList(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        //  $admissionfeelist = Admission_fee::paginate(5);
         
         $admissionfeelist = Admission_fee::join('a_classes', 'admission_fees.course_id', '=', 'a_classes.id')
                                //    ->join('project_categories', 'project_categories.project_cat_id', '=', 'project_requests.category')
                                //    ->join('users', 'users.user_id', '=', 'project_requests.user_id')
                                   ->select(['admission_fees.*', 'a_classes.class_name as className'])
                                   ->paginate(10);

         return view('schoolemployee/admission-fee-list', $data, compact('admissionfeelist'));
     }

    public function uploadAdmissionFee(Request $request){
        $request->validate([
            'coursename' => 'required|string',
            'admissionfee' => 'required',
            'tutionfee' => 'required',
        ]);

        $admissionfee = new Admission_fee;
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

}