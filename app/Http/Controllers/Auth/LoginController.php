<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\_const\strings;
use App\Models\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

use Validator;

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
//    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//        Session::put('backUrl', URL::previous());
//    }

    public function index(){
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('admin/login');
    }

    public function login(Request $request){
        // login
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'required' => ':attribute is required',
        ];
        $Validator = Validator::make($request->all(), $rules, $messages);
        if ($Validator->fails()) {
            $error = $Validator->errors()->all();
            foreach ($error as $key => $err){
                $error[$key] = ucfirst($err);
            };
            $data['error'] =$error;
            return response()->json($data);
        } else {
            // TODO add check input is an email for login with email and username
            $conditions = [
                'name' => $request->username,
                'password' => md5($request->password)
            ];
            $auth_user = User::where($conditions)->first();
            If ($auth_user) {
                Auth::login($auth_user,$request->remember == 1);
                $data['redirect'] = route('home');
            } else {
                $data['error'] = [ucfirst(strings::login_fail)];
                return response()->json($data);
            }
            return response()->json($data);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('home'));
    }
}
