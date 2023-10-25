<?php

namespace App\Repositories\Product;

use App\Models\Tailor;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Product\ProductRepositoryInterface;

/**
 * Product repository
 *
 * @author  PhyoNaing Htun
 * @create  2022/07/19
 */
class ProductRepository implements ProductRepositoryInterface
{   
  
    public function searchData($request)
    {
        $start = $request['start_date'];
        $end = $request['end_date'];
       //DB::enableQueryLog();
        $ProductData = Tailor::join('product_in','product_in.tailor_id','tailors.tailor_id')
                            ->join('products','product_in.product_id','products.id')
                            ->leftjoin('sizes','product_in.size_id','sizes.id') 
                            ->whereBetween('date', [$start,$end])
                            ->when((!empty($request['tailor_id'])), function ($query) use ($request) {
                                $query->where('product_in.tailor_id', $request['tailor_id']);
                            })
                            ->when((!empty($request['tailor_name'])), function ($query) use ($request) {
                                $query->where('tailors.name_mm', $request['tailor_name'])
                                    ->orwhere('tailors.name_en', $request['tailor_name']);
                            })
                            ->whereNull('product_in.deleted_at')
                            ->whereNull('products.deleted_at')
                            ->select('product_in.id','tailors.tailor_id','name_mm','name_en','products.product_name as productName','sizes.size',
                            'product_in.date','product_in.tailor_id','product_in.product_id','product_in.size_id','product_in.qty',
                            'product_in.price','product_in.total_amount as totalAmount')
                            ->orderBy('product_in.date','ASC')
                            ->orderBy('product_in.tailor_id','ASC')
                            ->get();
        //dd(DB::getQueryLog());
        return  $ProductData;
    }
}
