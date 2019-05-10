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
        <img src="{{ Storage::url($file->path)}}" alt="imagen" class="card-img-top">
        <div class="card-body">
          <strong class="card-title">{{ $file->titulo }}</strong>
          <p class="card-text">{{ $file->created_at->diffForHumans() }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
