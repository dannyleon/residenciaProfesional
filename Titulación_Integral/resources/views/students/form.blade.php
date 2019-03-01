<br>
<div class="form-group">
  <label for="">No.Control:</label>
  <input type="number" name="numeroControl" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Apellidos:</label>
  <input type="text" name="apellido" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Nombre:</label>
  <input type="text" name="nombre" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Correo:</label>
  <input type="email" name="correo" placeholder="correo@dominio.com" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Carrera:</label>
   <select name="carrera" class="form-control" required>
     <option value="">Selecciona una Carrera</option>
    @foreach ($carrera as $carrera => $value)
    <option value="{{ $carrera }}"> {{ $value }} </option>
    @endforeach
  </select>
</div>
<br>

<div class="form-group">
  <label for="">Telefono(1):</label>
  <input type="text"  name="tel1" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Telefono(2):</label>
  <input type="text" name="tel2" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Telefono(3):</label>
  <input type="text"  name="tel3" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Año de Ingreso:</label>
  <input type="number" name="añoIngreso" class="form-control" required>
</div>

<div class="form-group">
  <label for="">Periodo de Ingreso:</label>
  <input type="number" name="periodoIngreso" min="1" max="2" required>
</div>

<div class="form-group">
  <label for="">Sexo:</label><br>
  <input type="radio" name="sexo" value="hombre" checked required> Hombre <br>
  <input type="radio" name="sexo" value="mujer"> Mujer <br>
</div>

<div class="form-group">
  <label for="">Opciones para Titulación:</label>
   <select required name="metodo" class="form-control" >
     <option value="">SELECCIÓN UNA OPCIÓN</option>
    @foreach ($metodo as $metodo => $value)
    <option value="{{ $metodo }}"> {{ $value }} </option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="">Autorización de Registro:</label>
  <input type="date" name="autoResgistro" required>
</div>

<div class="form-group">
  <label for="">Fecha de Recibido:</label>
  <input type="date" name="recibido" required>
</div>
