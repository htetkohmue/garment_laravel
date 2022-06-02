<?php
namespace App\Repositories\DBTransaction;

use App\Models\Tailor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SaveTailorData {
    //use LogTrait;
    private $request;
    //private $attendanceArray;
    public function __construct($request)
    {
        try {
            DB::beginTransaction();
            $this->request      = $request;
            Log:info($this->request);
            //$hashedPassword     = hash('sha512', $this->request->password);
            //Insert into admins table
            Tailor::insert([
                "tailorID"         => $this->request->tailor_id,
                "nameMM"           => $this->request->name_mm,
                "nameEN"           => $this->request->name_en,
                "phoneNO"          => $this->request->phone_no,
                "nrcNO"            => $this->request->nrc_no,
                "address"           => $this->request->address,
                "description"       => $this->request->description,
                "created_emp"       => $this->request->login_id,
                "updated_emp"       => $this->request->login_id,

            ]);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    // public function process()
    // {

    // }
}
?>
