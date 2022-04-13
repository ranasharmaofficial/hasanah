<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Event;
use App\Models\Contact;
use App\Models\Gallery;

class ExternalController extends Controller
{
    public function register(){
        return view('register');
    }
    public function verification(){
        return view('verification');
    }
    public function login(){
        return view('login');
    }
    public function thankyou(){
        return view('thankyou');
    }
    public function course(){
        $courses = Course::get();
        return view('course', compact('courses'));
    }
    public function courseSingle($courseslug){
        $coursedetails = Course::where('slug',$courseslug)->get();
        return view('coursesingle', compact('coursedetails'));
    }
    public function index(){
        $courses = Course::get();
        $events = Event::limit(1)->get();
        return view('index', compact('courses', 'events'));
    }
    public function events(){
        $events = Event::limit(1)->get();
        return view('events',compact('events'));
    }
    public function gallery(){
        $galleries = Gallery::get();
        return view('gallery',compact('galleries'));
    }

    public function enquiryContact(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'mobile' => 'required|string',
            'message' => 'required'
        ]);

        $contactpost = new Contact;
        $contactpost->name = $request->name;
        $contactpost->email = $request->email;
        $contactpost->mobile = $request->mobile;
        $contactpost->message = $request->message;
        $contactpost->save();
        if ($contactpost) {
            return redirect()->back()->with(session()->flash('alert-success', 'We have recived your query. Please! wait for response.'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }
}