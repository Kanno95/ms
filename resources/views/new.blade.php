@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="{{ route('newdate') }}" enctype="multipart/form-data">
    @csrf
    <table>
        <thead>
            <tr>
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
                <td><input type="text" name="product_name" value="{{ old('product_name') }}"></td>
                <td>
                    <select name="company_name">
                    @foreach ($companies as $companies )
                        <option value="{{ $companies -> company_name }}">{{ $companies -> company_name }}</option>
                    @endforeach
                    </select>
                </td>
                <td><input type="text" name="price" value="{{ old('price') }}"></td>
                <td><input type="text" name="stock" value="{{  old('stock') }}"></td>
                <td><textarea name="comment"  cols="10" rows="1">{{ old('comment') }}</textarea></td>
                <td><input type="file" name="img_path"></td>
            </tr>
        </tbody>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    </table>
    <button type="submit">登録</button>
    </form>
    <button><a href="{{ route('back') }}">戻る</a></button>
</div>
@endsection


