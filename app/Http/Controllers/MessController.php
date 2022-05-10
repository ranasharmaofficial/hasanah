<?php

namespace App\Http\Controllers;

use App\Models\Academicyear;
use App\Models\Admission;
use App\Models\Admit_mess;
use App\Models\assign_mess_menu;
use App\Models\Dish;
use App\Models\Employee_user;
use Illuminate\Http\Request;

class MessController extends Controller
{
    public function messAdmitStudent(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/mess/admit-student', $data);
    }

    public function messViewStudentDetails(Request $request){
        $request->validate([
            'roll_number' => 'required',
        ]);
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $rollnumber = $request->get('roll_number');
        $studentdetails = Admission::where('rollNumber', '=', $rollnumber)->join('students', 'students.student_id', '=', 'admissions.student_id')->select('admissions.*', 'students.*')->first();
        $sessions = Academicyear::get();
        if (!$studentdetails) {
            return redirect()->back()->with(session()->flash('alert-danger', 'Please! enter valid roll number.'));
        }
        return view('schoolemployee/mess/view-student-details', $data, compact('studentdetails', 'sessions'));
    }

    public function admitInMess(Request $request){
        $request->validate([
            'session' => 'required',
            'veg_non_veg' => 'required',
            'mess_fee' => 'required',
            'admissionno' => 'required',
            'studentid' => 'required',
            'rollnumber' => 'required',
        ]);

        $admitmess = Admit_mess::insert([
            'student_id' => $request->studentid,
            'admission_number' => $request->admissionno,
            'roll_number' => $request->rollnumber,
            'session' => $request->session,
            'veg_non_veg' => $request->veg_non_veg,
            'mess_fee' => $request->mess_fee
        ]);

        if ($admitmess) {
            return redirect()->back()->with(session()->flash('alert-success', 'Mess successfully appointed'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try angain later.'));
    }


    public function messCreateManageMessMenu(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/mess/create-manage-mess-menu', $data);
    }

    public function insertDish(Request $request){
        $request->validate([
            'dish' => 'required|unique:dishes,dish',
        ]);

        $dishins = Dish::insert([
            'dish' => $request->dish,
        ]);
        if ($dishins) {
            return redirect()->back()->with(session()->flash('alert-success', 'Dish Successfully Inserted.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try angain later.'));
    }


    public function messAssignMessMenu(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $dishes = Dish::where('status', '1')->get();
        return view('schoolemployee/mess/assign-mess-menu', $data, compact('dishes'));
    }

    public function assignMessMenu(Request $request){
        $request->validate([
            'dish' => 'required',
            'day' => 'required',
        ]);

        $assignmenu = assign_mess_menu::insert([
            'dish' => $request->dish,
            'day' => $request->day,
        ]);
        if ($assignmenu) {
            return redirect()->back()->with(session()->flash('alert-success', 'Dish Successfully Assigned To Day.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try angain later.'));
    }


    public function messAddStock(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/mess/add-stock', $data);
    }
}
