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
        $userprojectcategory = Project_category::where('project_cat_id', $contractdata->category_id)->first();
        $companydata = Company::where('company_id',$contractdata->company_id)->first();
        $userloginhistory = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->get();
        $historycount = count($userloginhistory);
        if ($historycount == 1) {
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->take(1)->first();
        } else{
            $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        }        
        // $lastLoginTime = User_login_history::where('user_id', $data['LoggedContractInfo']->user_id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        return view('user/home', $data, compact('contractdata', 'userprojectcategory','companydata','lastLoginTime'));
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
            'title'=>'required',
            'user_id'=>'required',
            'project_id'=>'required',
            'distributor_id'=>'required',
            'file'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
        ]);
        
         
        $file = $request->file('file');
        // $distributorphoto = 'distributor-'.time().'.'.$extenstion;
        
        $uploadedFileUrl = cloudinary()->upload($file->getRealPath())->getSecurePath();
        
    // $image = $request->file('file');
    // $name = $request->file('file')->getClientOriginalName();
    // $image_name = $request->file('file')->getRealPath();
    
    // $uploadedFileUrl= cloudinary()->upload::upload($image_name, null);
    // Cloudder::upload($image_name, null);
    // list($width, $height) = getimagesize($image_name);
    // $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
    // // save to uploads directory
    // $image->move(public_path("uploads"), $name);
    // Save images
    // $uploadedFileUrl = cloudinary()->upload($request->file('file')->getRealPath())->getSecurePath();
    $this->saveImages($request, $uploadedFileUrl);

     return redirect('user/my-project')->with(session()->flash('alert-success', 'Uploaded Successfully.'));
    }
    public function saveImages(Request $request, $uploadedFileUrl)
   {
       $image = new User_upload_images();
       $image->image_name = $request->title;
       $image->image_url = $uploadedFileUrl;
       $image->title = $request->title;
       $image->user_id = $request->user_id;
       $image->project_id = $request->project_id;
       $image->distributor_id = $request->distributor_id;
       $image->save();
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
        return view('user/projectdetails',$data, compact('userData','flag','projectData','companyData','projectCatData','user_project_images','companydata','lastLoginTime'));
    }
    else{
        return view('user/projectdetails',$data, compact('flag','companydata','lastLoginTime'));
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
            'categoryselect' => 'required|max:190',
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
            $userdata->category_id = $request->categoryselect;
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
    
}