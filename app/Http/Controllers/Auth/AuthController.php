<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\{State, City};
use Illuminate\Support\Facades\Auth;
use Mail;
use Str;
use DB;
use Session;

class AuthController extends Controller
{
    public function index()
    {
        $user = array();
        if(Auth::check()) {
            $user = Auth::user();
        }
        return view('home',compact('user'));
    }
    public function login()
    {
        if(Auth::check()) {
            return redirect('home');
        }
        $user = Auth::user();
        return view('auth.login',compact('user'));
    }
    public function registration()
    {
        if(Auth::check()) {
            return redirect('myprofile');
        }
        $data['country'] = Country::get(["country_id","country_name"]);
        return view('auth.registration', $data);
    }
    public function getStates(Request $request)
    {
        $data['state'] = State::where("country_id", $request->country_id)->get(["state_id","state_name"]);
        return response()->json($data);
    }
    public function getCities(Request $request)
    {
         $data['cities'] = City::where("state_id", $request->state_id)->get(["city_id","city_name"]);
        return response()->json($data);
    }

    public function postRegistration(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:40|unique:users',
            'password' => 'required|min:8|same:confirm_password',
            'mobile' => 'required|min:10',
            'gender' => 'required',
            'dob' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'countries' => 'required',
            'pincode' => 'required',
            'address' => 'required',
           // 'captcha' => 'required|captcha',
        ]);

        //email upload string create
        $photonam = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'),$photonam);
        $activation_code = Str::random(64);

       // $createUser = $this->insertUser($request->all(),$photonam);
        $usr = new User();
        $usr->first_name = $request->first_name;
        $usr->last_name = $request->last_name;
        $usr->email = $request->email;
        $usr->password = $request->password;
        $usr->mobile = $request->mobile;
        $usr->gender = $request->gender;
        $usr->dob = $request->dob;
        $usr->photo = $photonam;
        $usr->country = $request->countries;
        $usr->state = $request->states;
        $usr->city = $request->cities;
        $usr->pincode = $request->pincode;
        $usr->address = $request->address;
        $usr->activation_code = $activation_code;
        $usr->save();
        // email activation link


        Mail::send('emails.activaion_email_html',['activation_code'=>$activation_code], function($message) use($request){
            $message->to($request->email, $request->first_name);
            $message->subject('Click activation link for activate your account - Color');
        });
        /*Mail::send('Html.view', $data, function ($message) {
            $message->from('john@johndoe.com', 'John Doe');
            $message->sender('john@johndoe.com', 'John Doe');
            $message->to('john@johndoe.com', 'John Doe');
            $message->cc('john@johndoe.com', 'John Doe');
            $message->bcc('john@johndoe.com', 'John Doe');
            $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Subject');
            $message->priority(3);
            $message->attach('pathToFile');
        }); */

        return redirect('login')->withSuccess('You are registered successfully. Please login with your credentials');
    }
    public function activateAccount($activation_code)
    {
        $activateAccount = User::where('activation_code',$activation_code)->first();
        $message = "Your email address is not associated with us.";
        if(!is_null($activateAccount)) {
           $userupdate = User::where('activation_code',$activation_code)->update([
                         'is_active' => 1
                     ]);
        $message = "Your account is activated sucessfully.";
        } else {
        $message = "Your email address is not associated with us.";
        }
        return redirect('login')->with('success',$message);
    }
    public function get_new_captcha()
    {
       // $captcha = captcha_img();
        return response()->json(['captcha' =>captcha_img()]);
    }
    public function postLogin(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $checkLogin = $request->only('email','password');
        if(Auth::attempt( $checkLogin))
        {
        return redirect('myprofile');
        } else {
        return redirect('login')->withSuccess('Please provide correct login credentials');
        }
    }
    // public function insertUser(array $userdata, $photo)
    // {
    //     return User::create([
    //         'first_name' => $userdata['first_name'],
    //         'last_name' => $userdata['last_name'],
    //         'email' => $userdata['email'],
    //         'password' => $userdata['password'],
    //         'mobile' => $userdata['mobile'],
    //         'gender' => $userdata['gender'],
    //         'dob' => $userdata['dob'],
    //         'photo' => $photo,
    //         'countries' => $userdata['countries'],
    //         'pincode' => $userdata['pincode'],
    //         'address' => $userdata['address']
    //     ]);
    // }
}
