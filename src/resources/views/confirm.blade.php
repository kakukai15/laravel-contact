@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<main class="confirm-main">
  <h1 class="site-title">FashionablyLate</h1>
  <h2 class="confirm-title">Confirm</h2>

  <table class="confirm-table">
    <tbody>
      <tr>
        <th>お名前</th>
        <td>{{ ($contact['last_name'] ?? '') . ' ' . ($contact['first_name'] ?? '') }}</td>
      </tr>
      <tr>
        <th>性別</th>
        <td>
          @if(($contact['gender'] ?? '') === 'male') 男性
          @elseif(($contact['gender'] ?? '') === 'female') 女性
          @elseif(($contact['gender'] ?? '') === 'other') その他
          @else 未選択
          @endif
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $contact['email'] ?? '' }}</td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>{{ $contact['tel'] ?? '' }}</td>
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $contact['address'] ?? '' }}</td>
      </tr>
      <tr>
        <th>建物名</th>
        <td>{{ $contact['building'] ?? '' }}</td>
      </tr>
      <tr>
        <th>お問い合わせの種類</th>
        <td>{{ $contact['category_name'] ?? '未選択' }}</td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{!! nl2br(e($contact['message'] ?? '')) !!}</td>
      </tr>
    </tbody>
  </table>

<div class="form-buttons">
  <form action="{{ route('contacts.send') }}" method="POST" class="form-buttons">
    @csrf
    <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}">
    <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}">
    <input type="hidden" name="gender" value="{{ $contact['gender'] ?? '' }}">
    <input type="hidden" name="email" value="{{ $contact['email'] ?? '' }}">
    <input type="hidden" name="tel1" value="{{ $contact['tel1'] ?? '' }}">
    <input type="hidden" name="tel2" value="{{ $contact['tel2'] ?? '' }}">
    <input type="hidden" name="tel3" value="{{ $contact['tel3'] ?? '' }}">
    <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
    <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
    <input type="hidden" name="category_id" value="{{ $contact['category_id'] ?? '' }}">
    <input type="hidden" name="message" value="{{ $contact['message'] ?? '' }}">

    <button type="submit" class="btn-submit">送信</button>
  </form>

  <form action="{{ route('contacts.index') }}" method="GET" class="form-buttons">
    <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}">
    <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}">
    <input type="hidden" name="gender" value="{{ $contact['gender'] ?? '' }}">
    <input type="hidden" name="email" value="{{ $contact['email'] ?? '' }}">
    <input type="hidden" name="tel1" value="{{ $contact['tel1'] ?? '' }}">
    <input type="hidden" name="tel2" value="{{ $contact['tel2'] ?? '' }}">
    <input type="hidden" name="tel3" value="{{ $contact['tel3'] ?? '' }}">
    <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
    <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
    <input type="hidden" name="category_id" value="{{ $contact['category_id'] ?? '' }}">
    <input type="hidden" name="message" value="{{ $contact['message'] ?? '' }}">

    <button type="submit" class="btn-correct">修正</button>
  </form>
</div>
</main>
@endsection
