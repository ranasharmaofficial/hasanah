<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Logo;
use App\Models\Contact_detail;
use App\Models\Course;
use App\Models\Social_link;
use App\Models\Slider;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Notice;
// use Image;

class AdminController extends Controller
{
    public function login(){
        return view('admin/auth/login');
    }
    public function adminAuthLogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required|min:6|max:20'
        ]);

        $adminInfo = User::where('user_id','=',$request->username)->first();
        if (!$adminInfo) {
            return redirect()->route('admin.auth.login')->with(session()->flash('alert-warning', 'Failed! We do not recognize your username.'));
        } else if ($request->password === $adminInfo->password) {
            $request->session()->put('LoggedUser', $adminInfo->id);
            return redirect('admin/home');
        } else {
            return redirect()->route('admin.auth.login')->with(session()->flash('alert-danger', 'Failed! Incorrect Password.'));
        }
    }    
    public function logout(){
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('admin/auth/login');
        }
    }
    public function adminHome(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/home', $data);
    }
    public function updateContactDetails(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        $contact = Contact_detail::first();
        return view('admin/updatecontactdetails', $data, compact('contact'));
    }

    public function addStudent(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/addstudent', $data);
    }
    public function viewStudent(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/viewstudent', $data);
    }
    public function userList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/userlist', $data);
    }

    public function createProject(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/createproject',$data);
    }
    public function createProjectCategory(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/createprojectcategory',$data);
    }
    public function addDistributor(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/adddistributor',$data);
    }
    public function distributorList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/distributorlist',$data);
    }

    public function addEmployee(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/addemployee',$data);
    }
    public function employeeList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/employeelist',$data);
    }
    public function viewEmployee(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/viewemployee',$data);
    }
    public function updateEmployee(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/updateemployee',$data);
    }
    
    public function createCompany(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/createcompany',$data);
    }
    public function companyList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/companylist',$data);
    }
    public function viewCompany(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/viewcompany',$data);
    }
    public function updateCompany(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/updatecompany',$data);
    }
    public function updateStudent(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/updatestudent',$data);
    }
    public function viewDistributor(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/viewdistributor',$data);
    }
    public function updateDistributor(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/updadistributor',$data);
    }
    
    public function addCourse(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/addcourse', $data);
    }
    public function courseList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        $courselists = Course::paginate(10);
        return view('admin/courselist', $data, compact('courselists'));
    }
    public function addEvent(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/addevent', $data);
    }
    public function eventList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/eventlist', $data);
    }
    public function addNotice(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/addnotice', $data);
    }
    public function noticeList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/noticelist', $data);
    }
    public function enquiryList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/enquirylist', $data);
    }
    public function emailsubscriptionList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/emailsubscribelist', $data);
    }
    public function addGallery(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/addgallery', $data);
    }
    public function galleryList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/gallerylist', $data);
    }
    public function addSlider(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/addSlider', $data);
    }
    public function sliderList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/sliderlist', $data);
    }
    public function updateLogo(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin/updatelogo', $data);
    }
    
    public function socialMediaLinks(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        $sociallink = Social_link::first();
        return view('admin/updatesocialmedia', $data, compact('sociallink'));
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

    public function uploadGalleryImage(Request $request){
        $request->validate([
            'galleryTitle' => 'required',
            'galleryImage' => 'required|max:300|image|mimes:jpg,jpeg,png,svg'
        ]);

        $addgalleryimage = new Gallery;
        if ($request->hasfile('galleryImage')) {
            $file = $request->file('galleryImage');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'gallery-image-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/gallery'), $filename);
        }
        $addgalleryimage->galleryTitle = $request->galleryTitle;
        $addgalleryimage->galleryImage = $filename;
        $addgalleryimage->save();
        if ($addgalleryimage) {
            return redirect()->back()->with(session()->flash('alert-info', 'Gallery Image Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
        } 
    }

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
}