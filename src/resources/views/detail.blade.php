@extends('layouts.app')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
<title>商品詳細画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
<div class="product-detail">
    <div class="product-image-area">
        <img src="{{asset($item->product_image)}}" alt="商品画像" class="product-image">
    </div>
    <div class="product-description-area">
        <div class="product-title">
            <h1 class="product-name">{{$item->product_name}}</h1>
            <p class="brand-name">{{$item->brand_name}}</p>
            <span class="yen">¥</span><span class="product-price">{{number_format($item->product_price)}}</span><span class="tax-included">(税込)</span>
            <div class="product-actions">
                <form id="likeForm">
                    <div class="like-container">
                        <button class="like-button {{ $isLiked ? 'liked' : '' }}" id="likeButton" type="button"><img src="{{asset('images/star.png')}}" alt="いいね" class="star"></button>
                        <div class="like-count" id="likeCount">{{ $item->likes->count() }}</div>
                    </div>
                </form>
                <div class="comment-container">
                    <img src="{{asset('images/comment.png')}}" alt="コメント" class="comment">
                    <div class="comment-count" id="commentCount">{{$item->comments->count()}}</div>
                </div>
            </div>
        </div>
        <div class="purchase-area">
            <a href="/purchase/{{$item->id}}" class="purchase-button">購入手続きへ</a>
        </div>
        <div class="product-description">
            <h2 class="product-description-title">商品説明</h2>
            <p class="description">{{$item->product_description}}</p>
        </div>
        <div class="product-info">
            <h2 class="product-info-title">商品の情報</h2>
            <span class="category-info">カテゴリー</span>
            @foreach ($item->itemcategories as $category)
            <span class="category-info-text">{{$category->category->category}}</span>
            @endforeach
            <br>
            <span class="product-condition">商品の状態</span>
            <span class="product-condition-text">{{$item->condition->content}}</span>
        </div>
        <div class="product-comments">
            <h2 class="product-comments-title">コメント({{$item->comments->count()}})</h2>
            <div class="comments-list">
                @foreach ($item->comments as $comment)
                    <img src="{{ $comment->user->profile && $comment->user->profile->profile_image ? asset($comment->user->profile->profile_image) : asset('images/default.png') }}" alt="画像" class="comments-image" width="50" height="50">
                    <span class="name">{{$comment->user->name}}</span>
                    <div class="comments-text">
                        <span class="comments">{{$comment->comment}}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="comment-input">
            <h3 class="comment-input-title">商品へのコメント</h3>
            <form action="{{url('/item/' . $item->id . '/comments')}}" method="post">
                @csrf
                <div class="comment-area">
                    <textarea name="comment" id="commentsForm" class="comments-form"></textarea>
                </div>
                @error('comment')
                    <span class="textarea_error">
                        <p class="textarea_error_message">{{$errors->first('comment')}}</p>
                    </span>
                @enderror
                <div class="comments-button">
                    <button class="comments-button-submit" type="submit">コメントを送信する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const likeButton = document.getElementById('likeButton');
        const likeCountElement = document.getElementById('likeCount');
        const itemId = {{ $item->id }};

        likeButton.addEventListener('click', function () {
            fetch(`/like/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                likeCountElement.textContent = data.likeCount;
                if (data.liked) {
                    likeButton.classList.add('liked');
                } else {
                    likeButton.classList.remove('liked');
                }
            });
        });
    });
</script>
@endsection

@section('style')
<style>
    .like-button.liked {
    background-color: yellow;
}
</style>
@endsection