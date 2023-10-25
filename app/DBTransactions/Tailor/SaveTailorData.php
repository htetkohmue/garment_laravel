<?php
namespace App\DBTransactions\Tailor;

use App\Models\Tailor;
use App\Classes\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SaveTailorData extends Transaction  {
    //use LogTrait;
    private $request;
    //private $attendanceArray;
    public function __construct($request)
    {
        $this->request      = $request;
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
        //$hashedPassword = hash('sha512', $this->request->password);
        //Insert into admins table
        Tailor::insert([
            "tailor_id"         => $this->request->tailor_id,
            "name_mm"           => $this->request->name_mm,
            "name_en"           => $this->request->name_en,
            "phone_no"          => $this->request->phone_no,
            "nrc_no"            => $this->request->nrc_no,
            "address"           => $this->request->address,
            "description"       => $this->request->description,
            "created_emp"       => $this->request->login_id,
            "updated_emp"       => $this->request->login_id,

        ]);

        return ['status' => true, 'error' => ''];
    }
}
?>
