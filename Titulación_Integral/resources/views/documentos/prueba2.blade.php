@extends('students.inicio')
@section('title', '- DocPrueba')
@section('content2')
  <h2>Prueba de Documentos html</h2>
  <p>{{$student->Apellidos}} {{$student->Nombre}}</p>
  <p>{{$student->Correo}}</p>
  <p>{{$student->carrera->nombre}}</p>
  <p>{{$student->seguimiento->metodo->nombre}}</p>
  @foreach ($student->telefonos as $telefono)
   <p>{{$telefono->numeroTel}}</p>
  @endforeach


@endsection
