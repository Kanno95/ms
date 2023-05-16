<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Product extends Model {

    public function in($request){
        $file_name = $request->file('img_path');
    if (!empty($file_name)) {
        $file_name = $request->file('img_path')->getClientOriginalName();
        $request->file('img_path')->storeAs('public/images', $file_name);
        $company_name = $request -> input('company_name');
        $company_id = DB::table('companies') -> where('company_name', $company_name) -> value('id');
        DB::table('products')
        ->insert([
            'company_id' => $company_id,
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'comment' => $request->input('comment'),
            'img_path' => 'storage/images/' . $file_name
        ]);
    } else {
        $company_name = $request -> input('company_name');
        $company_id = DB::table('companies') -> where('company_name', $company_name) -> value('id');
        DB::table('products')
        ->insert([
            'company_id' => $company_id,
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'comment' => $request->input('comment'),
            ]);
    }
        $products_max_id = DB::table('products') -> max('id');
        DB::table('sales')
        ->insert([
            'product_id' => $products_max_id
        ]);
    }
}