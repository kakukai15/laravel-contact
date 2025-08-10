@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-heading">
  <h2>Register</h2>
</div>

<div class="register">
  <form action="/register" method="post" class="register__form">
    @csrf
    <div class="form-group">
      <label for="name">お名前</label>
      <input type="text" name="name" placeholder="例: 山田　太郎" value="{{ old('name') }}">
      @error('name')
      <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="email">メールアドレス</label>
      <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
      @error('email')
      <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="password">パスワード</label>
      <input type="password" name="password" placeholder="例: coachtech1106">
      @error('password')
      <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="register__button">登録</button>
  </form>
</div>
@endsection
