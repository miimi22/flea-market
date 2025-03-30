@extends('layouts.app')

@section('title')
<title>商品出品画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}" />
@endsection

@section('content')
<div class="contents">
    <h1 class="sell-title">商品の出品</h1>
    <form action="/sell" method="post" enctype="multipart/form-data">
        @csrf
        <div class="sell-products-image">
            <h3 class="sell-products-image-title">商品画像</h3>
            <div class="sell-products-image-form">
                <div id="preview" class="preview-image">
                    <label class="image-button-label">
                        画像を選択する
                        <input type="file" name="product_image" class="image-button" accept="image/*" id="inputElm">
                    </label>
                </div>
            </div>
            @error('product_image')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('product_image')}}</p>
                </span>
            @enderror
        </div>
        <div class="sell-product-detail-area">
            <h2 class="sell-product-product-detail">商品の詳細</h2>
            <div class="border"></div>
            <div class="sell-product-category-area">
                <h3 class="category-title">カテゴリー</h3>
                <div class="product-category-items">
                    @foreach ($categories as $category)
                    <input type="checkbox" name="category" class="product-category-item" id="category-{{$category->id}}" value="{{$category->id}}"><label for="category-{{$category->id}}">{{$category->category}}</label>
                    @endforeach
                </div>
                @error('product_category')
                    <span class="input_error">
                        <p class="input_error_message">{{$errors->first('product_category')}}</p>
                    </span>
                @enderror
            </div>
            <div class="sell-product-status">
                <h3 class="status-title">商品の状態</h3>
                <div class="select-inner">
                    <select name="content" id="" class="status-select">
                        <option disabled selected style="display:none;">選択してください</option>
                        @foreach ($conditions as $condition)
                        <option value="{{$condition->id}}">{{$condition->content}}</option>
                        @endforeach
                    </select>
                </div>
                @error('status')
                    <span class="select_error">
                        <p class="select_error_message">{{$errors->first('status')}}</p>
                    </span>
                @enderror
            </div>
        </div>
        <div class="product-name-explanation">
            <h2 class="product-name-explanation-title">商品名と説明</h2>
            <div class="border"></div>
            <div class="product-name-area">
                <h3 class="product-name-title">商品名</h3>
                <input type="text" name="product_name" class="product-name">
                @error('product_name')
                    <span class="input_error">
                        <p class="input_error_message">{{$errors->first('product_name')}}</p>
                    </span>
                @enderror
            </div>
            <div class="brand-name-area">
                <h3 class="brand-name-title">ブランド名</h3>
                <input type="text" name="brand_name" class="brand-name">
            </div>
            <div class="product-explanation-area">
                <h3 class="product-explanation-title">商品の説明</h3>
                <textarea name="product_description" id="" class="product-explanation"></textarea>
                @error('product_explanation')
                    <span class="textarea_error">
                        <p class="textarea_error_message">{{$errors->first('product_explanation')}}</p>
                    </span>
                @enderror
            </div>
            <div class="product-price-area">
                <h3 class="product-price-title">販売価格</h3>
                <input type="text" name="product_price" class="product-price" placeholder="¥">
                @error('product_price')
                    <span class="input_error">
                        <p class="input_error_message">{{$errors->first('product_price')}}</p>
                    </span>
                @enderror
            </div>
        </div>
        <div class="sell-button-area">
            <button class="sell-button-submit" type="submit">出品する</button>
        </div>
    </form>
</div>
@endsection