@extends('layouts.app')

@section('title')
<title>プロフィール画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
@endsection

@section('content')
<div class="contents">
    <div class="user-content">
        <img class="image" src="{{ $profile->profile_image ? asset($profile->profile_image) : asset('images/default.png') }}" width="100" height="100">
        <h1>{{$user->name}}</h1>
        <a href="/mypage/profile" class="edit-link">プロフィールを編集</a>
    </div>
    <div class="category">
        <a href="?tab=sell" class="sell {{ request('tab') == 'sell' ? 'active' : '' }}" data-target="true">出品した商品</a>
        <a href="?tab=buy" class="purchase {{ request('tab') == 'buy' ? 'active' : '' }}" data-target="true">購入した商品</a>
        <a href="?tab=trading" class="trading {{ request('tab') == 'trading' ? 'active' : '' }}" data-target="true">
            取引中の商品
            @if (isset($trading_message_count) && $trading_message_count > 0)
                <span class="badge">{{ $trading_message_count }}</span>
            @endif
        </a>
    </div>
    <div class="line"></div>
    <div class="merchandises-container">
        <div class="merchandises">
            @if (request('tab') == 'sell' || request('tab') == null)
                @foreach ($items as $item)
                    <div class="merchandise">
                        <a href="/item/{{$item->id}}" class="merchandise-link"></a>
                        <img src="{{asset($item->product_image)}}" alt="商品画像" class="merchandise-image" width="300" height="300">
                        <p class="merchandise-name">{{$item->product_name}}</p>
                    </div>
                @endforeach
            @elseif (request('tab') == 'buy')
                @foreach ($payments as $payment)
                    <div class="merchandise">
                        <a href="/item/{{$payment->item->id}}" class="merchandise-link"></a>
                        <img src="{{asset($payment->item->product_image)}}" alt="商品画像" class="merchandise-image" width="300" height="300">
                        <p class="merchandise-name">{{$payment->item->product_name}}</p>
                    </div>
                @endforeach
            @elseif (request('tab') == 'trading')
                @if (isset($trading_items) && $trading_items->count() > 0)
                    @foreach ($trading_items as $item)
                        <div class="merchandise">
                            @if($item->unread_messages_count > 0)
                                <span class="item-badge">{{ $item->unread_messages_count }}</span>
                            @endif
                            <a href="{{ route('trading.show', ['item_id' => $item->id]) }}" class="merchandise-link"></a>
                            <img src="{{asset($item->product_image)}}" alt="商品画像" class="merchandise-image" width="300" height="300">
                            <p class="merchandise-name">{{$item->product_name}}</p>
                        </div>
                    @endforeach
                @else
                    <p>取引中の商品はありません。</p>
                @endif
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