<?php

namespace App\Http\Controllers\API\Tailor;
use App\Models\Tailor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\DBTransactions\Tailor\SaveTailorData;
use App\DBTransactions\Tailor\UpdateTailorData;

class TailorRegistrationController extends Controller
{
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
            //create SaveTailorData Class to save data in db
            $save = new SaveTailorData($request);
            $bool = $save->executeProcess();
            if ($bool) {
                return response()->json([
                    'status'    =>  'OK',
                    'message'   =>  trans('successMessage.SS001'),
                ],200);
            }else{
                return response()->json([
                    'status' =>  'NG',
                    'message' =>  trans('errorMessage.ER005'),
                ],200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>  'NG',
                'message' =>  trans('errorMessage.ER005'),
            ],200);
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
            $data= Tailor::where('id',$id)->first();
            if (empty($data)) {
                return response()->json([
                    'status' =>  'NG',
                    'message'   =>  trans('errorMessage.ER007'),
                ],200);
            }
            return response()->json([
                'status' =>  'OK',
                'data'   =>   $data,
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>  'NG',
                'message' =>  trans('errorMessage.ER005'),
            ],200);
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
            if (!Tailor::where('id',$id)->exists()) {
                return response()->json([
                    'status' =>  'NG',
                    'message'   =>  trans('errorMessage.ER007'),
                ],200);
            }
            //create UpdateTailorData Class to update data in db
            $update = new UpdateTailorData($id,$request);
            $bool = $update->executeProcess();
            if ($bool) {
                return response()->json([
                    'status'    =>  'OK',
                    'message'   =>  trans('successMessage.SS002'),
                ],200);
            }else{
                return response()->json([
                    'status' =>  'NG',
                    'message' =>  trans('errorMessage.ER005'),
                ],200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>  'NG',
                'message' =>  trans('errorMessage.ER005'),
            ],200);
        }

    }

}
