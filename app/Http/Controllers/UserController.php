<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\MailController;
use App\Models\Contractor;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function registers(){
       return view('user/auth/register');
    }
    public function login(){
        return view('user/auth/login');
    }
    public function userAuthLogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $userInfo = User::where('user_id','=',$request->username)->where('role', '4')->where('status', '1')->first();
        if (!$userInfo) {
            return redirect()->route('user.login')->with(session()->flash('alert-warning', 'Failed! We do not recognize your username.'));
        } else if ($userInfo->status !== '1') {
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
        return view('user/home', $data, compact('contractdata'));
    }
    public function workList(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/worklist',$data);
    }
    public function workDetails(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/workdetails',$data);
    }
    public function appliedProject(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/appliedproject',$data);
    }
    public function myProject(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/myproject',$data);
    }
    public function uploadImage(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/uploadimage',$data);
    }
    public function uploadVideo(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/uploadvideo',$data);
    }
    public function viewProfile(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/viewprofile',$data);
    }
    public function updateProfile(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/updateprofile',$data);
    }
    public function changePassword(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('user/changepassword',$data);
    }
    public function registerUser(Request $request){
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'password' => 'required|string',
            'confirm_password' => 'required|string',
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
    
}