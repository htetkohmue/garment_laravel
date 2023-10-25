<?php
namespace App\DBTransactions\Customer;

use App\Models\Customer;
use App\Classes\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaveCustomer extends Transaction  {
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
        $row = Customer::insert([
            'customer_id' => $this->request->customer_id,
            'name_mm' => $this->request->name_mm,
            'name_en' => $this->request->name_en,
            'email' => $this->request->mail,
            'phone_no' => $this->request->phone_no,
            'nrc_no' => $this->request->nrc_no,
            'email' => $this->request->email,
            'address' => $this->request->addresses,
            'township_id' => $this->request->township_name,
            'status' => $this->request->statuses,   
            'join_date' => $this->request->join_date,          
            'description' => $this->request->descriptions,
            'created_emp' => $this->request->login_id,
            'updated_emp' => $this->request->login_id,
        ]); 
        return ['status' => true, 'error' => ''];
    }
}
?>
