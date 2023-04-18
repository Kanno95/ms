<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Company extends Model
{
    public function getList(){
        $companies = DB::table('companies') 
        ->get();

        return $companies;
    }
    public function in($request){
        $company_name = $request -> input('company_name');
        $company_id = DB::table('companies') -> where('company_name', $company_name) -> value('id');
        
        return $company_id;
    }
}