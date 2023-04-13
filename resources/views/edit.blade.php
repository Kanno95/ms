@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($sales as $sa )
    <form method="post" action="{{ route('update', $sa -> id) }}" enctype="multipart/form-data">
    @csrf
    <table>
        <thead>
            <tr>
                <th>商品情報ID</th>
                <th>商品名</th>
                <th>メーカー</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>コメント</th>
                <th>商品画像</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $sa -> id }}</td>
                <td><input type="text" name="product_name" value="{{ $sa -> product_name }}"></td>
                <td>
                    <select name="company_name">
                        <option value="{{ $sa -> company_name }}" selected>{{ $sa -> company_name }}</option>
                    @foreach ($companies as $companies )
                        <option value="{{ $companies -> company_name }}">{{ $companies -> company_name }}</option>
                    @endforeach
                    </select>
                </td>
                <td><input type="text" name="price" value="{{ $sa -> price }}"></td>
                <td><input type="text" name="stock" value="{{ $sa -> stock }}"></td>
                <td><textarea name="comment"  cols="10" rows="1">{{ $sa -> comment }}</textarea></td>
                <td><input type="file" name="img_path"></td>
            </tr>
        @endforeach
        </tbody>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    </table>
    <button type="submit">更新</button>
    </form>
    <form method="get" action="{{ route('detail.back', $sa -> id) }}">
    <button>戻る</button>
    </form>
</div>
@endsection