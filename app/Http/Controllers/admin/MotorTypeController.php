<?php

namespace App\Http\Controllers\admin;

use App\Models\motorbike_type;
use App\Response\ResponseCustom;
use App\Serializes\MotorTypeSerialize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MotorTypeController extends Controller
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
        $data = MotorTypeSerialize::serialize();
        DB::beginTransaction();
        try {
            $motor_type = motorbike_type::create($data);
            DB::commit();
            return ResponseCustom::response($motor_type);
        } catch (Exception $e) {
            DB::rollBack();
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
        $motor_type = motorbike_type::where(['id' => $id])->first();
        $manu_data = MotorTypeSerialize::serialize($motor_type);
        if($motor_type){
            $motor_type->update($manu_data);
        }
        return ResponseCustom::response($motor_type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $motor_type = motorbike_type::where(['id' => $id])->first();
        if($motor_type){
            $motor_type->delete();
        }
        return ResponseCustom::response([]);
    }

    public static function get_motor_type_by_mft_id($mft_id){
        $motor_type = motorbike_type::where(['mft_id' => $mft_id])->get();
        return $motor_type;
    }

}
