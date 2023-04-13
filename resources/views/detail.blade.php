@extends('layouts.app')

@section('content')
<div class="container">
    <table>
        <thead>
            <tr>
                <th>商品情報ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>メーカー</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>コメント</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sales as $sal )
            <tr>
                <td>{{ $sal -> id }}</td>
                <td><img src="{{ asset($sal -> img_path) }}" alt="{{$sal -> img_path}}"></td>
                <td>{{ $sal -> product_name }}</td>
                <td>{{ $sal -> company_name }}</td>
                <td>{{ $sal -> price }}</td>
                <td>{{ $sal -> stock }}</td>
                <td>{{ $sal -> comment }}</td>
                <td>
                    <form method="get" action="{{ route('sales.edit', $sal -> id) }}">
                    <button>編集</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button><a href="{{ route('back') }}">戻る</a></button>
</div>
@endsection