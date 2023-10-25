<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("sizes")->truncate();
        DB::table("sizes")->insert(array(
            array(
                "size"      =>  "SS",
                "name"          =>  "Small Small",
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            ),
            array(
                "size"      =>  "S",
                "name"          =>  "Small",
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            ),
            array(
                "size"      =>  "M",
                "name"          =>  "Medium",
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            ),
            array(
                "size"      =>  "L",
                "name"          =>  "Large",
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            ),
            array(
                "size"      =>  "XL",
                "name"          =>  "Extra Large",
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            ),
            array(
                "size"      =>  "XXL",
                "name"          =>  "Two XL",
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            ),
            array(
                "size"      =>  "XXXL",
                "name"          =>  "Three XL",
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            ),
            array(
                "size"      =>  "XXXXL",
                "name"          =>  "Four XL",
                "created_emp"   =>  "1001",
                "updated_emp"   =>  "1001",
                "created_at"    =>  Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"    =>  Carbon::now()->format("Y-m-d H:i:s")
            )
        ));
    }
}
