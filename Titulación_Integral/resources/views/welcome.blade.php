<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> Titulación Integral @yield('title')</title>

        <!-- ESTILOS Y SCRIPTS CREADOS AUTOMATICAMENTE PARA LOGIN DE USUARIOS -->

        <!-- Scripts -->
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- MIS ESTILOS Y LINKS -->

         <!-- CDN link para iconos fontawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/misEstilos.css">

    </head>

  <body>

        @auth
          @yield('content')

          @else
          <div class="flex-center position-ref full-height white">

              @if (Route::has('login'))
                <div class="top-right links">
                  {{-- <a href="{{ url('/home') }}">Home</a> --}}
                  {{-- <a href="{{ route('register') }}">Registrar</a> --}}
                  <a href="{{ route('login') }}">Ingresar</a>
                </div>
              @endif

              <div class="content">

                  <div class="title m-b-md">
                      Titulación Integral
                  </div>

                  <div class="site-header">
                    <div class="contenido-header">
                      <div class="barra">
                        <div class="imagen">
                          <img src="/imagenes/perfil_sep.jpg">
                        </div>

                        <div class="imagen">
                          <img src="/imagenes/Logo_ITT.png">
                        </div>

                        <div class="imagen">
                          <img src="/imagenes/TecNaMe.png">
                        </div>
                      </div>
                    </div>

                  </div>
              </div>
          </div>
        @endauth
    </body>
</html>
