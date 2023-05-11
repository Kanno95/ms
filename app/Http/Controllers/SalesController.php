<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller{

    public function add_record(){
        DB::beginTransaction();
        try {
            $model = new Sale();
            $model -> addition();
            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            error_log($e->getMessage());
            echo 'エラーが発生しました: ' . $e->getMessage();
        }
    }

    public function purchase(Request $request){
        DB::beginTransaction();
        try {
            $model = new Product();
            $model -> purchase($request);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            error_log($e->getMessage());
            echo 'エラーが発生しました: ' . $e->getMessage();
        }   
    }

}