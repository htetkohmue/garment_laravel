<?php

namespace App\DBTransactions;

use App\Classes\Transaction;

/**
 * Write action of class
 *
 * @author  PhyoNaing Htun
 * @create  2022/07/19
 */
class DeleteDepartment extends Transaction
{

    /**
     * Constructor to assign to variable
     */
    public function __construct()
    {
        //
    }

    /**
	 * Write detail of method
     *
     * @author  PhyoNaing Htun
     * @create  2022/07/19
     * @return  array
	 */
    public function process()
    {
        return ['status' => true, 'error' => ''];
    }
}
