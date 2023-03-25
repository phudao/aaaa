<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'changepassword');
    }

    public function index(Request $request)
    {
        
        if ($request->isMethod('post')) 
        {
            $this->validate($request, [
                'email'     => 'required|email',
                'password'  =>  'required|min:6'
            ]);
    
            $user_data = array(
                'email'     =>  $request->get('email'),
                'password'     =>  $request->get('password')
            );
            if(Auth::attempt($user_data))
            {
                return redirect('/list');
            }else
            {
                return back()->with('error', 'Email hoặc mật khẩu không hợp lệ');
            }
        }
        else
        {
            return view('auth.login');
        }
    }

    public function changepassword(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            try
            {
                $request->validate([
                    'current_password' => 'required|min:6',
                    'new_password' => 'required|min:6',
                    'new_confirm_password' => 'same:new_password'
                ],[
                    'current_password.required' => 'Mật khẩu cũ độ dài nhỏ nhất là 6 kí tự',
                    'new_password.required' => 'Mật khẩu mới độ dài nhỏ nhất là 6 kí tự',
                    'same' => 'Mật khẩu mới và Xác nhận phải giống nhau'
                ]);
                
                $user = User::find(auth()->user()->id);
                if(Hash::check($request->input('current_password'), $user->password))
                {
                   $user->update(['password'=> Hash::make($request->input('new_password'))]);
                   return back()->with('success', 'Thay đổi mật khẩu thành công'); 
                }
                else{
                    return back()->with('error', 'Mật khẩu cũ không đúng');         
                }
            }
            catch(Exception $e)
            {
                return back()->with('error', $e->getMessage());
            }
            return back()->with('error', 'Thay đổi mật khẩu không thành công'); 
        }
        else
        {
            return view('auth.changepassword', []);
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
