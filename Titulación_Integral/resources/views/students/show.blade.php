
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
    success:function(data)
    {

      console.log(data);
      var html = '';
   //   // html += '<tr>';
   //      html += '<td contenteditable id="first_name"> </td>';
   //   // html += '<td contenteditable id="last_name"></td>';
   //   // html += '<td><button type="button" class="btn btn-success btn-xs" id="add">Add</button></td></tr>';
   //
      html +='<tr>';
      html += '<td> <input type="date" name="autRegistro" id="autRegistro" value="'+data.autRegistro+'">  </td>';
      html += '<td> <input type="date" name="recibido" id="recibido" value="'+data.recibido+'">  </td>';
      html += '<td> <input type="date" name="liberación" id="liberación" value="'+data.liberación+'">  </td>';
      html += '<td> <input type="date" name="solicitudActo" id="solicitudActo" value="'+data.solicitudActo+'">  </td>';
      html += '<td> <input type="date" name="actoProtocolario" id="actoProtocolario" value="'+data.actoProtocolario+'">  </td>';

       //html +='<td contenteditable class="column_name" data-column_name="autRegistro" data-id="'+data.id+'">'+data.autRegistro+' </td>';
      // html += '<td contenteditable class="column_name" data-column_name="recibido" data-id="'+data.id+'">'+data.recibido+'</td>';
      // html += '<td contenteditable class="column_name" data-column_name="recibido" data-id="'+data.id+'">'+data.liberación+'</td>';
      // html += '<td contenteditable class="column_name" data-column_name="recibido" data-id="'+data.id+'">'+data.solicitudActo+'</td>';
      // html += '<td contenteditable class="column_name" data-column_name="recibido" data-id="'+data.id+'">'+data.actoProtocolario+'</td>';


      // html += '<td contenteditable class="column_name" data-column_name="liberación" data-id="'+data[count].id+'">'+data[count].last_name+'</td>';
      // html += '<td contenteditable class="column_name" data-column_name="solicitudActo" data-id="'+data[count].id+'">'+data[count].last_name+'</td>';
      // html += '<td contenteditable class="column_name" data-column_name="actoProtocolario" data-id="'+data[count].id+'">'+data[count].last_name+'</td>';
      // html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].id+'">Delete</button></td></tr>';


      // <tr>
      //  '<td> <input type="date" name="autRegistro" value="'+data.autRegistro+'">''</td>';
      //   <td><input type="date" name="liberación" value=""></td>
      //   <td><input type="date" name="liberación" value=""></td>
      //   <td><input type="date" name="solicitudActo"></td>
      //   <td><input type="date" name="actoProtocolario"></td>
      //   <td contenteditable="true" class="date-selector"></td>
      // </tr>

   $('tbody').html(html);
    },

    error: function(response)
   {
    alert('Error'+response);
    }

   });
  }

  var _token = $('input[name="_token"]').val();

  $(document).on('click', '#update', function(){


  var autRegistro = $('#autRegistro').text();
  var recibido = $('#recibido').text();
  var liberación = $('#liberación').text();
  var solicitudActo = $('#solicitudActo').text();
  var actoProtocolario = $('#actoProtocolario').text();

  

  console.log("Estoy clickeando");
  console.log(autRegistro);

  // if(autRegistro != '' && recibido != '' && liberación != '' && solicitudActo != ''&& actoProtocolario !='')
  //{
   $.ajax({
    url:"{{ route('seguimiento.update_data') }}",
    method:"POST",
    data:{autRegistro:autRegistro, recibido:recibido, liberación:liberación, solicitudActo:solicitudActo, actoProtocolario:actoProtocolario, id:student_id,  _token:_token},
    dataType:"json",
    success:function(data)
    {
     $('#message').html(data);
     fetch_data();
    }

   });
  //}
  // else
  // {
  //  $('#message').html("<div class='alert alert-danger'>Both Fields are required</div>");
  // }
 });


});

</script>
