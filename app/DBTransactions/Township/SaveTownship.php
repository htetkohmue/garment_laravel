<?php
namespace App\DBTransactions\Township;

use App\Models\Township;
use App\Classes\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaveTownship extends Transaction  {
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
        $row = Township::insert([
            'name' => $this->request->name,
            'created_emp' => $this->request->login_id,
            'updated_emp' => $this->request->login_id,
        ]); 
        return ['status' => true, 'error' => ''];
    }
}
?>
