<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Social Gamer App</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/flat-ui.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/fonts/font-awsome/css/font-awesome.css" rel="stylesheet">

    <!-- Scripts -->
    <script> window.Laravel = '<?php echo json_encode(['csrfToken' => csrf_token(),]); ?>'</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-embossed navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        Social Gamer App
                        {{--{{ config('app.name', 'Social Gamer App') }}--}}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <form action="{{ url('/search') }}" method="GET" class="navbar-form pull-left">
                        <div class="input-group">
                            <input class="form-control" type="text" name="s" placeholder="Szukaj...">
                            <span class="input-group-btn">
                                <button type="send" class="btn btn-default">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Zaloguj</a></li>
                            <li><a href="{{ url('/register') }}">Zarejestruj</a></li>
                        @else
                            <li><a href="{{ url('/home') }}">Strona główna</a></li>
                            <li>
                                <a href="{{ url('/users/' . Auth::user()->id) }}">
                                    <img style="margin-right: 5px" src="{{ url('user-avatar/' . Auth::user()->id . '/20') }}" alt="" class="img-responsive pull-left">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                     <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/users/' . Auth::user()->id . '/edit') }}">Edytuj profil</a></li>
                                    <li><a href="{{ url('/users/' . Auth::user()->id . '/friends') }}">Lista Znajomych</a></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Wyloguj
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
