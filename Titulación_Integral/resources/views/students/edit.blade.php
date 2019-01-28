@extends('layouts.app')

@section('title', 'Student Edit')

@section('content')
  @include('common.errors')

  @if(\Session::has('success'))
    <div class="alert alert-success">
      <p>{{\Session::get('success')}}</p>
    </div>
  @endif

  <form class="form-group" method="POST" action="/students/{{$student->id}}"  enctype="multipart/form-data">
    @method('PUT')
    @csrf
    
    @include('students.formEdit')

    <button class="btn btn-primary">Actualizar</button>
  </form>

@endsection
