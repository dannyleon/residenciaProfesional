@extends('students.index')
@section('title', '- Estadística')
@section('content2')

<section class="no-margin">

<div class="contenedor-campos">
  <div class="campo">
    <select id="periodoTIT" class="form-control">
      <option disabled selected>Período Escolar</option>
      <option value="1"> ENERO-JUNIO </option>
      <option value="2"> AGOSTO-DICIEMBRE </option>
    </select>
</div>

  <div class="campo">
    <input type="number" id="añoTIT" class="form-control" placeholder="Año">
  </div>
</div>


<div class="enviar">
  <button type="submit" class="btn btn-primary" id="mostrar">Mostrar</button>
  <button type="submit" class="btn btn-primary" id="imprimir">Imprimir</button>
</div>

</section>

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="contenedor-de-tablas">

        {{-- <table class="table table-bordered table-hover">
          <thead>
            <tr>
            <th>No.Control</th>
            <th>Apellidos</th>
            <th>Nombre</th>
            <th>PeriodoIngreso</th>
            <th>AñoIngreso</th>
            <th>Proyecto</th>
            <th>PeriodoTIT</th>
            <th>AñoTIT</th>
            <th>FechaTIT</th>
            <th>Semestres Cursados</th>
            <th>Carrera</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table> --}}

      </div>
    </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">

$('#imprimir').on('click',function(){

  window.print();
});

  $('#mostrar').on('click',function()
  {
    var e = document.getElementById("periodoTIT");
    var periodoTIT = e.options[e.selectedIndex].value;
    var añoTIT = $("#añoTIT").val();

    if(periodoTIT == 1)
    {
      var periodoLetra = "Enero-Junio";
    }else {
      periodoLetra = "Agosto-Diciembre";
    }

    $.ajax({
      type: "GET",
      url : '{{URL::to('/titulados')}}',
      data:{ periodoTIT:periodoTIT, añoTIT:añoTIT },
      success:function(data){
        $('.contenedor-de-tablas').empty();

        console.log(data);

        //variables para contar hombres y mujeres de cada carrera
        var hombres = 0
        var mujeres = 0

        var html = `<div class="panel-heading">
                      <h4>Alumnos Titulados </h4>
                      <h6>${periodoLetra} ${añoTIT}</h6>
                      <br>
                    </div>`;


        var inicioTabla = '<table class="table table-bordered table-hover">';
        var carreraActualTitulo = `<h6>${data[0].carrera.nombre}</h6>`;
        var cabecera = `<tr>
        <th>No.Control</th>
        <th>Apellidos</th>
        <th>Nombre</th>
        <th>Periodo Ingreso</th>
        <th>Año Ingreso</th>
        <th>Proyecto</th>
        <th>PeriodoTIT</th>
        <th>AñoTIT</th>
        <th>FechaTIT</th>
        <th>Semestres Cursados</th>
        </tr>`;

        //cabecera de la tabla
        html += carreraActualTitulo
        html += inicioTabla
        html += cabecera

        var actualCarrera = data[0].carrera.nombre;

        for ( var key in data) {
          var actualStudent = data[key]

          if(actualStudent.carrera.nombre != actualCarrera){

            actualCarrera = actualStudent.carrera.nombre;
            carreraActualTitulo = `<h6>${actualStudent.carrera.nombre}</h6>`;

            var suma = mujeres + hombres
            html+=`
            <tr>
              <td>Hombres: ${hombres}</td>
              <td>Mujeres: ${mujeres}</td>
              <td>Total: ${suma}</td>
            </tr>`

            //cerrar tabla actual
            html+="</table>";
            //reiniciar contadores de mujeres y hombres
            hombres = 0;
            mujeres = 0;

            //crear nueva tabla
            html+='<table class="table table-bordered table-hover">';
            //repetir cabecera
            html += cabecera;
            html += carreraActualTitulo;
          }

          if (actualStudent.Sexo == 'hombre'){
            hombres++
          } else {
            mujeres++
          }

          //datos del alumno
          html+= `<tr>
                      <td>${actualStudent.NoControl}</td>
                      <td>${actualStudent.Apellidos}</td>
                      <td>${actualStudent.Nombre}</td>
                      <td>${actualStudent.PeriodoIngreso}</td>
                      <td>${actualStudent.AñoIngreso}</td>
                      <td>${actualStudent.seguimiento.metodo.nombre}</td>
                      <td>${actualStudent.PeriodoTitulación}</td>
                      <td>${actualStudent.AñoTitulación}</td>
                      <td>${actualStudent.seguimiento.actoProtocolario}</td>
                      <td>${actualStudent.SemestresCursados}</td>
                  </tr>`;

        }

        var suma = mujeres + hombres
        html+=`
        <tr>
          <td>Hombres: ${hombres}</td>
          <td>Mujeres: ${mujeres}</td>
          <td>Total: ${suma}</td>
        </tr>`

        //Cerrar ultima tabla
        html+= "</table>";

        //insertar en html
        $('.contenedor-de-tablas').append(html);

      //$('tbody').html(data);
      }

    });

  });

</script>

<script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

@endsection


{{-- <canvas id="myChart" width="400" height="400"></canvas> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>

{{-- <script type="text/javascript">

    var ctx = document.getElementById("myChart").getContext('2d');

    //var contenedor = document.getElementById("contenedor");

    var contenedor = $('#contenedor')[0];

    contenedor.addEventListener('click',function(){
      console.log('Click')
    });

    //contenedor.on('click',function(){console.log('Click')});

    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

</script> --}}
