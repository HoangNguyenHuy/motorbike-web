<?php

namespace App\Http\Controllers\admin;

use App\Forms\BasicForm;
use App\Http\Controllers\Controller;

use App\Models\manufacturer;
use App\Response\ResponseCustom;
use App\Serializes\ManufacturerSerialize;
use Illuminate\Http\Request;

use Exception;
use View;
use Illuminate\Support\Facades\DB;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manu_list = manufacturer::all()->sortByDesc("name");
        $list_item = [];
        foreach ($manu_list as $manu){
            $motor_types = MotorTypeController::get_motor_type_by_mft_id($manu->id);
            $bike_types = $this->parse_motor_type($motor_types);
            $list_item[] = array(
                'id'=>$manu->id,
                'name'=>$manu->name,
                'bike_types'=>$bike_types,
            );
        }
        $data['form'] = BasicForm::init_form('add-manufacturer','manufacturerForm');
        $fields = BasicForm::manufacturer_add_form();
        $data['manu_list'] = $list_item;
        $data = $data + $fields;
        return view('admin/manufacturer', $data);
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
        $data = ManufacturerSerialize::serialize();
        DB::beginTransaction();
        try {
            $manufacturer = Manufacturer::create($data);
            DB::commit();
            return ResponseCustom::response($manufacturer);
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
        try {
            // TODO refactor render html from view, create a render basic class
            $manufacturer = Manufacturer::where(['id' => $id])->first();
            $motor_types = MotorTypeController::get_motor_type_by_mft_id($manufacturer->id);
            $view = View::make('admin/templates/_edit_manufacturer', ['manu'=>$manufacturer, 'motor_type'=>$motor_types]);
            $html = $view->render();
            $res['html']= $html;
            return $res;
        }
        catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage();
        }
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
        $manufacturer = Manufacturer::where(['id' => $id])->first();
        $manu_data = ManufacturerSerialize::serialize($manufacturer);
            if($manufacturer){
                $manufacturer->update($manu_data);
            }
        return ResponseCustom::response($manufacturer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $manufacturer = Manufacturer::where(['id' => $id])->first();
            if($manufacturer){
                $motor_types = MotorTypeController::get_motor_type_by_mft_id($manufacturer->id);
                foreach ($motor_types as $motor_type){
                    $motor_type->delete();
                }
                $manufacturer->delete();
            }
            DB::commit();
            return ResponseCustom::response([]);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public static function parse_motor_type($list_type){
        $types = '';
        foreach ($list_type as $type){
            if (!$types)
                $types = $type->name;
            else
                $types = $types.', '.$type->name;
        }
        return $types;
    }

}
