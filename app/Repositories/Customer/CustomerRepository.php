<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Interfaces\Customer\CustomerRepositoryInterface;

/**
 * Customer repository
 *
 * @author  Tin Nwe Aye
 * @create  2022/07/19
 */
class CustomerRepository implements CustomerRepositoryInterface
{  
    public function searchCustomer($request)
    {
        $allCustomer = Customer::leftjoin('townships','customers.township_id','townships.id')->select('customers.*','townships.name')->get();
        
        return $allCustomer;
    }

    public function editCustomer($id){
        $editCustomer = Customer::where('id',$id)->first();
        
        return $editCustomer;
    }
}
