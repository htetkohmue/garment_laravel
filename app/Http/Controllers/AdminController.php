<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\DBTransaction\SaveAdminData;

class AdminController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'admin_code'        => 'required|numeric',
            'password'          => 'required',
            'admin_name'        => 'required|string'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'    =>  'NG',
                'message'   =>  $validator->errors()->all(),
            ],422);
        }
        try {
            //$hashedPassword = hash('sha512', $request->password);
            //create SaveAfterOvertimeRequest Class to save data in db
            $process = new SaveAdminData($request);
            //$employeeDatas = json_decode($process->getContent(), true);
            //dd($employeeDatas);
            return response()->json([
                'status'    =>  'OK',
                'message'   =>  'Success',
            ],200);
            // call executeProcess method that already write database transaction
           // $saveResult = $process->executeProcess();

        } catch (\Throwable $th) {
            //throw $th;
        }

        //return $request;
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
