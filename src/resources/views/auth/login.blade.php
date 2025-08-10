@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-heading">
  <h2>Login</h2>
</div>

<div class="login">
  <form action="/login" method="post" class="register__form">
    @csrf
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

    <button type="submit" class="login__button">ログイン </button>
  </form>
</div>
@endsection
