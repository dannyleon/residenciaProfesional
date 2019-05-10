@extends('students.inicio')
@section('title', '- Subir')
@section('content2')

<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-4">
      <div class="card">
        <h5 class="card-header">Subir Documento</h5>
        <div class="card-body">
          <form class="" action="{{route('uploadfile')}}" method="post" enctype= "multipart/form-data">
            @csrf
            <div class="form-group">
              <input type="file" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Subir</button>
            <a href="{{route('viewfile')}}" class="btn btn-success">Regresar</a>
          </form>

        </div>
      </div>

    </div>

  </div>

</div>

@stop
