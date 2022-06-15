<?php

namespace App\Http\Controllers;

use App\Models\Raws;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data       = Raws::whereNull('deleted_at')
                        ->get();
            $rawsData   = $data->map(function($data,$key) {
                $data['key']=$key+1;
                return $data;
            });
            $rawsData=json_decode($rawsData,true);
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
            'name'              => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'    =>  'NG',
                'message'   =>  $validator->errors()->all(),
            ],200);
        }
        try {
            DB::beginTransaction();

            // Log:info($request);
            // dd($request->name);
           
            Raws::insert([
                "name"              => $request->name,
                "type"              => $request->type,
                "description"       => $request->description,
                "created_emp"       => $request->login_id,
                "updated_emp"       => $request->login_id,

            ]);
            DB::commit();
            //return true;
            return response()->json([
                'status'    =>  'OK',
                'message'   =>  'Successfully completed!',
            ],200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
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
        try {

            $data= Raws::where('id',$id)->first();
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
        $rules = [
            'login_id'          => 'required',
            'name'              => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'    =>  'NG',
                'message'   =>  $validator->errors()->all(),
            ],200);
        }
        try {

            Raws::where('id',$id)->update([
                "name"              => $request->name,
                "type"              => $request->type,
                "description"       => $request->description,
                "created_emp"       => $request->login_id,
                "updated_emp"       => $request->login_id,

             ]);
            return response()->json([
                'status' =>  'OK',
                'message'   => 'Successfully updated!',
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
    public function destroy($id)
    {
        try {
            $res=Raws::where('id', $id)
             ->whereNull('deleted_at')
             ->delete();

            return response()->json([
                'status' =>  'OK',
                'message'   => 'Successfully deleted!',
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
