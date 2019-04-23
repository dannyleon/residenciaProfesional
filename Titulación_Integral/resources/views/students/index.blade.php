@extends('welcome')
@section('content')

<header class="site-header">
    <div class="contenedor contenido-header">
      <div class="barra">
        <div class="imagen">
          <img src="/imagenes/perfil_sep.jpg">
        </div>

        <div class="imagen">
          <img src="/imagenes/TecNaMe.png">
        </div>

        <div class="imagen">
          <img src="/imagenes/Logo_ITT.png">
        </div>
      </div>
    </div>
</header>

<div class="barra-navegacion">
  <nav class="navegacion-principal">

    <a href="{{route('students.index')}}">TitIntegral</a>
    <a href="{{route('students.create')}}">Añadir Alumno</a>
    <a href="{{route('estadistica.view')}}">Estadística</a>
    <a href="#">Documentos</a>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
                @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </li>

        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Salir') }} 
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>

    <form id="searchForm" action="{{URL::to('/search')}}" method="post" role="search">
      @csrf
      <input class="form-control mr-sm-2" type="text" placeholder="Buscar Alumno" aria-label="Search" name="q">
      {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button> --}}
    </form>
  </nav>
</div>

<main class="contenedor contenido-main">
  @yield('content2')
</main>
@endsection
