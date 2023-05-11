<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




class Sale extends Model{

    public function getList(){
        $sales = DB::table('companies')
        ->join('products', 'products.company_id', '=', 'companies.id')
        ->join('sales', 'sales.product_id', '=', 'products.id')
        ->orderBy('sales.id', 'desc') 
        ->get();
        
        return $sales;
    }
    
    public function search($request){
        $keyword = $request->input('keyword');
        $key = $request->input('key');
        $price_upper = $request->input('price_upper');
        $price_lower = $request->input('price_lower');
        $stock_upper = $request->input('stock_upper');
        $stock_lower = $request->input('stock_lower');
        
        $sales = DB::table('companies')
        ->join('products', 'products.company_id', '=', 'companies.id')
        ->join('sales', 'sales.product_id', '=', 'products.id');
        if (empty($keyword)) {
            $sales = $sales->Where('companies.company_name', 'like', "%$key%");
        } elseif (empty($key)) {
            $sales = $sales->Where('products.product_name', 'like', "%$keyword%");
        } else {
            $sales = $sales->where('products.product_name', 'like', "%$keyword%")->orWhere('companies.company_name', 'like', "%$key%");
        }
        if (!empty($price_upper)) {
            $sales = $sales->where('products.price', '<=', $price_upper);
        }
        if (!empty($price_lower)) {
            $sales = $sales->where('products.price', '>=', $price_lower);
        }
        if (!empty($stock_upper)) {
            $sales = $sales->where('products.stock', '<=', $stock_upper);
        }
        if (!empty($stock_lower)) {
            $sales = $sales->where('products.stock', '>=', $stock_lower);
        }
        
        $sales = $sales ->orderBy('sales.id', 'desc') ->get();
        
        return $sales;
    }
    
    public function salesDetail($id) {
        $sales = DB::table('companies')
        ->join('products', 'products.company_id', '=', 'companies.id')
        ->join('sales', 'sales.product_id', '=', 'products.id')
        ->Where('sales.id', '=', $id)
        ->get();
        
        return $sales;
    }
    
    public function up($request, $id){
        $file_name = $request->file('img_path');
        if (!empty($file_name)) {
                $file_name = $request->file('img_path')->getClientOriginalName();
                $request->file('img_path')->storeAs('public/images', $file_name);
                
                $sales = DB::table('companies')
                ->join('products', 'products.company_id', '=', 'companies.id')
                ->join('sales', 'sales.product_id', '=', 'products.id')
                ->Where('sales.id', '=', $id)
                ->update([
                    'product_name' => $request->input('product_name'),
                    'company_name' => $request->input('company_name'),
                    'price' => $request->input('price'),
                    'stock' => $request->input('stock'),
                    'comment' => $request->input('comment'),
                    'img_path' => 'storage/images/' . $file_name
                ]);
            } else {
                $sales = DB::table('companies')
                ->join('products', 'products.company_id', '=', 'companies.id')
                ->join('sales', 'sales.product_id', '=', 'products.id')
                ->Where('sales.id', '=', $id)
                ->update([
                    'product_name' => $request->input('product_name'),
                    'company_name' => $request->input('company_name'),
                    'price' => $request->input('price'),
                    'stock' => $request->input('stock'),
                    'comment' => $request->input('comment'),
                ]);
            }
            return $sales;
    }

    public function addition(){
        DB::table('sales')->insert([
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}