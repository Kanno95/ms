<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




class Sale extends Model{
    
    public function getList() {
        
        $sales = DB::table('companies')
        ->join('products', 'products.company_id', '=', 'companies.id')
        ->join('sales', 'sales.product_id', '=', 'products.id')
        ->get();

        return $sales;
    }

}