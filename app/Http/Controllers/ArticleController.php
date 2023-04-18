<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller{
    //home
    public function showList(){
        $model = new Sale();
        $sales = $model->getList();
        
        return view('home',['sales' => $sales]);   
    }
    //home
    public function destroy($id){
        DB::beginTransaction();
        
        try {
            $article = Sale::find($id);
            $article->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        
        return redirect()->route('home');
    }
    //home
    public function search(Request $request){
        $model = new Sale();
        $sales = $model->search($request);
        
        return view('/home', compact('sales'));
    }
    //home
    public function salesDetail($id){
        $model = new Sale();
        $sales = $model->salesDetail($id);
        
        return view('/detail', compact('sales'));
    }
    //home
    public function new() {
        $model = new Company();
        $companies = $model -> getList();  
        
        return view('new', compact('companies'));   
    }
    //detail
    public function salesEdit($id){
        $sales_model = new Sale();
        $companies_model = new Company();
        $sales = $sales_model -> salesDetail($id);
        $companies = $companies_model -> getList(); 
        
        return view('/edit', compact('sales', 'companies' ));
    }
    //edit
    public function update(ArticleRequest $request, $id) {
        DB::beginTransaction();

        try {
            $sales_model = new Sale();
            $companies_model = new Company();
            $sales = $sales_model -> up($request, $id);
            $sales = $sales_model -> salesDetail($id);
            $companies = $companies_model -> getList(); 
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        
        return view('/edit', compact('sales', 'companies'));
    }
    //new
    public function insert(ArticleRequest $request) {
        DB::beginTransaction();

        try {
            $product_model = new Product();
            $companies_model = new Company();
            $product = $product_model -> in($request);
            $companies = $companies_model -> getList(); 
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        
        return view('/new', compact('companies')); 
    }
}