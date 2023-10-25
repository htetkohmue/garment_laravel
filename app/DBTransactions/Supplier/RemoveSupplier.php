<?php
namespace App\DBTransactions\Supplier;

use App\Models\Supplier;
use App\Classes\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class RemoveSupplier extends Transaction  {

    private $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function process()
    {
        if (!Supplier::where('id',$this->request->id)->exists()) {
            return response()->json([
                'status' =>  'NG',
                'message'   =>  trans('errorMessage.ER007'),
            ],200);
        }else{
            Supplier::where('id',$this->request->id)->delete();
            return ['status' => true, 'error' => false, ];
        }
        
    }
}
?>
