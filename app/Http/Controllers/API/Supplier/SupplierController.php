<?php

namespace App\Http\Controllers\API\Supplier;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\DBTransactions\Supplier\SaveSupplier;
use App\DBTransactions\Supplier\EditSupplier;
use App\DBTransactions\Supplier\RemoveSupplier;
use App\Interfaces\Supplier\SupplierRepositoryInterface;

class SupplierController extends Controller
{
    protected $SupplierRepo;
    public function __construct(SupplierRepositoryInterface $SupplierRepo)
    {
        $this->SupplierRepo = $SupplierRepo;
    }

    public function saveSupplier(Request $request)
    {
        $rules = [
            'name_mm' => 'required',
            'name_en' => 'required',
            'phone_no' => 'required',
            'address' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'    =>  'NG',
                'message'   =>  $validator->errors()->all(),
            ],200);
        }
        try {
            $save = new SaveSupplier($request);
            $bool = $save->process();
            if ($bool['status']) {
                return response()->json([
                    'status'    =>  'OK',
                    'message'   =>  trans('successMessage.SS001'),
                    'data' => $bool['data'],
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

    public function getSupplierList(){
        try {
            $data = $this->SupplierRepo->getSupplierData();    
            $clean_data = $data->map(
                function($data, $key){
                return [
                'no' => $key+1,
                'id' => $data['id'],
                'name_mm' => $data['name_mm'],
                'name_en' => $data['name_en'],
                'phone_no' => $data['phone_no'],
                'email' => $data['email'],
                'company' => $data['company'], 
                'address' => $data['address'], 
                'comment' => $data['comment']];
            });
            
            if(empty($clean_data)){
                return response()->json([
                    'status' =>  'OK',
                    'row_count' => count($clean_data),
                    'message' => '',
                    'data'   =>   $clean_data,
                ],200);
            }else{
                return response()->json([
                    'status' =>  'OK',
                    'row_count' => count($clean_data),
                    'message' => '',
                    'data'   =>   $clean_data,
                ],200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>  'NG',
                'message' =>  trans('errorMessage.ER005'),
            ],200);
        }
    }

    public function editSupplier(Request $request){
        $rules = [
            'name_mm' => 'required',
            'name_en' => 'required',
            'phone_no' => 'required',
            'address' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'    =>  'NG',
                'message'   =>  $validator->errors()->all(),
            ],200);
        }
        try {
            $edit = new EditSupplier($request);
            $bool = $edit->process();
            if ($bool['status']) {
                return response()->json([
                    'status'    =>  'OK',
                    'message'   =>  trans('successMessage.SS002'),
                    'data' => $bool['data'],
                ],200);
            }else{
                return response()->json([
                    'status' =>  'NG',
                    'message' =>  trans('errorMessage.ER005'),
                ],200);
            }
        }catch (\Throwable $th) {
            return response()->json([
                'status' =>  'NG',
                'message' =>  trans('errorMessage.ER005'),
            ],200);
        }
        return response()->json([
            'status' =>  'NG',
            'message' =>  $request,
        ],200);
    }

    public function removeSupplier(Request $request){
        try {
            $remove = new RemoveSupplier($request);
            $bool = $remove->process();
            if ($bool['status']) {
                return response()->json([
                    'status'    =>  'OK',
                    'message'   =>  trans('successMessage.SS003'),
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
