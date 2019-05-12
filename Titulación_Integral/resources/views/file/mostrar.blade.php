@extends('students.inicio')
@section('title', '- Documento')
@section('content2')

<div class="container">
  @if(session('success'))
    <div class="alert alert-success">
      <strong>{{ session('success') }}</strong>
    </div>
  @endif

  <p>
    <a href="{{ route('formfile') }}" class="btn btn-primary">Subir Documento</a>
  </p>

  <div class="row">
    @foreach($files as $file)
    <div class="col-md-4">
      <div class="card">
        {{-- <img src="{{ Storage::url($file->path)}}" alt="imagen" class="card-img-top"> --}}
        <img src="/imagenes/word-document-icon-8.jpg" alt="Icono Documento" class="card-img-top">
        <div class="card-body">
          <strong class="card-title">{{ $file->titulo }}</strong>
          <p class="card-text">{{ $file->created_at->diffForHumans() }}</p>
          <form action="{{ route('deletefile', $file->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Borrar</button>
            <a href="{{route('downloadfile',$file->id)}}" class="btn btn-primary">Descargar</a>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
