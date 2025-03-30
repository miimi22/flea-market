@extends('layouts.app')

@section('title')
<title>メール認証誘導画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/verification.css') }}" />
@endsection

@section('content')
<div class="contents">
    <p class="message1">登録していただいたメールアドレスに認証メールを送付しました。</p>
    <p class="message2">メール認証を完了してください。</p>
    <a href="{{ route('verification.notice') }}" class="verification-button">認証はこちらから</a>
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="verification-mail-button">認証メールを再送する</button>
    </form>
</div>
@endsection