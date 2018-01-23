<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    Function getLogin(){
        return view('admin/login');
    }

    public function postLogin(Request $request)
    {
        $rules = [
            'user' => 'required',
            'pass' => 'required',
        ];
        $messages = [
            'user.required' => 'tài khoản không được để trống',
            'pass.required' => 'mật khẩu không được để trống',
        ];
//        Auth::login($user, true);
        $Validator = Validator::make($request->all(), $rules, $messages);
        if ($Validator->fails()) {
            $errors['error'] = redirect()->back()->withErrors($Validator);
//            $errors['error'] = $Validator->errors()->all();
            return view('admin/login', $errors);
        } else {
            $arr = [
                'name' => $request->user,
                'password' => $request->pass
            ];
            If (DB::table('users')->where($arr)->count() == 1) {
                Return 'dang nhap thanh cong';
            } else {
                $errors['error'] = 'đăng nhập thất bại';
            }
            Return 'ok';
        }
    }
}
