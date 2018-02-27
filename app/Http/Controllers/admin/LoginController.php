<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Validator;
use Validator;


class LoginController extends Controller
{
    public function getLogin(){
        return view('admin/login');
    }

    public function postLogin(Request $request)
    {
        $rules = [
            'user' => 'required',
            'pass' => 'required',
        ];
        $messages = [
            'required' => ':attribute không được để trống',
        ];
//        Auth::login($user, true);
        $Validator = Validator::make($request->all(), $rules, $messages);
        if ($Validator->fails()) {
            $errors['error'] = redirect()->back()->withErrors($Validator);
//            $errors = $Validator->errors()->all();
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
