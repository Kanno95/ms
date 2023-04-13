<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller{
    
    public function showList(){
        $model = new Sale();
        $sales = $model->getList();
        
        return view('home',['sales' => $sales]);   
    }
    
    public function destroy($id){
        $article = Sale::find($id);
        
        $article->delete();
        
        return redirect()->route('home');
    }

    public function search(Request $request){
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
        return view('/home', compact('sales'));
    }
    
    public function detail(){
        return view('detail');   
    }

    public function salesDetail($id){
        $sales = DB::table('companies')
        ->join('products', 'products.company_id', '=', 'companies.id')
        ->join('sales', 'sales.product_id', '=', 'products.id')
        ->Where('sales.id', '=', $id)
        ->get();
        return view('/detail', compact('sales'));
    }

    public function edit() {
        return view('edit');   
    }

    public function salesEdit($id){
        $sales = DB::table('companies')
        ->join('products', 'products.company_id', '=', 'companies.id')
        ->join('sales', 'sales.product_id', '=', 'products.id')
        ->Where('sales.id', '=', $id)
        ->get();
        $companies = DB::table('companies') -> get();
        
        return view('/edit', compact('sales', 'companies' ));
    }

    public function update(Request $request, $id) {
        $rules = [
            'product_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0']
        ];
        $messages = [
            'product_name.required' => '商品名は必須項目です。',
            'product_name.max' => '商品名は255文字以内で入力してください。',
            'company_name.required' => 'メーカー名は必須項目です。',
            'price.required' => '価格は必須項目です。',
            'price.integer' => '価格は半角数字で入力してください。',
            'price.min' => '価格は0以上で入力してください。',
            'stock.required' => '在庫数は必須項目です。',
            'stock.integer' => '在庫数は半角数字で入力してください。',
            'stock.min' => 'ストックは0以上で入力してください。',            
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // バリデーションを通過した場合の処理
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
        $sales = DB::table('companies')
        ->join('products', 'products.company_id', '=', 'companies.id')
        ->join('sales', 'sales.product_id', '=', 'products.id')
        ->Where('sales.id', '=', $id)
            ->get();        
        $companies = DB::table('companies')->get();
            
        return view('/edit', compact('sales', 'companies'));
    }

    public function new() {
        $companies = DB::table('companies') -> get();
        return view('new', compact('companies'));   
    }

    public function insert(Request $request) {
        $rules = [
            'product_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0']
        ];
        $messages = [
            'product_name.required' => '商品名は必須項目です。',
            'product_name.max' => '商品名は255文字以内で入力してください。',
            'company_name.required' => 'メーカー名は必須項目です。',
            'price.required' => '価格は必須項目です。',
            'price.integer' => '価格は半角数字で入力してください。',
            'price.min' => '価格は0以上で入力してください。',
            'stock.required' => '在庫数は必須項目です。',
            'stock.integer' => '在庫数は半角数字で入力してください。',
            'stock.min' => 'ストックは0以上で入力してください。',            
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // バリデーションを通過した場合の処理
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
        $products_max_id = DB::table('products') -> max('id');
        DB::table('sales')
        ->insert([
            'product_id' => $products_max_id
        ]);
        
        $companies = DB::table('companies')->get();
        
        return view('/new', compact('companies')); 
    }
}