@extends('students.index')
@section('title', 'Estudiantes')

@section('content2')
<div class="row">
  <div class="col-md-12">
    <br>
    <h2 align="center">Información de Estudiante</h2>
    <br>

    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{$message}}</p>
      </div>
    @endif

    @if ($message = Session::get('eliminado'))
      <div class="alert alert-danger">
        <p>{{$message}}</p>
      </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div align='right'>
      <a href="{{route('students.create')}}" class = 'btn btn-primary'>Añadir</a>
    </div>
    <br>
    <table class="table table-bordered">
      <tr>
        <th>No.Control</th>
        <th>Apellidos</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Carrera</th>
        <th></th>
      </tr>
      @foreach ($student as $row)
      <tr>
          <td>{{$row->NoControl}}</td>
          <td>{{$row->Apellidos }}</td>
          <td>{{$row->Nombre}}</td>
          <td>{{$row->Correo }}</td>
          <td>{{$row->carrera->nombre}}</td>
          <td><a href="/students/{{$row->id}}" class="btn btn-light">...</a></td>
      </tr>
      @endforeach

    </table>
  </div>
</div>
@endsection
{{-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
<script type="text/javascript">

  $(document).ready(function(){
    $('.alert-success').fadeIn('slow').delay(2000).fadeOut('slow');
  });

</script>
