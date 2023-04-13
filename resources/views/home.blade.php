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
                                <th>ID</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>メーカー名</th>
                                <th>詳細情報</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale -> id }}</td>
                                <td><img src="{{ asset($sale -> img_path) }}" alt="{{$sale -> img_path}}"></td>
                                <td>{{ $sale -> product_name }}</td>
                                <td>{{ $sale -> price }}</td>
                                <td>{{ $sale -> stock }}</td>
                                <td>{{ $sale -> company_name }}</td>
                                <td>
                                    <form method="get" action="{{ route('sales.detail', $sale -> id) }}">
                                        <button type="submit" >詳細</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('sales.destroy', $sale -> id) }}">
                                        @csrf
                                        <button class="list_btn" type="submit" class="btn btn-danger">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form method="GET" action="{{ route('search') }}">
                    <span>商品名</span>
                    <input type="text" name="keyword">
                    <span>メーカー名</span>
                        <select name="key">
                            <option value="">すべて</option>
                            @foreach ($sales as $sale)
                            <option value="{{ $sale->company_name }}">{{ $sale->company_name }}</option>
                            @endforeach 
                        </select>
                    <button type="submit">検索</button>
                    </form>
                    <button><a href="{{ route('new') }}">新規登録</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/main.js') }}"></script>
@endsection
