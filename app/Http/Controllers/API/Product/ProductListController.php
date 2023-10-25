<?php

namespace App\Http\Controllers\API\Product;

use App\Models\Tailor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Interfaces\Tailor\TailorRepositoryInterface;
use App\Interfaces\Product\ProductRepositoryInterface;

class ProductListController extends Controller
{
    protected $tailorRepo,$productRepo;
    public function __construct(TailorRepositoryInterface $tailorRepo
                               ,ProductRepositoryInterface $productRepo
                                )
    {
        $this->tailorRepo = $tailorRepo;
        $this->productRepo = $productRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchTailor()
    {
       $data = $this->tailorRepo->getTailorData();
       return   $data->pluck('tailor_id');
    }

    public function searchTailorByID(Request $request)
    {
       $data = $this->tailorRepo->getTailorData();
       $TailorData = $data->where('tailor_id',$request->tailor_id);
       return  $TailorData->pluck('name_en');
    }
    
    public function search(Request $request)
    {
        try{
            $datas = $this->productRepo->searchData($request);
            $i = 0 ;
            if(count($datas) > 0){
                $results = [];
                $language = $request->language;
                $DataByEmp = $datas->mapToGroups(function ($item, $key) {
                    return [$item['tailor_id'] => $item];
                    });
                    $DataByEmp = $DataByEmp->all();
            
                foreach ($DataByEmp as $key => $values) 
                { 
                    $DataByDate =$values->mapToGroups(function ($items, $key) {
                        return [$items['date'] => $items];
                    });

                    foreach ($DataByDate as $key => $val) {
                        $item[$i]['Date'] =  $key;
                        $item[$i]['tailorId'] =  $val['0']['tailor_id'];
                        $item[$i]['name'] =  ($language == 'en') ? $val['0']['name_en'] : $val['0']['name_mm'];
                        $item[$i]['totalQty'] = $val->sum('qty');
                        $item[$i]['totalAmt'] = $val->sum('totalAmount');
                        $item[$i]['allData'] = $val;
                        $i++;
                    }    
                }
                
                return response()->json([
                    'status' =>  'OK',
                    'row_count'=>count($item),
                    'data'   =>   $item,
                ],200);
            } else {
                return response()->json([
                    'status' =>  'NG',
                    'message' =>  trans('errorMessage.ER009'),
                ],200);
            }
        } catch (\Throwable $th) {
            log::debug($th);
            return response()->json([
                'status' =>  'NG',
                'message' =>  trans('errorMessage.ER005'),
            ],200);
        }
    }
}
