<?php
namespace App\Repositories\DBTransaction;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
//use Brycen\Libraries\StandardLibraries\DBaccessUtil;

class SaveAdminData {
    //use LogTrait;
    private $request;
    //private $attendanceArray;
    public function __construct($request)
    {
        try {
            DB::beginTransaction();
            $this->request      = $request;
            $hashedPassword     = hash('sha512', $this->request->password);
            //Insert into admins table
            Admin::insert([
                "admin_code"        => $this->request->admin_code,
                "admin_name"        => $this->request->admin_name,
                "password"          => $hashedPassword,

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
