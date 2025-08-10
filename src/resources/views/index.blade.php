@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<main>
  <h2>Contact</h2>

  <form action="{{ route('contacts.confirm') }}" method="POST" class="contact-form">
    @csrf

    <div class="form-row name-row">
      <label>お名前<span class="required">※</span></label>
      <div class="input-wrap">
        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name', request('last_name', '')) }}">
        @error('last_name')<div class="error">{{ $message }}</div>@enderror

        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name', request('first_name', '')) }}">
        @error('first_name')<div class="error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row gender-row">
      <label>性別<span class="required">※</span></label>
      <div class="input-wrap gender-inputs">
        <label><input type="radio" name="gender" value="male" {{ old('gender', request('gender', 'male')) == 'male' ? 'checked' : '' }}> 男性</label>
        <label><input type="radio" name="gender" value="female" {{ old('gender', request('gender')) == 'female' ? 'checked' : '' }}> 女性</label>
        <label><input type="radio" name="gender" value="other" {{ old('gender', request('gender')) == 'other' ? 'checked' : '' }}> その他</label>
        @error('gender')<div class="error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row email-row">
      <label>メールアドレス<span class="required">※</span></label>
      <div class="input-wrap">
        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email', request('email', '')) }}">
        @error('email')<div class="error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row phone-row">
      <label>電話番号<span class="required">※</span></label>
      <div class="input-wrap phone-inputs">
        <input type="tel" name="tel1" maxlength="4" placeholder="080" value="{{ old('tel1', request('tel1', '')) }}"> ー
        <input type="tel" name="tel2" maxlength="4" placeholder="1234" value="{{ old('tel2', request('tel2', '')) }}"> ー
        <input type="tel" name="tel3" maxlength="4" placeholder="5678" value="{{ old('tel3', request('tel3', '')) }}">
        @error('tel1')<div class="error">{{ $message }}</div>@enderror
        @error('tel2')<div class="error">{{ $message }}</div>@enderror
        @error('tel3')<div class="error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row address-row">
      <label>住所<span class="required">※</span></label>
      <div class="input-wrap">
        <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', request('address', '')) }}">
        @error('address')<div class="error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row building-row">
      <label>建物名</label>
      <div class="input-wrap">
        <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building', request('building', '')) }}">
      </div>
    </div>

    <div class="form-row category-row">
      <label>お問い合わせの種類<span class="required">※</span></label>
      <div class="input-wrap">
        <select name="category_id">
          <option value="">選択してください</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        @error('category_id')<div class="error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row message-row">
      <label>お問い合わせ内容<span class="required">※</span></label>
      <div class="input-wrap">
        <textarea name="message" placeholder="お問い合わせ内容をご記載ください" maxlength="120">{{ old('message', request('message', '')) }}</textarea>
        @error('message')<div class="error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row submit-row">
      <button type="submit">確認画面</button>
    </div>

  </form>
</main>
@endsection
