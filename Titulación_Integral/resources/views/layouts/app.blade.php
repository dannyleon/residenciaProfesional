<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> TitIntegral -@yield('title')</title>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

<
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}

    <style>
    ul#seguimiento li {
    display:inline;
    margin: 20px;

    left: 10px;
    }
    </style>



  </head>

  <body>

    <nav class="navbar navbar-dark bg-primary">
      <a href="{{route('students.index')}}" class="navbar-brand">Titulación Integral</a>

      <form action="{{URL::to('\search')}}" method="post" role="search" class="form-inline" >
        @csrf
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" name="buscar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </nav>


    <div class="container">

      @yield('content')

    </div>

  </body>

</html>
