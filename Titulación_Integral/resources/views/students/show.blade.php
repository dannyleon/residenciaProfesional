
@extends('layouts.app')
@section('title', 'Students')
@section('content')

<br>
<div class="card">
  <div class="card-header">
    SEGUIMIENTO
  </div>
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
      {{-- @include('students.seguimiento') --}}
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
            {{-- <tr>
              <td>{{$student->seguimiento->autRegistro}}</td>
              <td>{{$student->seguimiento->recibido}}</td>
              <td><input type="date" name="liberación"></td>
              <td><input type="date" name="solicitudActo"></td>
              <td><input type="date" name="actoProtocolario"></td>
              <td contenteditable="true" class="date-selector"></td>
            </tr> --}}
          </table>
          {{ csrf_field() }}
      </div>

        <button class="btn btn-success btn-xs" id="update" >Actualizar</button>



    </div>

    <a href="/students/{{$student->id}}/edit"t class="btn btn-primary" style="float:right; margin:5px;">Editar</a>

    <form class="" action={{action('StudentController@destroy', $student->id)}} method="post">
      @method('DELETE')
      @csrf
      <button type="submit" class="btn btn-danger text center" style="float:right; margin:5px;">Borrar</button>
    </form>

  </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

  var student_id = $("#student_id").val();

  fetch_data();

  function fetch_data()
  {
   $.ajax({
    type: "GET",
    url:"/fetch_data/{id}",
    data: { id: student_id },
    dataType:"json",

    success:function(response)
    {
      console.log(response);
      var html = '';

      html +='<tr>';
      html += '<td> <input type="text" class="date" name="autRegistro" id="autRegistro" value="'+response.autRegistro+'">  </td>';
      html += '<td> <input type="date" name="recibido" id="recibido" value="'+response.recibido+'">  </td>';
      html += '<td> <input type="date" name="liberación" id="liberación" value="'+response.liberación+'">  </td>';
      html += '<td> <input type="date" name="solicitudActo" id="solicitudActo" value="'+response.solicitudActo+'">  </td>';
      html += '<td> <input type="date" name="actoProtocolario" id="actoProtocolario" value="'+response.actoProtocolario+'">  </td>';

   $('tbody').html(html);

    },

    error: function(response)
   {
    alert('Error'+response);
    }

   });
  }

  var _token = $('input[name="_token"]').val();

  $(".date").datepicker({
  onSelect: function(dateText) {
    display("Selected date: " + dateText + "; input's current value: " + this.value);
  }
});

function display(msg) {
    $("<p>").html(msg).appendTo(document.body);
  }



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
     $('#message').html("<div class='alert alert-success'> "+response+" </div>");
     fetch_data();
    }

   });

 });


});

</script>
