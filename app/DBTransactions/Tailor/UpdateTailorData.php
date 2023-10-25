<?php
namespace App\DBTransactions\Tailor;

use App\Models\Tailor;
use App\Classes\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UpdateTailorData extends Transaction  {
    //use LogTrait;
    private $request,$id;
    //private $attendanceArray;
    public function __construct($id,$request)
    {
        $this->request = $request;
        $this->id = $id;
    }
      /**
	 * Write detail of method
     *
     * @author Htet Ko Hmue
     * @create  2022/07/19
     * @return  array
	 */
    public function process()
    {
        $data= Tailor::where('id',$this->id)->update([
            "tailor_id"         => $this->request->tailor_id,
            "name_mm"           => $this->request->name_mm,
            "name_en"           => $this->request->name_en,
            "phone_no"          => $this->request->phone_no,
            "nrc_no"            => $this->request->nrc_no,
            "address"           => $this->request->address,
            "description"       => $this->request->description,
            "updated_emp"       => $this->request->login_id,
         ]);

        return ['status' => true, 'error' => ''];
    }
}
?>
