<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Distributor;
use App\Models\Project;
use App\Models\Project_request;
use App\Models\Company;
use App\Models\User_login_history;
use App\Models\Project_category;
use App\Models\User_project;

class DistributorController extends Controller
{
    public function registers(){
        return view('distributor/auth/register');
     }
     public function login(){
         return view('distributor/auth/login');
     }
     public function distributorAuthLogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        
        $ip=$_SERVER['REMOTE_ADDR'];
        $userLoginHistory = User_login_history::create([
            "user_id" => "$request->username",
            "ip_address" => "$ip"
        ]);
        
        $userInfo = User::where('user_id','=',$request->username)->where('role', '3')->where('status', '1')->first();
        if (!$userInfo) {
            return redirect()->route('distributor.login')->with(session()->flash('alert-warning', 'Failed! We do not recognize your username.'));
        } else if ($userInfo->status == '0') {
            return redirect()->route('distributor.login')->with(session()->flash('alert-danger', 'Your account is blocked. Please! contact company for un-block.'));
        } else if ($request->password === $userInfo->password) {
            $request->session()->put('LoggedDistributor', $userInfo->id);
            return redirect('distributor/home');
        } else {
            return redirect()->route('distributor.login')->with(session()->flash('alert-danger', 'Failed! Incorrect Password.'));
        }
        
        
    }    
    public function distributorLogout(){
        if (session()->has('LoggedDistributor')) {
            session()->pull('LoggedDistributor');
            return redirect('distributor/login')->with(session()->flash('alert-success', 'You are successfully Logged out'));
        }
    }
    public function distributorHome(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        $distributordetails = Distributor::where('user_id', $data['LoggedDistributor']->user_id)->first();
        $companydata = Company::where('company_id',$distributordetails->company_id)->first();
        $lastLoginTime = User_login_history::where('user_id', $data['LoggedDistributor']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();;
        return view('distributor/home', $data, compact('distributordata','distributordetails','companydata', 'lastLoginTime'));
    }
    public function projectRequest(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        $distributordetails = Distributor::where('user_id', $data['LoggedDistributor']->user_id)->first();
        $companydata = Company::where('company_id',$distributordetails->company_id)->first();
        $projectrequest = Project_request::where('project_requests.company_id', $distributordetails->company_id)
                                   ->join('project_categories', 'project_categories.project_cat_id', '=', 'project_requests.category')
                                   ->join('users', 'users.user_id', '=', 'project_requests.user_id')
                                   ->select(['project_categories.*', 'project_requests.id as projectRequestId', 'project_requests.beneficiray_name as BeneficiaryName', 'project_requests.beneficiary_mobile as BeneficiaryMobileNumber','project_requests.alt_mobile_number as AltMobile','project_requests.full_address as FullAddress', 'users.*'])
                                   ->paginate(10);
        return view('distributor/projectrequest',$data, compact('distributordata','projectrequest', 'companydata'));
    }
    public function projectRequestDetails(Request $request){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        $distributordetails = Distributor::where('user_id', $data['LoggedDistributor']->user_id)->first();
        $companydata = Company::where('company_id',$distributordetails->company_id)->first();
        $requestId = $request->post('project_req_id');
        $flag = false;
        if ($requestId !== null) {
            $flag = true;
            $project_req_details = Project_request::where('id', $requestId)->first();
            $companyData = Company::where('company_id', $project_req_details->company_id)->first();
            $userData = User::where('user_id', $project_req_details->user_id)->first();
            $projectCatData = Project_category::where('project_cat_id', $project_req_details->category)->first();
            $relatedProject = Project::where('project_cat', $project_req_details->category)
                                    ->join('companies', 'companies.company_id', '=', 'projects.company_id')
                                    ->join('project_categories', 'project_categories.project_cat_id', '=', 'projects.project_cat')
                                    ->select(['companies.*', 'project_categories.*', 'projects.*'])
                                    ->paginate(20);
           return view('distributor/projectrequestdetails', $data, compact('project_req_details', 'flag', 'distributordata', 'companyData', 'userData', 'projectCatData','relatedProject', 'companydata'));
        } else {
            return view('distributor/projectrequestdetails', $data, compact('flag'));
        }
    }
    public function ongoingProject(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        return view('distributor/ongoingproject', $data, compact('distributordata'));
    }
    public function completedProject(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        return view('distributor/completedproject', $data, compact('distributordata'));
    }
    public function userList(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        return view('distributor/userlist',$data, compact('distributordata'));
    }
    public function createProject(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        return view('distributor/createproject',$data, compact('distributordata'));
    }
    public function viewProject(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        return view('distributor/viewProject',$data, compact('distributordata'));
    }
    public function viewProfile(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        $distributordetails = Distributor::where('user_id', '=', $distributordata->user_id)->first();
        return view('distributor/viewprofile',$data, compact('distributordetails', 'distributordata'));
    }
    public function updateProfile(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $userData = User::where('id', '=', session('LoggedContractUser'))->first();
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        return view('distributor/updateprofile',$data, compact('userData', 'distributordata'));
    }
    public function changePassword(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        return view('distributor/changepassword',$data, compact('distributordata'));
    }
    public function getImageDetails(Request $request){
        $imagereqid = $request->post('imagereqid');
        $data = Project_request::where('id',$imagereqid)->pluck('proposal_photo')->first();
        return $data;        
    }
    public function getVideoDetails(Request $request){
        $videoreqid = $request->post('videoreqid');
        $data = Project_request::where('id',$videoreqid)->pluck('proposal_video')->first();
        return $data;        
    }
    public function giveProjectAccess(Request $request){
        $request->validate([
            'project_id' => 'required',
            'user_id' => 'required'
        ]);
        $applyproject = User_project::create([
            "project_id" => "$request->project_id",
            "user_id" => "$request->user_id"
        ]);
        if($applyproject){
            return redirect('distributor/project-request')->with(session()->flash('alert-success', 'Project Given to User Successfully!'));
        }else{
            return redirect('distributor/project-request')->with(session()->flash('alert-danger', 'Something Went Wrong. Please Try Again!'));  
        }
    }
}