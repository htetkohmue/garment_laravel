<?php

namespace App\Http\Controllers\API\Tailor;

use App\Models\Tailor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Tailor\TailorRepositoryInterface;

class TailorListController extends Controller
{
    protected $tailorRepo;
    public function __construct(TailorRepositoryInterface $tailorRepo)
    {
        $this->tailorRepo = $tailorRepo;
    }
  /**
     * Display a listing of the tailor resource.
     * htet Ko Hmue
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        try {
            $data = $this->tailorRepo->getTailorData();
            $tailorData = $data->map(function($data,$key) {
                return ["no"=>$key+1,"id"=>$data['id'],"tailorId"=>$data['tailor_id'],"nameMm"=>$data['name_mm'],
                        "nameEn"=>$data['name_en'],"phoneNo"=>$data['phone_no'],"nrcNo"=>$data['nrc_no']
                        ,"description"=>$data['description'],"address"=>$data['address']];
            });
            $tailorData=json_decode($tailorData,true);
            return response()->json([
                'status' =>  'OK',
                'row_count'=>count($tailorData),
                'data'   =>   $tailorData,
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>  'NG',
                'message' =>  trans('errorMessage.ER005'),
            ],200);
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
        try {
            if (!Tailor::whereIn('id',$request->tailor_id)->exists()) {
                return response()->json([
                    'status' =>  'NG',
                    'message'   =>  trans('errorMessage.ER007'),
                ],200);
            }
            Tailor::whereIn('id',$request->tailor_id)->delete();
            return response()->json([
                'status' => 'OK',
                'message'   =>  trans('successMessage.SS003'),
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>  'NG',
                'message' =>  trans('errorMessage.ER005'),
            ],200);
        }
        //

    }
}
