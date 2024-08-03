<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        $data = [
            'title' => 'Login',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('auth.login',  $data);
    }

    public function loginSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'username_or_email' => 'required|string',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('login')->withInput()->withErrors($validator);
        }
    
        $usernameOrEmail = $request->input('username_or_email');
        $password = $request->input('password');
    
        // Determine if the input is an email or username
        $loginType = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        // Attempt to authenticate using the determined login type
        if (Auth::attempt([$loginType => $usernameOrEmail, 'password' => $password])) {
            $user = Auth::user();
            if ($user->is_active) {
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('warning', 'Your account is not active, Plese contact your administrator');
            }
        } else {
            return redirect()->route('login')->with('error', 'Username/Email and password are incorrect, please try again');
        }
    }
    

    public function registerDistrict(){
        $data = [
            'title' => 'Register',
            'subTitle' => null,
            'page_id' => null,
            'district' => District::all()
        ];
        return view('auth.register_district',  $data);
    }

    public function registerDistrictSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'district' => 'required',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|min:6|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return redirect()->route('register.district')->withInput()->withErrors($validator);
        }
        $user = new User();
        $user->district_id  = $request->district;
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->username  = $request->username;
        $user->password  = Hash::make($request->password);
        $user->role  = 'admin-kecamatan';
        $user->save();

        return redirect()->route('login')->with('success', 'Congratulation!!, Your account registered successfully');
    }

    public function registerVillage(){
        $data = [
            'title' => 'Register',
            'subTitle' => null,
            'page_id' => null,
            'district' => District::all()
        ];
        return view('auth.register_village',  $data);
    }

    public function registerVillageSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'district' => 'required',
            'village' => 'required',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|min:6|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return redirect()->route('register.village')->withInput()->withErrors($validator);
        }
        $user = new User();
        $user->district_id  = $request->district;
        $user->village_id  = $request->village;
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->username  = $request->username;
        $user->password  = Hash::make($request->password);
        $user->role  = 'admin-kelurahan';
        $user->save();

        return redirect()->route('login')->with('success', 'Congratulation!!, Your account registered successfully');
    }

    public function forget(){
        $data = [
            'title' => 'Forget Password',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('auth.forget',  $data);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
