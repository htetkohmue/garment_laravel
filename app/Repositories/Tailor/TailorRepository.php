<?php

namespace App\Repositories\Tailor;

use App\Models\Tailor;
use Illuminate\Support\Arr;
use App\Models\BankFileName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Interfaces\Tailor\TailorRepositoryInterface;

/**
 *
 * @author  SoeZawHtet
 * @create_date 2021-07-28
 */
class TailorRepository implements TailorRepositoryInterface
{

    /**
     * Get tailor data
     *
     * @author  Htet Ko Hmue
     * @param
     * @return  array
     */
    public function getTailorData()
    {
       return Tailor::all();
    }
}
