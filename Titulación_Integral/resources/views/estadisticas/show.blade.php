@extends('layouts.app')
@section('title', 'Estadística')
@section('content')

  <br>
  <div class="input-group">
     <select id="periodoTIT" class="form-control">
       <option disabled selected>Período Escolar</option>
       <option value="1"> ENERO-JUNIO </option>
       <option value="2"> AGOSTO-DICIEMBRE </option>
    </select>
    &nbsp;&nbsp; * &nbsp;&nbsp;
    <input type="number" id="añoTIT" class="form-control" placeholder="Año">
 </div>
 <br>
 <button class="btn btn-outline-success my-2 my-sm-0" id="mostrar" type="submit">Buscar</button>
 <br>


<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>Alumnos Titulados </h3>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-hover">
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
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
    </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">

  $('#mostrar').on('click',function()
  {
    var e = document.getElementById("periodoTIT");
    var periodoTIT = e.options[e.selectedIndex].value;
    var añoTIT = $("#añoTIT").val();
    console.log(periodoTIT);
    console.log(añoTIT);


    $.ajax({
      type: "GET",
      url : '{{URL::to('/titulados')}}',
      data:{ periodoTIT:periodoTIT, añoTIT:añoTIT },
      success:function(data){

      $('tbody').html(data);

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
