<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordEmail;
use App\Mail\SendNewPasswordEmail;
use Illuminate\Support\Str;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function index(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            //check email blabe
            //check email dataabase
            
            $count = DB::table('users')->where('email', $request->input('email'))->where('active', 1)->count();
            if($count > 0)
            {
                //add new field in table users request_pass deefault = 0 and update request_pass=1
                $data['email'] = $request->input('email');
                Mail::to($data['email'])->send(new ForgotPasswordEmail($data));
                return redirect('/')->with('success', 'Email xác nhận đã được gửi');
            }
            else
            {
                return redirect('/forgot')->with('error', 'Không tìm thấy email hoặc tài khoản chưa được kích hoạt');
            }
        }else
        {
            return view('auth.forgot');
        }
    }

    public function generatepass($email)
    {
        //if(request_pass == 1 and email == email){
        //gen pass random and update password= new pass and request_pass = 0
        //redirect /
        //}
        //print_r();
        //check email
        try
        {
            $newpass = Str::random(6);
            $data['pass'] = $newpass;
            $user = User::where('email', $email);// request_pass = 1
            $user->update(['password'=> Hash::make($newpass)]);
            Mail::to($email)->send(new SendNewPasswordEmail($data));
            return redirect('/')->with('success', 'Mật khẩu mới đã được gửi.');
        }
        catch(Exception $e)
        {
            
        }
        
    }
}
