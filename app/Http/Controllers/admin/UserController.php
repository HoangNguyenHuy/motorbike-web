<?php

namespace App\Http\Controllers\admin;

use App\Forms\BasicForm;
use App\Http\Controllers\Controller;
use App\_const\strings;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Exception;
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
        $user = $this->show(Auth::user()->id);
        $data = array();
        $fields = BasicForm::user_info_form($user);
        $data['form'] = BasicForm::init_form('user-info');
        $data['submit'] = BasicForm::render_button('Lưu',['class'=>'btn-primary btn-save pull-right']);
        $data['user_name'] = $user['user_name'];
        $data['email_login'] = $user['email_login'];
//        $data['avatar_url'] = $user['avatar_url'];
        $data['avatar_url'] = 'https://source.unsplash.com/random/300x300'; // TODO debug
        $data = $data + $fields;
        return view('admin/index',$data);
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
        $user = User::where(['id' => $id])->first();
        If ($user) {
            $profile = UserProfile::where(['user_id' => $user['id']])->first();
            $profile['user_name'] = $user['name'];
            $profile['email_login'] = $user['email'];
            return $profile;
        } else {
            $data['error'] = ucfirst(strings::user_does_not_exist);
            return response()->json($data)->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }
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

    public function save_avatar(Request $request){
        try {
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $imageName = time().'.png';
            file_put_contents('images/avatars/'.$imageName, $data);
            echo 'done';
//            if(isset($_POST) && isset($_FILES['avatar'])){
//                $avatar_info = $_FILES['avatar'];
//                $avatar = $request->avatar;
//                $extension = ['jpg', 'png', 'gif', 'jpeg'];
//                $ext = explode('.', $avatar_info['name']); // split extension of file
//                $ext = $ext[(count($ext)-1)]; // get extension
//
//                // check file is an image
//                if(in_array($ext, $extension)){
//
//                    // handle upload
//                    // if(move_uploaded_file($avatar_info['tmp_name'], 'images/avatars/' . $avatar_info['name'])){
//                    if(file_put_contents('images/avatars/' . $avatar_info['name'], file_get_contents($avatar))){
//                        // success
//                        die($avatar_info['name']);
//                    } else{
//                        // fail
//                        die('Có lỗi!');
//                    }
//                } else{
//                    // The file is not an image
//                    die('Chỉ được upload ảnh');
//                }
//            }
//            else{
//                die('Lock'); // is not post method
//            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage();
        }
    }
}
