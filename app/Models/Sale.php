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
        ->get();
        
        return $sales;
    }
    
    public function search($request){
        $keyword = $request->input('keyword');
        $key = $request->input('key');
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
        $sales = $sales->get();
        
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
}