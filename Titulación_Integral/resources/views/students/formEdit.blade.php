<br>
<div class="form-group">
  <label for="">No.Control:</label>
  <input type="text" name="numeroControl" value="{{$student->NoControl}}" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Apellidos:</label>
  <input type="text" name="apellido" value="{{$student->Apellidos}}"class="form-control">
</div>

<div class="form-group">
  <label for="">Nombre:</label>
  <input type="text" name="nombre" value="{{$student->Nombre}}"class="form-control">
</div>

<div class="form-group">
  <label for="">Correo:</label>
  <input type="email" name="correo" value="{{$student->Correo}}" placeholder="correo@dominio.com" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Carrera:</label>

   <select name="carrera" class="form-control">
     <option value="{{$student->carrera->id}}">{{$student->carrera->nombre}}</option>
    @foreach ($carrera as $carrera => $value)
    <option value="{{ $carrera }}"> {{ $value }} </option>
    @endforeach
  </select>
</div>
<br>

  <div class="form-group">
    <label for="">Telefono(1):</label>
    <input type="text"  name="tel1" value="{{$student->telefonos[0]->numeroTel}}" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="">Telefono(2):</label>
    <input type="text" name="tel2" value="{{$student->telefonos[1]->numeroTel}}" class="form-control">
  </div>

  <div class="form-group">
    <label for="">Telefono(3):</label>
    <input type="text"  name="tel3" value="{{$student->telefonos[2]->numeroTel}}" class="form-control">
  </div>

<div class="form-group">
  <label for="">Año de Ingreso:</label>
  <input type="number" name="añoIngreso" value="{{$student->AñoIngreso}}"class="form-control">
</div>

<div class="form-group">
  <label for="">Periodo de Ingreso:</label>
  <input type="number" name="periodoIngreso" value="{{$student->PeriodoIngreso}}" min="1" max="2" >
</div>

<div class="form-group">
  <label for="">Sexo:</label><br>
  @if ($student->Sexo == 'mujer')
    <input type="radio" name="sexo" value="hombre">Hombre <br>
    <input type="radio" name="sexo" value="mujer" checked> Mujer <br>
  @else
    <input type="radio" name="sexo" value="hombre"checked>Hombre <br>
    <input type="radio" name="sexo" value="mujer" > Mujer <br>
  @endif
</div>

<div class="form-group">
  <label for="">Método de Titulación:</label>
   <select name="metodo" class="form-control">
     {{-- <option> --Selecciona Metodo-- </option> --}}
     <option value="{{$student->seguimiento->metodo->id}}">{{$student->seguimiento->metodo->nombre}}</option>
    @foreach ($metodo as $opcion => $value)
    <option value="{{ $opcion }}"> {{$value}} </option>
    @endforeach
  </select>

</div>

<div class="form-group">
  <label for="">Autorización de Registro:</label>
  <input type="date" name="autoResgistro" value="{{$student->seguimiento->autRegistro}}">
</div>

<div class="form-group">
  <label for="">Fecha de Recibido:</label>
  <input type="date" name="recibido" value="{{$student->seguimiento->recibido}}">
</div>
