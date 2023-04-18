<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(){
        return [
            'product_name' => 'required | string | max:255',
            'company_name' => 'required',
            'price' => 'required | integer | min:0',
            'stock' => 'required | integer | min:0',
        ];
    }
    public function attributes(){
    return [
        'product_name' => '商品名',
        'company_name' => 'メーカー名',
        'price' => '価格',
        'stock' => '在庫',
    ];
    }
    public function messages(){
    return [
        'product_name.required' => ':attributeは必須項目です。',
        'product_name.max' => ':attributeは255文字以内で入力してください。',
        'company_name.required' => ':attributeは必須項目です。',
        'price.required' => ':attributeは必須項目です。',
        'price.integer' => ':attributeは半角数字で入力してください。',
        'price.min' => ':attributeは0以上で入力してください。',
        'stock.required' => ':attribute数は必須項目です。',
        'stock.integer' => ':attribute数は半角数字で入力してください。',
        'stock.min' => ':attribute数は0以上で入力してください。',         
    ];
    }
}