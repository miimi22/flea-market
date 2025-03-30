@extends('layouts.app')

@section('title')
<title>商品一覧画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}" />
@endsection

@section('content')
<div class="contents">
    <div class="category">
        <a href="/?keyword={{ request('keyword') }}" class="recommendation" data-target="true">おすすめ</a>
        <a href="?tab=mylist&keyword={{ request('keyword') }}" class="mylist {{ request('tab') == 'mylist' ? 'active' : '' }}" data-target="true">マイリスト</a>
    </div>
    <div class="line"></div>
    <div class="products-container">
        <div class="products">
            @if (request('tab') == null)
                @foreach ($items as $item)
                <div class="product">
                    <a href="/item/{{$item->id}}" class="product_link"></a>
                    <img src="{{asset($item->product_image)}}" alt="商品画像" class="product_image" width="300" height="300">
                    <div class="product-list">
                        <p class="product_name">{{$item->product_name}}</p>
                        @if ($item->isSold())
                            <p class="sold-label">sold</p>
                        @endif
                    </div>
                </div>
                @endforeach
            @elseif (request('tab') == 'mylist' && Auth::check())
                @foreach ($items as $item)
                <div class="product">
                    <a href="/item/{{$item->id}}" class="product_link"></a>
                    <img src="{{asset($item->product_image)}}" alt="商品画像" class="product_image" width="300" height="300">
                    <div class="product-list">
                        <p class="product_name">{{$item->product_name}}</p>
                        @if ($item->isSold())
                            <p class="sold-label">sold</p>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const currentPageUrl = window.location.href;
    const links = document.querySelectorAll('a[data-target="true"]');
    links.forEach(link => {
    const linkUrl = link.href;
    if (currentPageUrl === linkUrl) {
        link.classList.add('current-page-link');
    }
    });
</script>
@endsection