<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // login
        $rules = [
            'lg_username' => 'required',
            'lg_password' => 'required',
        ];
        $messages = [
            'required' => ':attribute không được để trống',
        ];
//        Auth::login($user, true);
        $Validator = Validator::make($request->all(), $rules, $messages);
        if ($Validator->fails()) {
//            $errors['error'] = redirect()->back()->withErrors($Validator);
            $error = $Validator->errors()->all();
            $data['error'] =$error;
            return view('admin/login', $data);
        } else {
            $arr = [
                'name' => $request->lg_username,
                'password' => md5($request->lg_password)
            ];
            If (DB::table('users')->where($arr)->count() == 1) {
                $data['error'] = ['dang nhap thanh cong'];
            } else {
                $data['error'] = ['đăng nhập thất bại'];
            }
            return view('admin/login', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
