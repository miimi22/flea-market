@extends('layouts.app')

@section('title')
<title>プロフィール編集画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('content')
<div class="contents">
    <h1>プロフィール設定</h1>
    <form action="/mypage/profile/update" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="avatar-image">
            <img class="c-avatar__image" id="preview" src="{{ $profile && $profile->profile_image ? asset($profile->profile_image) : asset('images/default.png') }}" width="100" height="100">
        @error('profile_image')
            <span class="input_error">
                <p class="input_error_message">{{$errors->first('profile_image')}}</p>
            </span>
        @enderror
            <label class="image-button-label">
                画像を選択する
                <input type="file" class="image-button" id="imageUpload" name="profile_image">
            </label>
        </div>
        <label for="name" class="label">ユーザー名</label>
        <input id="name" type="text" name="name" class="text" placeholder="{{ $profile && $user->name ? $user->name : '' }}" value="{{ old('name', $user ? $user->name : '') }}">
        @error('name')
            <span class="input_error">
                <p class="input_error_message">{{$errors->first('name')}}</p>
            </span>
        @enderror
        <label for="post_code" class="label">郵便番号</label>
        <input id="post_code" type="text" name="post_code" class="text" placeholder="{{ $profile && $profile->post_code ? $profile->post_code : '' }}" value="{{ old('post_code', $profile ? $profile->post_code : '') }}">
        @error('post_code')
            <span class="input_error">
                <p class="input_error_message">{{$errors->first('post_code')}}</p>
            </span>
        @enderror
        <label for="address" class="label">住所</label>
        <input id="address" type="text" name="address" class="text" placeholder="{{ $profile && $profile->address ? $profile->address : '' }}" value="{{ old('address', $profile ? $profile->address : '') }}">
        @error('address')
            <span class="input_error">
                <p class="input_error_message">{{$errors->first('address')}}</p>
            </span>
        @enderror
        <label for="building" class="label">建物名</label>
        <input id="building" type="text" name="building" class="text" placeholder="{{ $profile && $profile->building ? $profile->building : '' }}" value="{{ old('building', $profile ? $profile->building : '') }}">
        <div class="button-content">
            <button class="button-update" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $('#imageUpload').on('change', function (e) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $("#preview").attr('src', e.target.result)
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection