<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
   
    use AuthenticatesUsers;

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }


    // Post Login API for customers
    public function postLogin(Request $request)
    {
        if ($request->email != '' && $request->password != '') {

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $request->has('remember'))) {

                // echo 'Yes'; die;
                if (Auth::user()->user_role == 'customer' && Auth::user()->status == 1 && Auth::user()->account_status == 'Active') {
                    $token = Hash::make(time());
                    User::where('email', $request->email)->update(['remember_token' => $token]);
                    // print_r('1');die;
                    return response()->json([
                        'status' => 1,
                        'message' => 'Login successful.',
                        'access-token' => $token

                    ]);
                } elseif (Auth::user()->status == 0 || Auth::user()->account_status == 'Ban') {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Your account is blocked.',
                    ]);
                }
                else{
                    return response()->json([
                        'status' => 0,
                        'message' => 'Invalid credentials.',
                    ]);
                }
            } else
                return response()->json([
                    'status' => 0,
                    'message' => 'Invalid Email Id & Password.',
                ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Email Id & Password both are mendatory',
            ]);
        }
    }

    
    // Post Register Api for customers
    public function postRegister(Request $request)
    {
        $data = $request->all();

        if ($data['email'] == '' || $data['name'] == '' || $data['password'] == '') {
            return response()->json([
                'status' => 0,
                'message' => 'Name, Email & Password field is mendatory',
            ]);
        } else {

            $checkUser = User::where('email', $request->email)->first();

            if ($checkUser) {
                return response()->json([
                    'status' => 0,
                    'message' => 'This Email is already registered.',
                ]);
            } else {

                $data['status'] = 1;
                $data['password'] = Hash::make($data['password']);
                $data['user_role'] = 'customer';

                $userId = User::insertGetId($data);

                // $otp = rand(100000,999999);
                $otp = 123456;

                $otpId = DB::table('email_verifications')->insertGetId([
                    'email' => $data['email'],
                    'otp' => $otp,
                    'verified' => 0
                ]);

                if ($otpId) {
                    return response()->json([
                        'status' => 1,
                        'message' => 'OTP is send to your mail id.',
                    ]);
                } else {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Something went wrong',
                    ]);
                }
            }
        }
    }

   
    // Verify OTP for customers
    public function verifyOtp(Request $request)
    {
        $data = $request->all();

        if($data['email']=='' || $data['otp']==''){
            return response()->json([
                'status' => 0,
                'message' => 'Email or OTP missing.',
            ]);
        }
        else{
            $checkOtp = DB::table('email_verifications')->where('email',$data['email'])->get()->last();

            if($checkOtp->verified==0){
                if($checkOtp->otp == $data['otp']){
                    DB::table('email_verifications')->where('id',$checkOtp->id)->update(['verified'=>1]);

                    User::where('email',$data['email'])->update(['account_status' => 'Active']);
                    // print_r($checkOtp->id); die;
                    return response()->json([
                        'status' => 1,
                        'message' => 'OTP Verified. Successfully Registered',
                    ]);
                }
                else{
                    return response()->json([
                        'status' => 0,
                        'message' => 'Invalid OTP.',
                    ]);
                }
            }

            else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Invalid Request.',
                ]);
            }

        }
    }


    // Forgot Password to send a link on mail
    public function forgotPassword(Request $request){
        if($request->email==''){
            return response()->json([
                'status' => 0,
                'message' => 'Email Id is required',
            ]);
        }
        else{
            $checkUser = User::where('email', $request->email)->first();
            // print_r($checkUser); die;
            if($checkUser){

            if($checkUser->status==1){
                return response()->json([
                    'status' => 0,
                    'message' => 'Reset Password Link is send to your email id.',
                ]);
            }
            else{
                if($checkUser->status == 0 && $checkUser->account_status=='Active'){
                    return response()->json([
                        'status' => 0,
                        'message' => 'This email id is blocked.',
                    ]);
                }
                else{
                    return response()->json([
                        'status' => 0,
                        'message' => 'Invalid Request',
                    ]);
                }
            }
        }
        
        else{
            return response()->json([
                'status' => 0,
                'message' => 'Invalid email id.',
            ]);
        }
    }
    }
    
    // Reset Password for customer
    public function resetPassword(Request $request)
    {
        if($request->email=='' && $request->password==''){
            return response()->json([
                'status' => 1,
                'message' => 'Email & Password both are mendatory.',
            ]);
        }
        else{
            User::where('email',$request->email)->update('password',Hash::make($data['password']));
            return response()->json([
                'status' => 1,
                'message' => 'Password updated successfully.',
            ]);
        }
        
    }

}
