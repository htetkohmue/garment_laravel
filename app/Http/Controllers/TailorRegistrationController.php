<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DBTransaction\SaveTailorData;
use Illuminate\Support\Facades\Validator;
use App\Models\Tailor;

class TailorRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $data       = Tailor::all();
            $tailorData = $data->map(function($data,$key) {
                $data['key']=$key+1;
                return $data;
            });
            $tailorData=json_decode($tailorData,true);
            return response()->json([
                'status' =>  'OK',
                'row_count'=>count($data),
                'data'   =>   $data,
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'login_id'          => 'required',
            'name_mm'          => 'required',
            'name_en'        => 'required',
            'phone_no'          => 'required',
            'nrc_no'        => 'required',
            'address'          => 'required',
            'tailor_id'        => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'    =>  'NG',
                'message'   =>  $validator->errors()->all(),
            ],200);
        }
        try {
            //create SaveAfterOvertimeRequest Class to save data in db
            $process = new SaveTailorData($request);
            return response()->json([
                'status'    =>  'OK',
                'message'   =>  'Successfull Registration',
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
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
        try {

            //create SaveAfterOvertimeRequest Class to save data in db
            $data= Tailor::where('id',$id)->first();
            return response()->json([
                'status' =>  'OK',
                'data'   =>   $data,
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
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
        //
        $rules = [
            'login_id'          => 'required',
            'name_mm'          => 'required',
            'name_en'        => 'required',
            'phone_no'          => 'required',
            'nrc_no'        => 'required',
            'address'          => 'required',
            'tailor_id'        => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'    =>  'NG',
                'message'   =>  $validator->errors()->all(),
            ],200);
        }
        try {

            //create SaveAfterOvertimeRequest Class to save data in db
            $data= Tailor::where('id',$id)->update([
                "tailorId"         => $request->tailor_id,
                "nameMm"           => $request->name_mm,
                "nameEn"           => $request->name_en,
                "phoneNo"          => $request->phone_no,
                "nrcNo"            => $request->nrc_no,
                "address"           => $request->address,
                "description"       => $request->description,
                "created_emp"       => $request->login_id,
                "updated_emp"       => $request->login_id,
             ]);
            return response()->json([
                'status' =>  'OK',
                'message'   => 'Update Successfull',
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Tailor::whereIn('id',$request->tailor_id)->delete();
        return response()->json([
            'status' => 'OK',
            'message'   => 'Delete Successfull',
        ],200);

    }
}
