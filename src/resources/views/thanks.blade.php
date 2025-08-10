@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/thanks.css') }}">

@section('content')
<main>
  <h2>お問い合わせありがとうございました</h2>
  <form action="{{ route('contacts.index') }}" method="GET">
    <button type="submit">HOME</button>
  </form>
</main>
@endsection
