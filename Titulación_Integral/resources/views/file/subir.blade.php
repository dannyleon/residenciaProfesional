@extends('students.inicio')
@section('title', '- Subir')
@section('content2')

  @if(Session::has('alert'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        swal("El Título del Documento Contiene Caracteres Especiales", "Elimínelos o Remplácelos por caracteres válidos", "error");
    </script>

  @endif

  @if(Session::has('alert2'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        swal("No ha Seleccionado Ningún Archivo", "Elija un archivo antes de intentar subirlo", "error");
    </script>

  @endif
<div class="container">
  <div class="row">
    <div class="col-md-6 col-offset-md-4">
      <div class="card">
        <h5 class="card-header">Subir Documento</h5>
        <div class="card-body">
          <form class="" action="{{route('uploadfile')}}" method="post" enctype= "multipart/form-data">
            @csrf
            <div class="form-group">
              <input type="file" name="file[]" multiple> <!-- Codigo para subir varios documentos -->
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
