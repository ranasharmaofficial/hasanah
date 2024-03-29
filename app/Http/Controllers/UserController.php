<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\MailController;
use JD\Cloudder\Facades\Cloudder;
use App\Models\Contractor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Company;
use App\Models\Project_category;
use App\Models\User_project;
use App\Models\Project_request;
use App\Models\User_login_history;
use App\Models\User_upload_images;
use App\Models\Wallet;
use Exception;

class UserController extends Controller
{
    public function registers(){
        $companydata = Company::get();
       return view('user/auth/register', compact('companydata'));
    }
    public function login(){
        return view('user/auth/login');
    }
    public function userAuthLogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $ip=$_SERVER['REMOTE_ADDR'];
        $userLoginHistory = User_login_history::create([
            "user_id" => "$request->username",
            "ip_address" => "$ip"
        ]);

        $userInfo = User::where('user_id','=',$request->username)->where('role', '4')->where('status', '1')->first();
        if (!$userInfo) {
            return redirect()->route('user.login')->with(session()->flash('alert-warning', 'Failed! We do not recognize your username.'));
        } else if ($userInfo->status == '0') {
            return redirect()->route('user.login')->with(session()->flash('alert-danger', 'Your account is blocked. Please! contact company for un-block.'));
        } else if ($request->password === $userInfo->password) {
            $request->session()->put('LoggedContractUser', $userInfo->id);
            return redirect('user/home');
        } else {
            return redirect()->route('user.login')->with(session()->flash('alert-danger', 'Failed! Incorrect Password.'));
        }
    }    
    public function userLogout(){
        if (session()->has('LoggedContractUser')) {
            session()->pull('LoggedContractUser');
            return redirect('user/login')->with(session()->flash('alert-success', 'You are successfully logged out'));
        }
    }
    public function userHome(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->where('role', '4')->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $userprojectcategory = Project_category::get();
        // dd($userprojectcategory);
        // $userprojectcategory = Project_category::where('project_cat_id', $contractdata->category_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $totaluserproject = User_project::where('user_id', '=', $data['LoggedContractInfo']->user_id)->count();
        $totaluserreproject = Project_request::where('user_id', '=', $data['LoggedContractInfo']->user_id)->count();
        $contractor_earned_amount = Wallet::where('contractor_id', '=', $data['LoggedContractInfo']->user_id)
                                ->where('cr_dr', '=', 'Credit')
                                ->sum('amount');
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        }        
        // $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        return view('user/home', $data, compact('contractor_earned_amount','contractdata', 'userprojectcategory','companydata','lastLoginTime', 'totaluserproject', 'totaluserreproject'));
    }
    public function myWallet(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->where('role', '4')->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $userprojectcategory = Project_category::where('project_cat_id', $contractdata->category_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $totaluserproject = User_project::where('user_id', '=', $data['LoggedContractInfo']->user_id)->count();
        $totaluserreproject = Project_request::where('user_id', '=', $data['LoggedContractInfo']->user_id)->count();
        $contractor_earned_amount = Wallet::where('contractor_id', '=', $data['LoggedContractInfo']->user_id)
                                ->where('cr_dr', '=', 'Credit')
                                ->sum('amount');
        $penaltyCutOff = Wallet::where('contractor_id', '=', $data['LoggedContractInfo']->user_id)
                                ->where('cr_dr', '=', 'Credit')
                                ->sum('penalty_amount');
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        }        
        // $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        return view('user/mywallet', $data, compact('penaltyCutOff','contractor_earned_amount','contractdata', 'userprojectcategory','companydata','lastLoginTime', 'totaluserproject', 'totaluserreproject'));
    }
    public function walletHistory(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->where('role', '4')->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $userprojectcategory = Project_category::where('project_cat_id', $contractdata->category_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $totaluserproject = User_project::where('user_id', '=', $data['LoggedContractInfo']->user_id)->count();
        $totaluserreproject = Project_request::where('user_id', '=', $data['LoggedContractInfo']->user_id)->count();
        // $walletHitory = Wallet::where('contractor_id', '=', $data['LoggedContractInfo']->user_id)->count();
        $contractor_earned_amount = Wallet::where('contractor_id', '=', $data['LoggedContractInfo']->user_id)
                                ->where('cr_dr', '=', 'Credit')
                                ->sum('amount');
        
        $walletHitory = Wallet::where('contractor_id', $data['LoggedContractInfo']->user_id)
                    ->join('projects', 'projects.project_id', '=', 'wallets.project_id')
                    ->join('users', 'users.user_id', '=', 'wallets.approved_by')
                    ->select(['wallets.amount as getContAmount','wallets.approved_by as ApprovedDistributor','wallets.created_at as amountRecDate','wallets.penalty_amount as penaltyAmount', 'users.*', 'projects.*'])
                    ->paginate(10);
                    // dd($walletHitory);
                    // die;
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        }        
        // $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        return view('user/wallethistory', $data, compact('contractor_earned_amount','contractdata', 'userprojectcategory','companydata','lastLoginTime', 'totaluserproject', 'totaluserreproject','walletHitory'));
    }
    public function workList(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        // $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        $worklist = Project::join('companies', 'companies.company_id', '=', 'projects.company_id')
                            ->join('project_categories', 'project_categories.project_cat_id', '=', 'projects.project_cat')
        ->select(['companies.*', 'projects.*', 'project_categories.*'])
        ->paginate(10);
        // dd($worklist);
        // die;
        return view('user/worklist',$data, compact('worklist'));
    }
    public function workDetails(Request $request){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $projectidcode = $request->post('projectid');
        $flag = false;
        if($projectidcode !== null){
            $flag = true;
            $projectdata = Project::where('project_id', $projectidcode)->first();
            $companydata = Company::where('company_id', $projectdata->company_id)->first();
            // dd($companydata);
            // die;
            $projectCateData = Project_category::where('project_cat_id', $projectdata->project_cat)->first();
            $distributordata = User::where('user_id', $projectdata->distributor_id)->first();
            return view('user/workdetails', $data, compact('projectdata', 'flag', 'companydata', 'projectCateData', 'distributordata'));
        }
        else{
            return view('user/workdetails',$data, compact('flag'));
        }
        
    }
    // public function applyForProject(Request $request){
    //     $request->validate([
    //         'project_id' => 'required',
    //         'user_id' => 'required'
    //     ]);
    //     $applyproject = Apply_project::create([
    //         "project_id" => "$request->project_id",
    //         "user_id" => "$request->user_id"
    //     ]);
    //     if($applyproject){
    //         return redirect()->back()->with(session()->flash('alert-success', 'Project Applied Successfully!'));
    //     }else{
    //         return redirect()->back()->with(session()->flash('alert-danger', 'Something Went Wrong. Please Try Again!'));  
    //     }
    // }
    public function appliedProject(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $appliedproject = User_project::where('user_id', '=', session('LoggedContractUser'))
                                        ->join('projects', 'projects.project_id', '=', 'apply_projects.project_id')
                                        ->select(['projects.*', 'apply_projects.*'])
                                        ->paginate(10);
        // dd($appliedproject);
        // die;
        return view('user/appliedproject',$data, compact('appliedproject'));
    }
    public function myProject(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $contractorData = User::where('id', '=', session('LoggedContractorUser'))->first();
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        $userProjects = User_project::where('user_id', '=', $data['LoggedContractInfo']->user_id)
                        ->join('projects', 'projects.project_id', '=', 'user_projects.project_id')
                        ->join('companies', 'companies.company_id', '=', 'projects.company_id')
                        ->join('project_categories', 'project_categories.project_cat_id', '=', 'projects.project_cat')
                        ->select(['project_categories.*', 'companies.*','projects.*','user_projects.*'])
                        ->paginate(10);
                        // dd($userProjects);
                        // die;
        return view('user/myproject',$data, compact('userProjects','companydata','lastLoginTime'));
    }
    public function completedProject(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $contractorData = User::where('id', '=', session('LoggedContractorUser'))->first();
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        $userProjects = User_project::where('user_projects.status',2)->where('user_id', '=', $data['LoggedContractInfo']->user_id)
                        ->join('projects', 'projects.project_id', '=', 'user_projects.project_id')
                        ->join('companies', 'companies.company_id', '=', 'projects.company_id')
                        ->join('project_categories', 'project_categories.project_cat_id', '=', 'projects.project_cat')
                        ->select(['project_categories.*', 'companies.*','projects.*','user_projects.*'])
                        ->paginate(10);
                        // dd($userProjects);
                        // die;
        return view('user/completed_project',$data, compact('userProjects','companydata','lastLoginTime'));
    }
    public function uploadImage(Request $request){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        $userid = $request->post('user_id');
        $flag = false;  
        if ($userid !== null) {
            $flag = true;  
            $userData = User_project::where('user_id', '=', $userid)->first();
            $projectData = Project::where('project_id', '=', $userData->project_id)->first();
            // dd($projectData);
            // die;
            $companyData = Company::where('company_id', '=', $projectData->company_id)->first();
            $projectCatData = Project_category::where('project_cat_id', '=', $projectData->project_cat)->first();
            return view('user/uploadimage',$data, compact('userData','flag','projectData','companyData','projectCatData','companydata','lastLoginTime'));
        }
        else{
            return view('user/uploadimage',$data, compact('flag'));
        }
        
    }
    public function uploadUserImage(Request $request){
        $request->validate([
            'user_id'=>'required',
            'project_id'=>'required',
            'distributor_id'=>'required',
            'project.*.project_title'=>'required',
            'project.*.project_image'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
        ]);
        // dd($request->all());
        foreach ($request->project as $key => $value) {
            // dd(file($value['project_image']));
            $file = $value['project_image'];
            // $fileget = file($file);
            $uploadedFileUrl = cloudinary()->upload($file->getRealPath())->getSecurePath();
            User_upload_images::insert([
                'title' => $value['project_title'],
                'image_name' => $value['project_title'],
                'image_url' => $uploadedFileUrl,
                'user_id' => $request->user_id,
                'project_id' => $request->project_id,
                'distributor_id' => $request->distributor_id,
            ]);
        }
        

     return redirect()->back()->with(session()->flash('alert-success', 'Image successfully uploaded.'));
    }

   public function viewProjectDetails(Request $request){
    $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
    $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
    $companydata = Company::where('company_id',$contractdata->company_id)->first();
    $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
    $projectid = $request->post('project_id');
    $flag = false;  
    if ($projectid !== null) {
        $flag = true;  
        $userData = User_project::where('user_id', '=', $data['LoggedContractInfo']->user_id)->first();
        $projectData = Project::where('project_id', '=', $projectid)->first();
        $companyData = Company::where('company_id', '=', $projectData->company_id)->first();
        $projectCatData = Project_category::where('project_cat_id', '=', $projectData->project_cat)->first();
        $user_project_images = User_upload_images::where('user_id', '=', $data['LoggedContractInfo']->user_id)
                                                ->where('project_id', '=', $projectid)
                                                ->get();
        return view('user/projectdetails',$data, compact('contractdata','userData','flag','projectData','companyData','projectCatData','user_project_images','companydata','lastLoginTime'));
    }
    else{
        return view('user/projectdetails',$data, compact('flag','companydata','lastLoginTime','contractdata'));
    }
   }
    public function uploadVideo(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        return view('user/uploadvideo',$data, compact('companydata','lastLoginTime'));
    }
    public function viewProfile(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        $userData = User::where('id', '=', session('LoggedContractUser'))->first();
        $contractorData = Contractor::where('user_id', '=', $userData->user_id)->first();
        return view('user/viewprofile',$data, compact('userData', 'contractorData','companydata','lastLoginTime'));
    }
    public function updateProfile(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $userData = User::where('id', '=', session('LoggedContractUser'))->first();
        $contractorData = Contractor::where('user_id', '=', $userData->user_id)->first();
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        return view('user/updateprofile',$data, compact('userData', 'contractorData','companydata','lastLoginTime'));
    }

    public function userProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'landmark' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
        ]);
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $userdataup = User::where('user_id', '=', $data['LoggedContractInfo']->user_id)
                            ->update([
                                'name' => $request->name,
                            ]);
        $usercontractupdate = Contractor::where('user_id', '=', $data['LoggedContractInfo']->user_id)
                                        ->update([
                                            'landmark' => $request->landmark,
                                            'city' => $request->city,
                                            'state' => $request->state,
                                            'country' => $request->country,
                                            'pincode' => $request->pincode,
                                        ]);
        if ($userdataup && $usercontractupdate) {
            return redirect()->back()->with(session()->flash('alert-success', 'You have successfully updated your profile.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
    }

    public function bankDetails()
    {
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        return view('user/bank-details',$data, compact('contractdata', 'companydata', 'lastLoginTime'));
    }

    public function fetchBankDetails(Request $request)
    {
        $request->validate([
            'ifsc_code' => 'required',
        ]);

        $ifscurl = 'https://ifsc.razorpay.com'.'/'.$request->ifsc_code;
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        try {
            $bankdetails = file_get_contents($ifscurl);
            $bank = json_decode($bankdetails);
            $rsultpass = true;
            return view('user/bank-details',$data, compact('contractdata', 'companydata','lastLoginTime', 'bank', 'rsultpass'));
          } catch (Exception $e) {
            $errormsg = $e->getMessage();
            return redirect()->back()->with(session()->flash('alert-warning', 'Ooohooo! Please enter correct IFSC Code.'));
          }
        // dd($bankdetails); die;
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public function userPasswordChange(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        if ($request->new_password === $request->confirm_password) {
            $oldpass = User::where('user_id', '=', $data['LoggedContractInfo']->user_id)->first();
            if ($oldpass->password === $request->old_password) {
                $uppassdata = User::where('user_id', '=', $data['LoggedContractInfo']->user_id)
                                    ->update([
                                        'password' => $request->new_password,
                                    ]);
                if ($uppassdata) {
                    return redirect()->back()->with(session()->flash('alert-success', 'Congratulations! You have successfully changed your password.'));
                } else{
                    return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
                }
            } else {
                return redirect()->back()->with(session()->flash('alert-warning', 'Please! enter correct old password.'));
            }
            
        } else{
            return redirect()->back()->with(session()->flash('alert-warning', 'New Password and Confirm Password not matched.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }

    public function updateBankDetails(Request $req)
    {
        $req->validate([
            'bank_name' => 'required',
            'account_holder_name' => 'required',
            'branch' => 'required',
            'ifsc_code' => 'required',
            'account_number' => 'required',
            'confirm_account_number' => 'required',
        ]);

        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        if ($req->account_number === $req->confirm_account_number) {
            $bankupdate = Contractor::where('user_id', '=', $data['LoggedContractInfo']->user_id)
                                ->update([
                                    'bank_name' => $req->bank_name,
                                    'account_holder_name' => $req->account_holder_name,
                                    'ifsc_code' => $req->ifsc_code,
                                    'branch' => $req->branch,
                                    'account_number' => $req->account_number,
                                ]);
            if ($bankupdate) {
                return redirect()->back()->with(session()->flash('alert-danger', 'Congratulations! Bank Details Successfully Updated.'));
            }
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        } else{
            return redirect()->back()->with(session()->flash('alert-warning', 'Account number and confirm account number not matched.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
        
    }

    public function changePassword(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        return view('user/changepassword',$data, compact('contractdata','companydata','lastLoginTime'));
    }
    public function registerUser(Request $request){
        $request->validate([
            'company_id' => 'required|max:190',
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'password' => 'required|string',
            'confirm_password' => 'required|string',
            // 'categoryselect' => 'required|max:190',
        ]);

        if ($request->password === $request->confirm_password) {
            $userdata = new Contractor;
            $usersdata = new User;
            $lastUserId = User::orderBy('id', 'desc')->first();
            if (isset($lastUserId)) {
                // Sum 1 + last id
                $euserid = $lastUserId->user_id+1;
            } else {
                $euserid = date('md').rand(111,999);
            }
            $verificationcode = sha1(time());
            $userdata->user_id = $euserid;
            $userdata->contractorID = date('md').time();
            $userdata->company_id = $request->company_id;
            // $userdata->category_id = $request->categoryselect;
            $userdata->category_id = 0;
            $userdata->save();

            $usersdata->user_id = $euserid;
            $usersdata->password = $request->password;
            $usersdata->name = $request->name;
            $usersdata->email = $request->email;
            $usersdata->mobile = $request->mobile;
            $usersdata->verificationCode = $verificationcode;
            $usersdata->role = 4;
            $usersdata->save();

            if ($userdata && $usersdata) {
                MailController::sendRegistrationMail($request->name, $verificationcode, $request->email, $euserid);
                return redirect()->back()->with(session()->flash('alert-success', 'Your account has been created. Please! check your mail for verification link.'));
            }
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.')); 
            
        }
        return redirect()->back()->with(session()->flash('alert-warning', 'Password and Confirm Password does not matched.'));
    }

    public function verifyUser(Request $request, $code, $userid){
        $user = User::where(['user_id' => $userid])
                    ->where(['verificationcode' => $code])
                    ->first();
        if ($user->verificationcode == $code) {
            if ($user->is_verified == '0') {
                if ($user !== null) {
                    $user->is_verified = 1;
                    $user->verified_at = now();
                    $user->save();
                    return redirect()->route('user.login')->with(session()->flash('alert-success', 'Congratulations! Your account is verified. Please Login!'));
                }       
                return redirect()->route('user.login')->with(session()->flash('alert-warning', 'Invalid verification code!'));
            }
            return redirect()->route('user.login')->with(session()->flash('alert-info', 'Your account is already active.'));
        }
        return redirect()->route('user.login')->with(session()->flash('alert-warning', 'Invalid verification code!'));
    }

    public function updateProfileData(Request $request){
        $request->validate([
            'userid' => 'required',
            'aadharNumber' => 'required',
            'panNumber' => 'required',
            'landmark' => 'required|max:150',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'passportphoto' => 'required|image|mimes:jpeg,png,jpg|max:500'
        ]);

        if ($request->hasfile('passportphoto')) {
            $file = $request->file('passportphoto');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'passportsize-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/contractor'), $filename);
        }

        $userupdate = Contractor::where('user_id', $request->userid)
                                ->update([
                                    'aadharNumber' => $request->aadharNumber,
                                    'panNumber' => $request->aadharNumber,
                                    'landmark' => $request->landmark,
                                    'city' => $request->city,
                                    'state' => $request->state,
                                    'country' => $request->country,
                                    'pincode' => $request->pincode,
                                    'altMobile' => $request->altMobile,
                                    'photo' => $filename,
                                    'is_upload' => 1,
                                ]);
        if ($userupdate) {
            return redirect()->back()->with(session()->flash('alert-success', 'Your data successfully received. Please wait for verification.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again.'));
    }

    public function userPostRequest(Request $request){
        $request->validate([
            'userid' => 'required',
            'projectCategory' => 'required',
            'beneficiaryName' => 'required',
            'beneficiary_mobile' => 'required',
            'altmobile' => 'required',
            'company_id' => 'required',
            'beneficiaryFullAddress' => 'required',
            'proposalPhoto' => 'required|max:500|image|mimes:jpg,jpeg,png',
            'proposalVideo' => 'required',
        ]);

        if ($request->hasfile('proposalPhoto')) {
            $file = $request->file('proposalPhoto');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'proposalPhoto-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/proposal'), $filename);
        }

        if ($request->hasfile('proposalVideo')) {
            $file = $request->file('proposalVideo');
            $extenstion = $file->getClientOriginalExtension();
            $vfilename = 'proposalVideo-'.time().'.'.$extenstion;
            $file->move(public_path('uploads/proposal'), $vfilename);
        }
        
        $projectrequest = new Project_request;
        $projectrequest->category = $request->projectCategory;
        $projectrequest->user_id = $request->userid;
        $projectrequest->company_id = $request->company_id;
        $projectrequest->beneficiray_name = $request->beneficiaryName;
        $projectrequest->beneficiary_mobile = $request->beneficiary_mobile;
        $projectrequest->alt_mobile_number = $request->altmobile;
        $projectrequest->full_address = $request->beneficiaryFullAddress;
        $projectrequest->proposal_photo = $filename;
        $projectrequest->proposal_video = $vfilename;
        $projectrequest->save();
        if ($projectrequest) {
            return redirect()->back()->with(session()->flash('alert-success', 'Request successfully sended. Please! wait for response.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again.'));
    }
    public function userProjectRequest(){
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];
        $contractdata = Contractor::where('user_id', $data['LoggedContractInfo']->user_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        } 
        $projectrequest = Project_request::where('user_id', $data['LoggedContractInfo']->user_id)->paginate(15);
        // dd($projectrequest);die;
        return view('user/project-request', $data, compact('projectrequest','companydata','lastLoginTime'));
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
    public function markAsCompleted(Request $request){
        $request->validate([
            'completed_date' => 'required',
            'project_id' => 'required',
            'user_id' => 'required',
            'project_complete_remarks' => 'required',
        ]);
        $data = ['LoggedContractInfo'=>User::where('id','=', session('LoggedContractUser'))->first()];

        
        $update_project_status = Project::where('project_id', '=', $request->project_id)
                                        ->update([
                                            'action' => 3,
                                            'project_status' => 3,
                                            'project_report' => 'COMPLETED',
                                            'project_complete_remarks' => $request->project_complete_remarks,
                                            'completed_date' => now(),
                                        ]);
        $update_user_project_status = User_project::where('project_id', '=', $request->project_id)->where('user_id', '=', $request->user_id)
                                                    ->update([
                                                        'status' => 2
                                                    ]);

        if ($update_project_status && $update_user_project_status) {
            return redirect('user/completed-project')->with(session()->flash('alert-success', 'Project Marked as Completed.'));
        }
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please! try again later.'));
    }
}