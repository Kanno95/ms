@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
                <div class="list">
                    <table>
                        <thead>
                            <tr>
                                <th class="sortable_id"><input type="button" value="ID"></th>
                                <th class="sortable_img"><input type="button" value="商品画像"></th>
                                <th class="sortable_product_name"><input type="button" value="商品名"></th>
                                <th class="sortable_price"><input type="button" value="価格"></th>
                                <th class="sortable_stock"><input type="button" value="在庫数"></th>
                                <th class="sortable_company_name"><input type="button" value="メーカー名"></th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                        @foreach ($sales as $sale)
                            <tr class="tbody_list">
                                <td class="tbody_list_item">{{ $sale -> id }}</td>
                                <td class="tbody_list_item"><img src="{{ asset($sale -> img_path) }}" alt="{{ $sale -> img_path }}"></td>
                                <td class="tbody_list_item">{{ $sale -> product_name }}</td>
                                <td class="tbody_list_item">{{ $sale -> price }}</td>
                                <td class="tbody_list_item">{{ $sale -> stock }}</td>
                                <td class="tbody_list_item">{{ $sale -> company_name }}</td>
                                <td class="tbody_list_item">
                                    <form method="get" action="{{ route('sales.detail', $sale -> id) }}">
                                        <button type="submit" >詳細</button>
                                    </form>
                                </td>
                                <td class="tbody_list_item">
                                    <input data-user_id="{{ $sale -> id }}" class="list_btn" type="submit" value="削除">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form>
                        <div>
                            <h2>検索フォーム⬇︎</h2>
                        </div>
                        <div>
                            <span>商品名</span>
                            <input class="search-form_input" type="text" name="keyword" placeholder="商品名を入力">
                        </div>
                        <div>
                            <span>メーカー名</span>
                            <select class="search-form_select" name="key">
                                <option value="">すべて</option>
                                @foreach ($sales as $sale)
                                    <option value="{{ $sale->company_name }}">{{ $sale->company_name }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div>
                            <span>価格</span>
                            <input class="search-form_price_lower" type="text" placeholder="下限値を入力" name="price_lower">
                            <input class="search-form_price_upper" type="text" placeholder="上限値を入力" name="price_upper">
                        </div>
                        <div>
                            <span>在庫数</span>
                            <input class="search-form_stock_lower" type="text" placeholder="下限値を入力" name="stock_lower">
                            <input class="search-form_stock_upper" type="text" placeholder="上限値を入力" name="stock_upper">
                        </div>
                        <button class="search-form_button" type="button">検索</button>
                    </form>
                    <div>
                        <button><a href="{{ route('new') }}">新規登録</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/main.js') }}"></script>
@endsection
