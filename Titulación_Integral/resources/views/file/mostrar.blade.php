@extends('students.inicio')
@section('title', '- Documento')
@section('content2')



<div class="container">
  @if(session('success'))
    <div class="alert alert-success">
      <strong>{{ session('success') }}</strong>
    </div>
  @endif


  <div class="agregar-doc">

    <div>

    </div>

    <div class="titulo-doc">
      <h1 class="no-margin"> Documentos </h1>
    </div>

    <div class="icono-subir">
      <a href="{{ route('formfile') }}" > <i class="fas fa-file-upload" title="Agregar Documentos"></i> </a>
      <p class="no-margin">Agregar</p>
    </div>

  </div>

  <div class="row">
    @foreach($files as $file)
    <div class="col-md-4">
      <div class="card">
        {{-- <img src="{{ Storage::url($file->path)}}" alt="imagen" class="card-img-top"> --}}

        {{-- <img src="/imagenes/word-document-icon-8.jpg" alt="Icono Documento" class="card-img-top"> --}}
        <div class="card-body">

          <div class="cuerpo">
            {{-- <i class="fas fa-file-word"></i> --}}
            <strong class="card-title">{{ $file->titulo }}</strong>
            <p class="card-text">{{ $file->created_at->diffForHumans() }}</p>
          </div>


          <form action="{{ route('deletefile', $file->id) }}" method="post">
            @csrf
            @method('DELETE')

            <div class="al-izq">
              <a href="{{route('downloadfile',$file->id)}}" class="btn btn-primary miBoton-primario" title="Descargar"> <i class="fas fa-file-word"></i></a>
              <button type="submit" class="btn btn-danger miBoton-eliminar" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
            </div>


          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
