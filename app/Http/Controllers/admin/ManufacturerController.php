<?php

namespace App\Http\Controllers\admin;

use App\Forms\BasicForm;
use App\Http\Controllers\Controller;

use App\Models\manufacturer;
use App\Response\ResponseCustom;
use App\Serializes\ManufacturerSerialize;
use Illuminate\Http\Request;

use Exception;
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
        foreach ($manu_list as $manu)
            // TODO update here, add list bike_type to $list_item
            $list_item[] = array('id'=>$manu->id, 'name'=>$manu->name);
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
        $data = $request->all();
        $data = ManufacturerSerialize::serialize($data);
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
