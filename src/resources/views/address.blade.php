@extends('layouts.app')

@section('title')
<title>送付先住所変更画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}" />
@endsection

@section('content')
<div class="contents">
    <h1>住所の変更</h1>
    <form action="/purchase/address/{{$item->id}}" method="post">
    @csrf
        <label for="sending_code" class="label">郵便番号</label>
        <input id="sending_code" type="text" name="sending_code" class="text" value="{{ old('sending_code', $profile ? $profile->post_code : '') }}">
        @error('sending_code')
            <span class="input_error">
                <p class="input_error_message">{{$errors->first('sending_code')}}</p>
            </span>
        @enderror
        <label for="sending_address" class="label">住所</label>
        <input id="sending_address" type="text" name="sending_address" class="text" value="{{ old('sending_address', $profile ? $profile->address : '') }}">
        @error('sending_address')
            <span class="input_error">
                <p class="input_error_message">{{$errors->first('sending_address')}}</p>
            </span>
        @enderror
        <label for="sending_building" class="label">建物名</label>
        <input id="sending_building" type="text" name="sending_building" class="text" value="{{ old('sending_building', $profile ? $profile->building : '') }}">
        <div class="button-content">
            <button class="button-update" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection