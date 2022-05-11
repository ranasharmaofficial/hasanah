<?php

namespace App\Http\Controllers;

use App\Models\Academicyear;
use App\Models\Admission;
use App\Models\Admit_mess;
use App\Models\assign_mess_menu;
use App\Models\Dish;
use App\Models\Employee_user;
use App\Models\Mess_attendance;
use App\Models\Mess_fee;
use App\Models\Mess_stock;
use App\Models\Student;
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
            'day_time' => 'required',
            'day' => 'required',
        ]);
        // dd($request->dish);die;
        $assignmenu = assign_mess_menu::insert([
            'dish' => implode(",",$request->dish),
            'day_time' => $request->day_time,
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
    public function insertMessStock(Request $request){
        $request->validate([
            'item_name' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'amount' => 'required',
            'purchaser_name' => 'required',
            'purchased_date' => 'required',
        ]);

        $insertstock = new Mess_stock;
        $insertstock->item_name = $request->item_name;
        $insertstock->quantity = $request->quantity;
        $insertstock->unit = $request->unit;
        $insertstock->amount = $request->amount;
        $insertstock->purchaser_name = $request->purchaser_name;
        $insertstock->purchased_date = $request->purchased_date;
        $insertstock->total_amount = $request->quantity * $request->amount;
        $insertstock->save();
        if ($insertstock) {
            return redirect()->back()->with(session()->flash('alert-success', 'Stock Added successfully.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }
    public function stockList(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $stocklist = Mess_stock::paginate(5);
        return view('schoolemployee/mess/stock-list', $data, compact('stocklist'));
    }

    public function messFee(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        return view('schoolemployee/mess/mess-fees', $data);
    }
    public function messFeeSearch(Request $request){
        $request->validate([
            'roll_number' => 'required',
        ]);
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $roll_number = $request->get('roll_number');

        $getdetails = Admit_mess::where('roll_number', $roll_number)->orderBy('id', 'desc')->first();
        // dd($getdetails); die;
        $paymentdetails = Mess_fee::where('roll_number', $getdetails->roll_number)->where('session', $getdetails->session)->get();
        $studentdetails = Student::where('student_id', $getdetails->student_id)->first();
        if (!$getdetails) {
            return redirect()->back()->with(session()->flash('alert-danger', 'Please! enter valid roll number or session.'));
        }
        return view('schoolemployee/mess/mess-payment-details', $data, compact('getdetails', 'paymentdetails', 'studentdetails'));
    }
    public function receiveMessPayment(Request $request){
        $request->validate([
            'studentid' => 'required',
            'name' => 'required',
            'admission_number' => 'required',
            'roll_number' => 'required',
            'session' => 'required',
            'mess_fee' => 'required',
            'month' => 'required',
            'amount' => 'required',
            'received_by' => 'required',
        ]);

        $getpaidamount = Admit_mess::where('student_id', $request->studentid)->where('roll_number', $request->roll_number)->first();
        $totalpaid = $getpaidamount->paid_amount + $request->amount;

        $messpayment = Mess_fee::insert([
            'student_id' => $request->studentid,
            'admission_number' => $request->admission_number,
            'roll_number' => $request->roll_number,
            'session' => $request->session,
            'receive_amount' => $request->amount,
            'month' => $request->month,
            'received_by' => $request->received_by,
        ]);

        $messupdate = Admit_mess::where('roll_number', '=', $request->roll_number)->update([
            'paid_amount' => $totalpaid,
        ]);

        if ($messpayment && $messupdate) {
            return redirect()->back()->with(session()->flash('alert-success', 'Mess Payment Successfully Received.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    
    public function messFeeDetails(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $showing = false;
        return view('schoolemployee/mess/mess-fees-details', $data, compact('showing'));
    }

    public function messFeeDetailsGet(Request $request){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $request->validate([
            'roll_number' => 'required',
        ]);

        $getstudentdetails = Mess_fee::where('roll_number', $request->roll_number)->join('students', 'students.student_id', '=', 'mess_fees.student_id')->select('mess_fees.*', 'students.name')->get();
        $showing = true;
        if ($getstudentdetails) {
            return view('schoolemployee/mess/mess-fees-details', $data, compact('getstudentdetails', 'showing'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }


    public function messAttendance(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $showing = false;
        return view('schoolemployee/mess/mess-attendance', $data, compact('showing'));
    }

    public function messAttendanceShow(Request $request){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $request->validate([
            'roll_number' => 'required',
        ]);
        $showing = true;
        $attendanceshow = Admit_mess::where('roll_number', '=', $request->roll_number)->join('students', 'students.student_id', '=', 'admit_messes.student_id')->select('students.*', 'admit_messes.*')->first();
        if($attendanceshow){
            return view('schoolemployee/mess/mess-attendance', $data, compact('attendanceshow', 'showing'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Please! enter correct roll number.'));
    }

    public function makeAttendance(Request $request){
        $request->validate([
            'studentid' => 'required',
            'roll_number' => 'required',
            'present_or_absent' => 'required',
        ]);

        $makeattendance = Mess_attendance::insert([
            'student_id' => $request->studentid,
            'roll_number' => $request->roll_number,
            'present_absent' => $request->present_or_absent,
        ]);

        if ($makeattendance) {
            return redirect()->back()->with(session()->flash('alert-success', 'Data successfully inserted.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public function messStudentList(){
        $data = ['LoggedSchoolEmployeeInfo'=>Employee_user::where('id','=', session('LoggedSchoolEmployee'))->first()];
        $studentlists = Admit_mess::join('students', 'students.student_id', '=', 'admit_messes.student_id')->select('admit_messes.*', 'students.name')->paginate(10);
        return view('schoolemployee/mess/mess-student-list', $data, compact('studentlists'));
    }
}