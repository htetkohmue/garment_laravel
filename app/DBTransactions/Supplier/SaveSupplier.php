<?php
namespace App\DBTransactions\Supplier;

use App\Models\Supplier;
use App\Classes\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SaveSupplier extends Transaction  {
    //use LogTrait;
    private $request;
    //private $attendanceArray;
    public function __construct($request)
    {
        $this->request = $request;
    }
      /**
	 * Write detail of method
     *
     * @author Hein Htet Ko
     * @create  2022/08/15
     * @return  array
	 */
    public function process()
    {
        $row_count = Supplier::count()+1;
        $row = Supplier::create([
            'name_mm' => $this->request->name_mm,
            'name_en' => $this->request->name_en,
            'phone_no' => $this->request->phone_no,
            'email' => $this->request->email,
            'company' => $this->request->company,
            'address' => $this->request->address,
            'comment' => $this->request->comment,
            'created_emp' => $this->request->login_id,
            'updated_emp' => $this->request->login_id,
        ]);
        $row['no'] = $row_count;

        return ['status' => true, 'error' => false, 'data' => $row];
    }
}
?>
