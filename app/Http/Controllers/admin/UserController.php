<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

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
