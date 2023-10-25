<?php
namespace App\DBTransactions\Supplier;

use App\Models\Supplier;
use App\Classes\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class EditSupplier extends Transaction  {

    private $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function process()
    {
        Supplier::where('id', $this->request->id)->update([
            'name_mm' => $this->request->name_mm,
            'name_en' => $this->request->name_en,
            'phone_no' => $this->request->phone_no,
            'email' => $this->request->email,
            'company' => $this->request->company,
            'address' => $this->request->address,
            'comment' => $this->request->comment,
            'updated_emp' => $this->request->login_id,
         ]);

        $row = Supplier::where('id', $this->request->id)->first();
        
        return ['status' => true, 'error' => false, 'data' => $row];
    }
}
?>
