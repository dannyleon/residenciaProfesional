@extends('students.inicio')
@section('title', '- Estudiante')
@section('content2')

<div class="contenedor">
  {{-- @if(Session::has('alert'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("Bien hecho!", "Alumno Modificado");
    </script>
  @endif --}}

  <div id="message"> </div>
</div>

<div class="card  contenedor contenedor-card">

  <div class="card-body tarjeta">
    <input type="hidden" id="student_id" value="{{ $student->id }}">

    <div class="encabezado">
      <h2 class="card-title no-margin"> {{$student->Apellidos}} {{$student->Nombre}} </h2>

      <div class="botones-seguimiento">
        <button class="btn btn-success btn-xs actualizar" style="display:none;" id="update">Actualizar</button>

        <!-- Condición para restrigir funciones de editar y eliminar al asistente del coordinador-->
        @if(Auth::user()->name == 'Coordinador Titulación')

          @if($student->AñoIngreso != 0)
            <a href="/students/{{$student->id}}/edit"> <i class="fas fa-user-edit" title="Editar Alumno"></i> </a>
          @else
            <a href="/students/{{$student->id}}/edit"><i class="fas fa-user-edit" style="color:#ff3f57;" title="Editar Alumno"></i> </a>
          @endif

        @endif
      </div>
    </div>

    <div class="card-text datos">
      <p>{{$student->Correo}}</p>
      <p>{{$student->carrera->nombre}}</p>
      <p>{{$student->seguimiento->metodo->nombre}}</p>

      @foreach ($student->telefonos as $telefono)
       <p>{{$telefono->numeroTel}}</p>
      @endforeach
    </div>

    <div class="fechas">
        <div class="table-responsive">
          <table id="editable_table" class="table">
            <thead>
              <tr>
                <th>Autorización de Registro</th>
                <th>Recibido en Titulación</th>
                <th>Liberación de Proyecto</th>
                <th>Solicitud de Fecha</th>
                <th>Acto Protocolario</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>

            </tbody>

          </table>
            {{ csrf_field() }}
        </div>

    </div>

    <div class="contenedor-cajas">

      <div class="caja caja-observaciones">
        <div class="titulo">
          <p class="no-margin">Observaciones</p>
        </div>

        <div class="textarea">
          <textarea placeholder= "Escriba Algo" id="observaciones"></textarea>
        </div>
      </div>

      <div class="caja caja-documentos">
        <div class="titulo">
          <p class="no-margin">Documentos</p>
        </div>

        <div class="contenedor-documentos">
          <ul class="documentos">

            @foreach($files as $file)
              <li><i class="far fa-file-alt"></i><a href="{{route('downloadfile', $file->id)}}">{{ $file->titulo }}</a></li>
            @endforeach

          </ul>
        </div>
      </div>

    </div>

  </div> <!-- card-body -->
</div> <!-- card -->
@endsection

<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js')}}"></script>
<script src="{{asset('http://code.jquery.com/ui/1.11.0/jquery-ui.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">


$(document).ready(function(){

  var student_id = $("#student_id").val();

  fetch_data();

  var studentData= {};

  $('#update').fadeOut();

  $('.alert-success').fadeIn('slow').delay(2000).fadeOut('slow');

  function fetch_data()
  {
   $.ajax({
    type: "GET",
    url:"/fetch_data/{id}",
    data: { id: student_id },
    dataType:"json",

    success:function(response)
    {
      studentData=response;

      console.log(response);
      var html = '';

      html +='<tr>';
      html += '<td> <input type="date" class="datepicker" name="autRegistro" id="autRegistro" value="'+response.autRegistro+'">  </td>';
      html += '<td> <input type="date" class="datepicker" name="recibido" id="recibido" value="'+response.recibido+'">  </td>';
      html += '<td> <input type="date" class="datepicker" name="liberación" id="liberación" value="'+response.liberación+'">  </td>';
      html += '<td> <input type="date" class="datepicker" name="solicitudActo" id="solicitudActo" value="'+response.solicitudActo+'">  </td>';
      html += '<td> <input type="date" class="datepicker" name="actoProtocolario" id="actoProtocolario" value="'+response.actoProtocolario+'">  </td>';
      html += '<td class="status"> '+ response.status +'  </td>';

      $('tbody').html(html);

      $('#observaciones').val(response.observaciones);

    },

    error: function(response)
   {
    alert('Error'+response);
    }

   });
  }


  var _token = $('input[name="_token"]').val();

  $(document).on('change', '.datepicker', function(){

    // console.log("updating...")
    //
    // console.log("checking ui,", jQuery.ui)
    //
    // console.log($("#autRegistro").datepicker({ dateFormat: 'dd,mm,yyyy' }).val())

    var autRegistro = $("#autRegistro").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
    var recibido = $("#recibido").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
    var liberación = $("#liberación").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
    var solicitudActo = $("#solicitudActo").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
    var actoProtocolario = $("#actoProtocolario").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();

      if (autRegistro == studentData.autRegistro
          && recibido == studentData.recibido
          && liberación == studentData.liberación
          && solicitudActo == studentData.solicitudActo
          && actoProtocolario == studentData.actoProtocolario)
          {
            $('#update').fadeOut();
          }

        else
        {
          $('#update').fadeIn();
        }

  });

  $(document).on('keydown', '#observaciones', function(){

      var observaciones = $("#observaciones").val();

      if (observaciones == studentData.observaciones)
        {
          $('#update').fadeOut();
        }

      else
        {
          $('#update').fadeIn();
        }

  });


  $(document).on('click', '#update', function(){


  var autRegistro = $("#autRegistro").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
  var recibido = $("#recibido").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
  var liberación = $("#liberación").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
  var solicitudActo = $("#solicitudActo").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
  var actoProtocolario = $("#actoProtocolario").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
  var observaciones = $("#observaciones").val();


   $.ajax({
    url:"{{ route('seguimiento.update_data') }}",
    method:"POST",
    data:{autRegistro:autRegistro, recibido:recibido, liberación:liberación, solicitudActo:solicitudActo, actoProtocolario:actoProtocolario, observaciones:observaciones, id:student_id,  _token:_token},

    success:function(response)
    {

     $('#message').fadeIn('slow').html("<div class='alert alert-success'> "+response+" </div>").delay(2000).fadeOut('slow');
     fetch_data();
     $('#update').fadeOut();
    }

   });

 });

});

</script>
