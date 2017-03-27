<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link  href="/css/fileinput.min.css" rel="stylesheet">
    <link  href="/plugins/trumbowyg/ui/trumbowyg.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link  href="/css/datatable.css" rel="stylesheet">
<link  href="/css/sweetalert.css" rel="stylesheet">


@yield('mastercss')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else

                           
                            @if(Auth::user()->isAdmin())
                                <li >
                                    <a href="/logs"  role="button" >
                                        Logs
                                    </a>
                                </li> 
                                <li >
                                    <a href="{{ route('admin.role.index') }}"  role="button" >
                                        Roles
                                    </a>
                                </li>
                                 <li >
                                    <a href="{{ route('admin.category.index') }}"  role="button" >
                                        Categorias
                                    </a>
                                 </li>
                            @endif
                            <li >
                                <a href="{{ route('articles.book.index') }}"  role="button" >
                                    Libros
                                </a>
                            </li>
                            


                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
       
<div class="container">
   {!! AlertManager::render() !!}
                @include('componentes.errors')
    <div class="row">
        <div class="col-md-8 ">
             
                @yield('content')     
        </div>
         <div class="col-md-4 ">
                  
                          @component('componentes.viewcomposer')
                          @endcomponent
         </div>
        </div></div>



       
    </div>

    <!-- Scripts -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/js/app.js"></script>
<script  src="/js/fileinput.min.js"></script>
<script  src="/plugins/trumbowyg/trumbowyg.min.js"></script>
<script  src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<script  src="/plugins/riot/riot.min.js"></script>
<script  src="/plugins/riot/riot-compiler.min.js"></script>
<script src="/js/util.js"></script>
<script src="/js/sweetalert.min.js"></script>
@yield('masterjs')

</body>
</html>
