
{{-- <form class="form-group" method="POST" action="/students/{{$student->id}}"  enctype="multipart/form-data">
  @method('PUT')
  @csrf --}}

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

        <tr>
          <td>{{$student->seguimiento->autRegistro}}</td>
          <td>{{$student->seguimiento->recibido}}</td>
          <td><input type="date" name="liberación"></td>
          <td><input type="date" name="solicitudActo"></td>
          <td><input type="date" name="actoProtocolario"></td>
          <td contenteditable="true" class="date-selector"></td>
        </tr>

      </table>

      {{ csrf_field() }}
  </div>

    <button class="btn btn-primary">Actualizar</button>
{{-- </form> --}}

<script type="text/javascript">

$(document).ready(function(){

  fetch_data();

  function fetch_data()
  {
   $.ajax({
    url:"/fetch_data",
    type: "get",
    //dataType:"json",
    data:{id:student.id},

    success:function(response)
    {
      if(data=="success")
      alert(response);
      console.log("Soy el amo");
     // var html = '';
     // html += '<tr>';
     // html += '<td contenteditable id="first_name"></td>';
     // html += '<td contenteditable id="last_name"></td>';
     // html += '<td><button type="button" class="btn btn-success btn-xs" id="add">Add</button></td></tr>';

     // for(var count=0; count < data.length; count++)
     // {
     //  html +='<tr>';
     //  html +='<td contenteditable class="column_name" data-column_name="autRegistro" data-id="'+data[count].id+'">'+data[count].first_name+'</td>';
     //  html += '<td contenteditable class="column_name" data-column_name="recibido" data-id="'+data[count].id+'">'+data[count].last_name+'</td>';
     //  html += '<td contenteditable class="column_name" data-column_name="liberación" data-id="'+data[count].id+'">'+data[count].last_name+'</td>';
     //  html += '<td contenteditable class="column_name" data-column_name="solicitudActo" data-id="'+data[count].id+'">'+data[count].last_name+'</td>';
     //  html += '<td contenteditable class="column_name" data-column_name="actoProtocolario" data-id="'+data[count].id+'">'+data[count].last_name+'</td>';
     //  html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].id+'">Delete</button></td></tr>';
     // }
     //
     // <tr>
     //   <td>{$student->seguimiento->autRegistro}</td>
     //   <td>{$student->seguimiento->recibido}</td>
     //   <td><input type="date" name="liberación"></td>
     //   <td><input type="date" name="solicitudActo"></td>
     //   <td><input type="date" name="actoProtocolario"></td>
     //   <td contenteditable="true" class="date-selector"></td>
     // </tr>
     //
     // $('tbody').html(html);
   },
   error: function(response){
    alert('Error'+response);
    }

   });
  }

});

</script>
