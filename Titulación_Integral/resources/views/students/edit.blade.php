@extends('students.inicio')
@section('title', 'Editar')
@section('content2')

  @include('common.errors')

  {{-- @if(\Session::has('success'))
    <div class="alert alert-success">
      <p>{{\Session::get('success')}}</p>
    </div>
  @endif --}}

<section class="no-margin contacto contenido-centrado">
  <form class="form-group" method="POST" action="/students/{{$student->id}}"  enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <fieldset>
      <div class="contenedor-campos">

        <legend>Información Personal</legend>

        <div class="campo w-100">
          <label for="numeroControl">No.Control:</label>
          <input value="{{$student->NoControl}}" type="number" name="numeroControl" id="numeroControl" class="form-control" required>
        </div>

        <div class="campo">
          <label for="apellidos">Apellidos:</label>
          <input value="{{$student->Apellidos}}" type="text" name="apellido" id="apellidos" class="form-control" required>
        </div>

        <div class="campo">
          <label for="nombre">Nombre:</label>
          <input value="{{$student->Nombre}}" type="text" name="nombre" id="nombre" class="form-control" required>
        </div>


        <div class="campo">
          <label for="correo">Correo:</label>
          <input value="{{$student->Correo}}" type="email" name="correo" id="correo" placeholder="correo@dominio.com" class="form-control" required>
        </div>

        <div class="campo">
          <label for="tel1">Telefono(1):</label>
          <input value="{{$student->telefonos[0]->numeroTel}}" type="text"  name="tel1" id="tel1" class="form-control" required>
        </div>


        <div class="campo">
          <label for="tel2">Telefono(2):</label>
          <input value="{{$student->telefonos[1]->numeroTel}}" type="text" name="tel2" id="tel2" class="form-control" required>
        </div>

        <div class="campo">
          <label for="tel3">Telefono(3):</label>
          <input value="{{$student->telefonos[2]->numeroTel}}" type="text"  name="tel3" id="tel3" class="form-control" required>
        </div>

        <div class="campo">
          <label for="">Sexo:</label><br>
          @if ($student->Sexo == 'mujer')
            <input type="radio" name="sexo" value="hombre">Hombre <br>
            <input type="radio" name="sexo" value="mujer" checked> Mujer <br>
          @else
            <input type="radio" name="sexo" value="hombre"checked>Hombre <br>
            <input type="radio" name="sexo" value="mujer" > Mujer <br>
          @endif
        </div>

      </div>
    </fieldset>

    <fieldset>
      <div class="contenedor-campos">

        <legend>Información sobre Carrera</legend>
        <div class="campo w-100">
          <label for="">Carrera:</label>
           <select name="carrera" class="form-control" required>
             <option value="{{$student->carrera->id}}">{{$student->carrera->nombre}}</option>
            @foreach ($carrera as $carrera => $value)
            <option value="{{ $carrera }}"> {{ $value }} </option>
            @endforeach
          </select>
        </div>


        <div class="campo">
          <label for="añoIngreso">Año de Ingreso:</label>
          <input value="{{$student->AñoIngreso}}" type="number" name="añoIngreso" id="añoIngreso" class="form-control" required>
        </div>



        <div class="campo campo-periodo">
          <label for="periodo">Periodo de Ingreso:</label><br>
          <input value="{{$student->PeriodoIngreso}}" type="number" name="periodoIngreso" id="periodo" min="1" max="2" required>
        </div>

        <div class="campo w-100">
          <label for="">Opciones para Titulación:</label>
           <select name="metodo" class="form-control" required>
             {{-- <option> --Selecciona Metodo-- </option> --}}
             <option value="{{$student->seguimiento->metodo->id}}">{{$student->seguimiento->metodo->nombre}}</option>
            @foreach ($metodo as $opcion => $value)
            <option value="{{ $opcion }}"> {{$value}} </option>
            @endforeach
          </select>
        </div>

        <div class="campo campoFecha">
          <label for="fechaRegistro">Autorización de Registro:</label><br>
          <input value="{{$student->seguimiento->autRegistro}}" type="date" name="autoResgistro" id="fechaRegistro" required>
        </div>

        <div class="campo campoFecha">
          <label for="fechaRecibido">Fecha de Recibido:</label><br>
          <input value="{{$student->seguimiento->recibido}}" type="date" name="recibido" id="fechaRecibido" required>
        </div>

      </div>
    </fieldset>

    <div class="enviar">
      <button class="btn btn-primary">Actualizar</button>
      <a href="{{route("students.show",$student)}}" class="btn btn-danger"> Cancelar </a>
    </div>

  </form>

</section>

@endsection
