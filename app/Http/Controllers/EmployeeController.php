<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Con_employee;
use App\Models\Contractor;
use App\Models\User_login_history;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Project_category;
use App\Models\Upload_comment;
use App\Models\User_project;
use App\Models\User_upload_images;

class EmployeeController extends Controller
{
    public function login(){
        return view('employee/auth/login');
    }

    public function employeeAuthLogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        
        $ip=$_SERVER['REMOTE_ADDR'];
        $userLoginHistory = User_login_history::create([
            "user_id" => "$request->username",
            "ip_address" => "$ip"
        ]);
        
        $userInfo = User::where('user_id','=',$request->username)->where('role', '2')->where('status', '1')->first();
        if (!$userInfo) {
            return redirect()->route('employee.login')->with(session()->flash('alert-warning', 'Failed! We do not recognize your username.'));
        } else if ($userInfo->status == '0') {
            return redirect()->route('employee.login')->with(session()->flash('alert-danger', 'Your account is blocked. Please! contact company for un-block.'));
        } else if ($request->password === $userInfo->password) {
            $request->session()->put('LoggedEmployee', $userInfo->id);
            return redirect('employee/home');
        } else {
            return redirect()->route('employee.login')->with(session()->flash('alert-danger', 'Failed! Incorrect Password.'));
        }
        
        
    }
        
    public function employeeLogout(){
        if (session()->has('LoggedEmployee')) {
            session()->pull('LoggedEmployee');
            return redirect('employee/login')->with(session()->flash('alert-success', 'You are successfully Logged out'));
        }
    }
    
    public function employeeHome(){
        $data = ['LoggedEmployee'=>User::where('id','=', session('LoggedEmployee'))->first()];
        $employeedata = User::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $employeedetails = Con_employee::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $companydata = Company::where('company_id',$employeedetails->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        return view('employee/home', $data, compact('employeedata','employeedetails','companydata', 'lastLoginTime'));
    }

    public function onGoingProject(){
        $data = ['LoggedEmployee'=>User::where('id','=', session('LoggedEmployee'))->first()];
        $employeedata = User::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $employeedetails = Con_employee::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $companydata = Company::where('company_id',$employeedetails->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        }
        $userProjects = User_project::join('projects', 'projects.project_id', '=', 'user_projects.project_id')
                        ->join('companies', 'companies.company_id', '=', 'projects.company_id')
                        ->join('project_categories', 'project_categories.project_cat_id', '=', 'projects.project_cat')
                        ->join('users', 'users.user_id', '=', 'user_projects.user_id')
                        ->select(['project_categories.*', 'companies.*','projects.*','user_projects.*','users.*'])
                        ->where('user_projects.status', '1')
                        ->paginate(10);
        return view('employee/ongoing-project', $data, compact('employeedata','employeedetails','companydata', 'lastLoginTime', 'userProjects'));
    }

    public function viewProjectDetailsOn(Request $request){
        $data = ['LoggedEmployee'=>User::where('id','=', session('LoggedEmployee'))->first()];
        $employeedata = User::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $employeedetails = Con_employee::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $projectid = $request->get('project_id');
        $userid = $request->get('user_id');
        $contractdata = Contractor::where('user_id', $userid)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        // dd($companydata); die;
        $userloginhistory = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->get();
            $historycount = count($userloginhistory);
            if ($historycount == 1) {
                $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->take(1)->first();
            } else{
                $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
            } 
        $flag = false;  
        if ($projectid !== null) {
            $flag = true;  
            $userData = User_project::where('user_id', '=', $data['LoggedEmployee']->user_id)->first();
            $projectData = Project::where('project_id', '=', $projectid)->first();
            $companyData = Company::where('company_id', '=', $projectData->company_id)->first();
            $projectCatData = Project_category::where('project_cat_id', '=', $projectData->project_cat)->first();
            $user_project_images = User_upload_images::where('user_id', '=', $userid)
                                                    ->where('project_id', '=', $projectid)
                                                    ->get();
            return view('employee/viewProjectDetails',$data, compact('employeedata','employeedetails','userData','flag','projectData','companyData','projectCatData','user_project_images','companydata','lastLoginTime'));
        }
        else{
            return view('employee/viewProjectDetails',$data, compact('employeedata','employeedetails','flag','companydata','lastLoginTime'));
        }
    }

    public function projectImageDetails(Request $request, $projectid, $userid, $id){
        $data = ['LoggedEmployee'=>User::where('id','=', session('LoggedEmployee'))->first()];
        $employeedata = User::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $employeedetails = Con_employee::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $contractdata = Contractor::where('user_id', $userid)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        // dd($companydata); die;
        $userloginhistory = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->get();
            $historycount = count($userloginhistory);
            if ($historycount == 1) {
                $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->take(1)->first();
            } else{
                $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
            } 
        $flag = false;  
        if ($projectid !== null) {
            $flag = true;  
            $userData = User_project::where('user_id', '=', $data['LoggedEmployee']->user_id)->first();
            $projectData = Project::where('project_id', '=', $projectid)->first();
            if ($projectData) {
                $companyData = Company::where('company_id', '=', $projectData->company_id)->first();
                $projectCatData = Project_category::where('project_cat_id', '=', $projectData->project_cat)->first();
                $user_project_images = User_upload_images::where('user_id', '=', $userid)
                                                        ->where('project_id', '=', $projectid)
                                                        ->where('id', '=', $id)
                                                        ->first();
                $comments = Upload_comment::where('image_id', $id)->where('project_id', $projectid)->get();
                return view('employee/project-image-details',$data, compact('employeedata','employeedetails','userData','flag','projectData','companyData','projectCatData', 'companydata', 'user_project_images','lastLoginTime', 'comments'));
            }
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public function uploadComment(Request $request){
        $request->validate([
            'projectid' => 'required',
            'contractorid' => 'required',
            'imageid' => 'required',
            'comment' => 'required',
        ]);
        $data = ['LoggedEmployee'=>User::where('id','=', session('LoggedEmployee'))->first()];
        $upload_comment = Upload_comment::insert([
            'employee_id' => $data['LoggedEmployee']->user_id,
            'project_id' => $request->projectid,
            'contractor_id' => $request->contractorid,
            'image_id' => $request->imageid,
            'comment' => $request->comment
        ]);
        if ($upload_comment) {
            return redirect()->back()->with(session()->flash('alert-success', 'Comment Successfully posted.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public function changePassword(){
        $data = ['LoggedEmployee'=>User::where('id','=', session('LoggedEmployee'))->first()];
        $employeedata = User::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $employeedetails = Con_employee::where('user_id', $data['LoggedEmployee']->user_id)->first();
        $companydata = Company::where('company_id',$employeedetails->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedEmployee']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        return view('employee/changepassword', $data, compact('employeedata','employeedetails','companydata', 'lastLoginTime'));
    }

    public function employeeChangePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $data = ['LoggedEmployee'=>User::where('id','=', session('LoggedEmployee'))->first()];
        if ($request->new_password === $request->confirm_password) {
            $oldpass = User::where('user_id', $data['LoggedEmployee']->user_id)->first();
            if ($oldpass->password === $request->old_password) {
                $changepass = User::where('user_id', '=', $data['LoggedEmployee']->user_id)
                            ->update([
                                'password' => $request->new_password,
                            ]);

                if ($changepass) {
                    return redirect()->back()->with(session()->flash('alert-success', 'Congratulations! Your password successfully changed.'));
                }
            }
            return redirect()->back()->with(session()->flash('alert-danger', 'Please! enter correct old password.'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'New Password and Confirm Password not matched.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));        
    }
    
}