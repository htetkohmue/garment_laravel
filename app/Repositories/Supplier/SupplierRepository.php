<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;
use Illuminate\Support\Arr;
use App\Models\BankFileName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Interfaces\Supplier\SupplierRepositoryInterface;

/**
 *
 * @author  Hein Htet Ko
 * @create_date 2022-08-15
 */
class SupplierRepository implements SupplierRepositoryInterface
{

    /**
     * Get supplier data
     *
     * @author  Hein Htet Ko
     * @param
     * @return  array
     */
    public function getSupplierData()
    {
       return Supplier::all();
    }
}
