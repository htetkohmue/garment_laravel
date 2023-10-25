<?php

namespace App\Interfaces\Customer;

interface CustomerRepositoryInterface
{
    /**
     * Display Customer data
     *
     * @author  Tin Nwe Aye
     * @create_date 2021-08-25
     */
    public function searchCustomer($request);
    /**
     *Edit Customer data
     *
     * @author  Tin Nwe Aye
     * @create_date 2021-08-25
     */
    public function editCustomer($id);
}