<?php

namespace App\Http\Controllers\admin;

use App\_const\strings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
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
        //
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
            'username' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'required' => ':attribute is required',
        ];
//        Auth::login($user, true);
        $Validator = Validator::make($request->all(), $rules, $messages);
        if ($Validator->fails()) {
            $error = $Validator->errors()->all();
            foreach ($error as $key => $err){
                $error[$key] = ucfirst($err);
            };
            $data['error'] =$error;
            return response()->json($data);
        } else {
            $conditions = [
                'name' => $request->username,
                'password' => md5($request->password)
            ];
            If (DB::table('users')->where($conditions)->count() == 1) {
                $data['success'] = ['dang nhap thanh cong'];
            } else {
                $data['error'] = [ucfirst(strings::login_fail)];
                return response()->json($data)->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);

            }
//            set value into session
//            return Redirect::to('/admin')->with('message', 'Login Failed');
//            get value {{ Session::get('message') }}
            return response()->json($data);
//            return View::make('admin/login', array('name' => 'Taylor'));
//            return view('admin/login', $data);
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
        // return user info
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
