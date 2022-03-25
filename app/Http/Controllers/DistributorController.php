<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Distributor;
use App\Models\Project;
use App\Models\Project_request;
use App\Models\Company;

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
        return view('distributor/home', $data, compact('distributordata','distributordetails','companydata'));
    }
    public function projectRequest(){
        $data = ['LoggedDistributor'=>User::where('id','=', session('LoggedDistributor'))->first()];
        $distributordata = User::where('user_id', $data['LoggedDistributor']->user_id)->first();
        $distributordetails = Distributor::where('user_id', $data['LoggedDistributor']->user_id)->first();
        //  $projectrequest = Project::where('distributor_id', $distributordetails->distributor_reg)
        //                            ->join('distributors', 'distributors.distributor_reg', '=', 'projects.distributor_id')
        //                            ->select(['projects.*', 'distributors.*'])
        //                            ->paginate(10);
        $projectrequest = Project_request::paginate(10);
                                        // dd($projectrequest);
                                        // die;
        return view('distributor/projectrequest',$data, compact('distributordata','projectrequest'));
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
}