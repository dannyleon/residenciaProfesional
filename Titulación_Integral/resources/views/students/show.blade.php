
@extends('layouts.app')
@section('title', 'Students')
@section('content')

<br>
<div class="card">
  {{-- <div class="card-header">
    SEGUIMIENTO
  </div> --}}

  <div class="card-body">

    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{$message}}</p>
      </div>
    @endif

     <div id="message"> </div>
    <input type="hidden" id="student_id" value="{{ $student->id }}">

    <h5 class="card-title">{{$student->Apellidos}} {{$student->Nombre}} </h5>

    <p class="card-text">
      {{$student->Correo}}
      &nbsp;&nbsp; * &nbsp;&nbsp;
      {{$student->carrera->nombre}}
      &nbsp;&nbsp; * &nbsp;&nbsp;
      {{$student->seguimiento->metodo->nombre}}
      &nbsp;&nbsp; * &nbsp;&nbsp;

       @foreach ($student->telefonos as $telefono)
        {{$telefono->numeroTel}}
        &nbsp;&nbsp; * &nbsp;&nbsp;
      @endforeach</p>
    <br>

    <div class="">
      <div class="table-responsive">
        <table id="editable_table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Autorización de Registro</th>
              <th>Recibido en Titulación</th>
              <th>Liberación de proyecto</th>
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
        <button class="btn btn-success btn-xs" style="display:none;" id="update" >Actualizar</button>
    </div>
    <br>
    <div class="cajaObservaciones">
      <div class="tituloObservaciones">
        <p>Observaciones</p>
      </div>
      <br>
      <div class="">
        <form>
          <textarea placeholder="Escriba Algo" id="observaciones"> </textarea>
        </form>
      </div>
    </div>


    <a href="/students/{{$student->id}}/edit" id="buttonEdit" class="btn btn-primary" style="float:right; margin:5px;">Editar</a>

    <form class="" action={{action('StudentController@destroy', $student->id)}} method="post">
      @method('DELETE')
      @csrf
      <button type="submit" class="btn btn-danger text center" id="buttonDelete" style="float:right; margin:5px;">Borrar</button>
    </form>
  </div>

</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

  var student_id = $("#student_id").val();

  fetch_data();

  var studentData= {};

  $('#update').fadeOut();

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

      //console.log(response);
      var html = '';

      html +='<tr>';
      html += '<td> <input type="date" class="datepicker" name="autRegistro" id="autRegistro" value="'+response.autRegistro+'">  </td>';
      html += '<td> <input type="date" class="datepicker" name="recibido" id="recibido" value="'+response.recibido+'">  </td>';
      html += '<td> <input type="date" class="datepicker" name="liberación" id="liberación" value="'+response.liberación+'">  </td>';
      html += '<td> <input type="date" class="datepicker" name="solicitudActo" id="solicitudActo" value="'+response.solicitudActo+'">  </td>';
      html += '<td> <input type="date" class="datepicker" name="actoProtocolario" id="actoProtocolario" value="'+response.actoProtocolario+'">  </td>';
      html += '<td> '+ response.status +'  </td>';

   $('tbody').html(html);

    },

    error: function(response)
   {
    alert('Error'+response);
    }

   });
  }

  var _token = $('input[name="_token"]').val();

  $(document).on('change', '.datepicker', function(){

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
          $('#update').fadeIn()
        }


  });

    // $(document).on('blur', '#observaciones', function(){
    //
    //   var observaciones =
    //
    // });


  $(document).on('click', '#update', function(){

  var autRegistro = $("#autRegistro").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
  var recibido = $("#recibido").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
  var liberación = $("#liberación").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
  var solicitudActo = $("#solicitudActo").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();
  var actoProtocolario = $("#actoProtocolario").datepicker({ dateFormat: 'dd,mm,yyyy' }).val();

  console.log("Estoy actualizando");

   $.ajax({
    url:"{{ route('seguimiento.update_data') }}",
    method:"POST",
    data:{autRegistro:autRegistro, recibido:recibido, liberación:liberación, solicitudActo:solicitudActo, actoProtocolario:actoProtocolario, id:student_id,  _token:_token},
    //dataType:"json",

    success:function(response)
    {
    //$('#overlay').fadeIn('fast').delay(1000).fadeOut('fast');
     $('#message').fadeIn('slow').html("<div class='alert alert-success'> "+response+" </div>").delay(2000).fadeOut('slow');
     fetch_data();
     $('#update').fadeOut();
    }

   });

 });


});

</script>
