@extends('students.index')
@section('title', 'Nuevo')
@section('content2')
  @include('common.errors')

  {{-- @if(\Session::has('success'))
    <div class="alert alert-success">
      <p>{{\Session::get('success')}}</p>
    </div>
  @endif --}}

<section class="no-margin contacto contenido-centrado">
  <form class="form-group" method="POST" action="/students"  enctype="multipart/form-data">
    @csrf

    <fieldset>
      <div class="contenedor-campos">

        <legend>Información Personal</legend>

        <div class="campo w-100">
          <label for="numeroControl">No.Control:</label>
          <input type="number" name="numeroControl" id="numeroControl" class="form-control" required>
        </div>

        <div class="campo">
          <label for="apellidos">Apellidos:</label>
          <input type="text" name="apellido" id="apellidos" class="form-control" required>
        </div>

        <div class="campo">
          <label for="nombre">Nombre:</label>
          <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>


        <div class="campo">
          <label for="correo">Correo:</label>
          <input type="email" name="correo" id="correo" placeholder="correo@dominio.com" class="form-control" required>
        </div>

        <div class="campo">
          <label for="tel1">Telefono(1):</label>
          <input type="text"  name="tel1" id="tel1" class="form-control" required>
        </div>


        <div class="campo">
          <label for="tel2">Telefono(2):</label>
          <input type="text" name="tel2" id="tel2" class="form-control" required>
        </div>

        <div class="campo">
          <label for="tel3">Telefono(3):</label>
          <input type="text"  name="tel3" id="tel3" class="form-control" required>
        </div>

        <div class="campo">
          <label for="">Sexo:</label><br>
          <input type="radio" name="sexo" value="hombre" checked required> Hombre <br>
          <input type="radio" name="sexo" value="mujer"> Mujer <br>
        </div>

      </div>
    </fieldset>

    <fieldset>
      <div class="contenedor-campos">

        <legend>Información sobre Carrera</legend>
        <div class="campo w-100">
          <label for="carrera">Carrera:</label>
          <select name="carrera" id="carrera"class="form-control" required>
            <option value="">Selecciona una Carrera</option>
            @foreach ($carrera as $carrera => $value)
            <option value="{{ $carrera }}"> {{ $value }} </option>
            @endforeach
          </select>
        </div>


        <div class="campo">
          <label for="añoIngreso">Año de Ingreso:</label>
          <input type="number" name="añoIngreso" id="añoIngreso" class="form-control" required>
        </div>



        <div class="campo">
          <label for="periodo">Periodo de Ingreso:</label><br>
          <input type="number" name="periodoIngreso" id="periodo" min="1" max="2" required>
        </div>

        <div class="campo w-100">
          <label for="opciones">Opciones para Titulación:</label>
           <select required name="metodo" id="opciones" class="form-control" >
             <option value="">SELECCIÓN UNA OPCIÓN</option>
            @foreach ($metodo as $metodo => $value)
            <option value="{{ $metodo }}"> {{ $value }} </option>
            @endforeach
          </select>
        </div>

        <div class="campo campoFecha">
          <label for="fechaRegistro">Autorización de Registro:</label><br>
          <input type="date" name="autoResgistro" id="fechaRegistro" required>
        </div>

        <div class="campo campoFecha">
          <label for="fechaRecibido">Fecha de Recibido:</label><br>
          <input type="date" name="recibido" id="fechaRecibido" required>
        </div>

      </div>
    </fieldset>

    {{-- @include('students.form') --}}

    <div class="enviar">
        <button class="btn btn-primary">Guardar</button>
        <a href="{{route('students.index')}}" class="btn btn-danger"> Cancelar </a>
    </div>


  </form>
</section>

@endsection
