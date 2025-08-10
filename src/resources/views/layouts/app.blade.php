<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
  <div class="header__inner">
    <div class="header-utilities">
      <a class="header__logo" href="/">FashionablyLate</a>
      <nav class="header__nav">
      @if(request()->routeIs('login'))
        <a class="header__register" href="{{ route('register') }}">register</a>
      @elseif(request()->routeIs('admin.*'))
      <form method="POST" action="{{ route('logout') }}">
      @csrf
        <button type="submit" class="header__logout">logout</button>
      </form>
      @elseif(!request()->routeIs('contacts.index')
        && !request()->routeIs('contacts.confirm')
        && !request()->routeIs('contacts.thanks'))
        <a class="header__login" href="{{ route('login') }}">login</a>
      @endif
      </nav>

    </div>
  </div>
</header>

  <main>
    @yield('content')
  </main>

   
</body>

</html>