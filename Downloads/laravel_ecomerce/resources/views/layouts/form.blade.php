<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lilita+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
        <title>VegFood</title>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="utf8">
        <!--Menu-->

            <nav class='menu-c' id='menu'>
                <div class="nav-wrapper">
                    <a href="{{ url('/') }}" class="brand-logo">VegFood</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="/categorias">Produtos</a></li>
                        @guest
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}">Cadastro</a>
                                </li>
                            @endif
                        @else
                            <li><a href="#">{{ Auth::user()->name }}</a><li>
                            <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a><li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                        <li><a href="/carrinho"><i class="material-icons">shopping_cart</i></a>
                        </li>
                    </ul>
                    <ul class="sidenav" id="mobile-demo">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="/categorias">Produtos</a></li>
                        @guest
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}">{{ __('Cadastro') }}</a>
                                </li>
                            @endif
                        @else
                            <li><a href="#">{{ Auth::user()->name }}</a></li>
                            <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form-2').submit();">
                                {{ __('Logout') }}
                            </a></li>

                            <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                        <li><a href="/carrinho"><i class="material-icons">shopping_cart</i></a>
                        </li>
                    </ul>
                </div>
            </nav>
    </head>

        @yield('content')
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/materialize.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.sidenav').sidenav();
                $('.slider').slider();
                $('.materialboxed').materialbox();
                $('select').formSelect();
            });
        </script>
    </body>
</html>