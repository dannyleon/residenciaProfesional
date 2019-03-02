@extends('layouts.app')

@section('title', 'Students Create')

@section('content')
  @include('common.errors')

  {{-- @if(\Session::has('success'))
    <div class="alert alert-success">
      <p>{{\Session::get('success')}}</p>
    </div>
  @endif --}}

  <form class="form-group" method="POST" action="/students"  enctype="multipart/form-data">
    @csrf
    @include('students.form')
    
    <button class="btn btn-primary">Guardar</button>
    <a href="{{route('students.index')}}" class="btn btn-danger"> Cancelar </a>
  </form>

@endsection
