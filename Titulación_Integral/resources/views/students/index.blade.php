@extends('welcome')
@section('content')

  @if(Session::has('alert'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        swal("No se Encuentra el Alumno", "Intente buscar por Número de Control ó Apellidos Completos");
    </script>

  @endif

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

    <a href="{{route('students.index')}}" > <i class="fas fa-graduation-cap"></i> Titulación</a>
    <a  href="{{route('students.create')}}"> <i class="fas fa-plus-circle"></i>Añadir Alumno</a>
    <a href="{{route('estadistica.view')}}"> <i class="fas fa-table"></i>Estadística</a>
    <a href="{{route('viewfile')}}"> <i class="fas fa-file-alt"></i> Documentos</a>

    <div class="dropdown">

      <a href="#" onclick="myFunction()" class="dropbtn"> <i class="fas fa-user-friends"></i>   {{ Auth::user()->name }} <i class="fa fa-caret-down"></i></a>

      <div id="myDropdown" class="dropdown-content">

        <a  href="{{ route('logout') }}"  onclick= "event.preventDefault();
                      document.getElementById('logout-form').submit();"> {{ __('Salir') }} </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </div>
    </div>

    {{-- <!-- Right Side Of Navbar -->
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
    </ul> --}}
    <div class="busquedaBarra">
      <form id="searchForm" action="{{URL::to('/search')}}" method="post" role="search">
        @csrf
        <input id="buscar"class="form-control mr-sm-2" type="text" placeholder="Buscar Alumno" aria-label="Search" name="q">
        {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button> --}}

      </form>
    </div>

  </nav>
</div>

<main class="contenido-main">

    <div id="contenedor-busqueda" class="contenedor-busqueda">

      <div>
        <p class="titulo-p no-margin">Titulación Integral</p>
      </div>

      <div class="busquedaInicio contenedor">
        <form class="searchForm"id="searchForm" action="{{URL::to('/search')}}" method="post" role="search">
          @csrf

          <div class="inputWhitButton">
            <input id="buscar-p" class="form-control " type="text" placeholder="Buscar alumno..." aria-label="Search" name="q">

            <button type="submit"> <i class="fas fa-search"> </i> </button>
          </div>

        </form>
      </div>

    </div>



</main>

@endsection

<script type="text/javascript">

window.onload = function() {
  document.getElementById("buscar-p").focus();
};

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

// var form = document.getElementById("logout-form");

// document.getElementById("salir").addEventListener("click", function () {
//
//   form.submit();
//
// });


</script>
