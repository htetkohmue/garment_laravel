<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("admins")->truncate();
        DB::table("admins")->insert(array(
            array(
                "admin_id"      =>  "1001",
                "name"          =>  "U Mya",
                "password"      =>  12345,
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            ),
            array(
                "admin_id"      =>  "1002",
                "name"          =>  "U Hla",
                "password"      =>  12345,
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            )
        ));
    }
}
