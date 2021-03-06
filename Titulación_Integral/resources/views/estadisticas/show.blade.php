@extends('students.inicio')
@section('title', '- Estadística')
@section('content2')

  @if(Session::has('alert2'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("No hay Alumnos Titulados en este Periodo y Año", "Agregue otro periodo y año", "error");
    </script>
  @endif

<section class="contenedor">

  <div class="barra-herramientas noprint">

    <div class="opciones-graficas">
      <label class="bold">Opciones de Gráficas:</label>

      <label class="radio-inline"><input type="radio" name="tipoGrafica" value="bar" id="graficaBarras" checked>Barras</label>
      <label class="radio-inline"><input type="radio" name="tipoGrafica" value="pie" id="graficaPastel">Pastel</label>

    </div>

    <h1>Estadística</h1>

    <div class="enviar enviar-estadistica noprint">
      <button type="submit" class="btn btn-primary" id="mostrar">Generar Tabla</button>
      <button type="submit" class="btn btn-primary" id="mostrarGrafica">Mostrar Gráfica</button>
      <button type="submit" class="btn btn-primary" id="ocultar" title="Ocultar Gráfica"onclick="ocultarGrafica()" ><i class="fas fa-minus-circle"></i></button>
      <button type="submit" class="btn btn-primary" id="imprimir" title="Imprimir"><i class="fas fa-print"></i></button>
    </div>

  </div>

    <div class="contenedor-campos noprint">
      <div class="campo">
        <select name= "periodoTIT" id="periodoTIT" class="form-control">
          <option disabled selected>Período Escolar</option>
          <option value="3"> AÑO COMPLETO </option>
          <option value="1"> ENERO-JUNIO </option>
          <option value="2"> AGOSTO-DICIEMBRE </option>

        </select>
    </div>

      <div class="campo">
        <input type="number" name="añoTIT" id="añoTIT" class="form-control" placeholder="Año">
      </div>

      <div class="campo">
        <select name="carrera" id="carrera" class="form-control">
          <option value="">Selecciona una Carrera</option>
          <option value="0"> TODAS LAS CARRERAS </option>
          @foreach ($carrera as $carrera => $value)
          <option value="{{ $carrera }}"> {{ $value }} </option>
          @endforeach
        </select>
      </div>

    </div>

    <canvas class="contenedor-grafica" id="myChart"></canvas>

</section>

<div class="contenedor">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="contenedor-de-tablas" id="tablas">


      </div>
    </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- CDN myChartjs-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>


<script type="text/javascript">

  $('#imprimir').on('click',function(){
    window.print();
  });

  // Get the input field
  var input = document.getElementById("añoTIT");
  var input2 = document.getElementById("periodoTIT");

  // Execute a function when the user releases a key on the keyboard
  input.addEventListener("keyup", function(event) {
    // Number 13 is the "Enter" key on the keyboard
    if (event.keyCode === 13) {
      // Cancel the default action, if needed
      event.preventDefault();
      // Trigger the button element with a click
      document.getElementById('mostrar').click();
    }

  });

  input2.addEventListener("keyup", function(event) {
    // Number 13 is the "Enter" key on the keyboard
    if (event.keyCode === 13) {
      // Cancel the default action, if needed
      event.preventDefault();
      // Trigger the button element with a click
      document.getElementById('mostrar').click();
    }
  });

  var canvas = document.getElementById("myChart");
  var ocultar = document.getElementById("ocultar");
  ocultar.style.display = "none";
  canvas.style.display = "none";

  function ocultarGrafica() {
    document.getElementById("myChart").style.display = "none";
    $('#ocultar').fadeOut();
  }


  $('#mostrarGrafica').on('click',function(){

      canvas.style.display = "block";
      $('#ocultar').fadeIn();

      var p = document.getElementById("periodoTIT");
      var c = document.getElementById("carrera");

      var tipoGrafica = document.querySelector('input[name="tipoGrafica"]:checked').value;

      var periodoTIT = p.options[p.selectedIndex].value;
      var carrera = c.options[c.selectedIndex].value;
      var añoTIT = $("#añoTIT").val();

      var periodoLetra = "";

      if(periodoTIT == 1){
        periodoLetra = "Enero-Junio ";

      }else if (periodoTIT == 2) {
        periodoLetra = "Agosto-Diciembre ";

      }else {
        periodoLetra = "";

      }


      $.ajax({
        type: "GET",
        url : '{{URL::to('/GraficaTitulados')}}',
        data:{ periodoTIT:periodoTIT, añoTIT:añoTIT, carrera:carrera },
        success:function(data){

          console.log(data);

          var myChart = document.getElementById('myChart').getContext('2d');

          //Estilos y opciones Globales
          Chart.defaults.global.defaultFontFamily = 'Lato';
          // Chart.defaults.global.defaultFontSize = 16;
          Chart.defaults.global.defaultFontColor = '#777';

          //Si la grafica de es Barras
          if(tipoGrafica =='bar'){

            if(window.bar != undefined)
              window.bar.destroy();
              window.bar = new Chart(myChart, {
                type:tipoGrafica, //bar,horizontalBar, pie, line, doughnut
                data:{
                  labels:data.carreras,
                  datasets:[{
                    label:'Titulados',
                    data:data.cantidadTitulados,
                    backgroundColor:[

                      'rgb(8, 105, 41)', //Administración - Verde
                      'rgb(238, 126, 45)', //Arquitectura - Anaranjado
                      'rgb(251, 234, 0)', //Contador Público - Amarillo
                      'rgb(255, 255, 255)', //Ingeniería Ambiental - Blanco
                      'rgb(255, 255, 255)', //Ingeniería Biomédica - Blanco
                      'rgb(255, 255, 255)', //Ingeniería Bioquímica - Blanco
                      'rgb(118, 060, 040)', //Ingeniería Civil - Café

                      'rgb(010, 010, 010)', //Ingeniería Electromecánica - Negro
                      'rgb(204, 006, 005)', //Ingeniería Electrónica - Rojo
                      'rgb(010, 010, 010)', //Ingeniería Aeronáutica - Negro
                      'rgb(156, 156, 156)', //Ingeniería Diseño Industrial - Gris
                      'rgb(250, 210, 001)', //Ingeniería Gestión Empresarial - Dorado
                      'rgb(108, 070, 117)', //Ingeniería Informática - Morado
                      'rgb(234, 137, 154)', //Ingeniería Logística - Rosa

                      'rgb(048, 132, 070)', //Ingeniería Nanotecnología - Verde Claro
                      'rgb(034, 113, 179)', //Ingeniería Sistemas Computacionales - Azul
                      'rgb(108, 070, 117)', //Ingeniería TICS - Morado
                      'rgb(156, 156, 156)', //Ingeniería Industrial - Gris
                      'rgb(255, 255, 255)', //Ingeniería Química - Blanco
                      'rgb(010, 010, 010)', //Ingeniería Mecánica - Negro

                    ],
                    borderWidth:1,
                    borderColor:'#777',
                    hoverBorderColor:'#000'
                  }],
                },
                options:{

                  title:{
                    display:true,
                    text:'Alumnos Titulados en '+ periodoLetra + añoTIT,
                    fontSize:25
                  },
                  legend:{
                    position:'right'
                  },
                  layout:{

                  },
                  tooltips:{
                    enabled:true,
                  },
                  scales:{
                    yAxes:[{
                      ticks:{
                        min:0,
                        max: data.max
                      }
                    }]
                  }


                }

              });//Cierre grafica de barras FIX

          }//Cierre if grafica es Barra

          //Si es Grafica de Pastel
          else {

            if(window.bar != undefined)
              window.bar.destroy();
              window.bar = new Chart(myChart, {
                type:tipoGrafica, //bar,horizontalBar, pie, line, doughnut
                data:{
                  labels:data.carreras,
                  datasets:[{
                    label:'Titulados',
                    data:data.cantidadTitulados,
                    backgroundColor:[

                      'rgb(8, 105, 41)', //Administración - Verde
                      'rgb(238, 126, 45)', //Arquitectura - Anaranjado
                      'rgb(251, 234, 0)', //Contador Público - Amarillo
                      'rgb(255, 255, 255)', //Ingeniería Ambiental - Blanco
                      'rgb(255, 255, 255)', //Ingeniería Biomédica - Blanco
                      'rgb(255, 255, 255)', //Ingeniería Bioquímica - Blanco
                      'rgb(118, 060, 040)', //Ingeniería Civil - Café

                      'rgb(010, 010, 010)', //Ingeniería Electromecánica - Negro
                      'rgb(204, 006, 005)', //Ingeniería Electrónica - Rojo
                      'rgb(010, 010, 010)', //Ingeniería Aeronáutica - Negro
                      'rgb(156, 156, 156)', //Ingeniería Diseño Industrial - Gris
                      'rgb(250, 210, 001)', //Ingeniería Gestión Empresarial - Dorado
                      'rgb(108, 070, 117)', //Ingeniería Informática - Morado
                      'rgb(234, 137, 154)', //Ingeniería Logística - Rosa

                      'rgb(048, 132, 070)', //Ingeniería Nanotecnología - Verde Claro
                      'rgb(034, 113, 179)', //Ingeniería Sistemas Computacionales - Azul
                      'rgb(108, 070, 117)', //Ingeniería TICS - Morado
                      'rgb(156, 156, 156)', //Ingeniería Industrial - Gris
                      'rgb(255, 255, 255)', //Ingeniería Química - Blanco
                      'rgb(010, 010, 010)', //Ingeniería Mecánica - Negro

                    ],
                    borderWidth:1,
                    borderColor:'#777',
                    hoverBorderColor:'#000'
                  }],
                },
                options:{

                  title:{
                    display:true,
                    text:'Alumnos Titulados en '+ periodoLetra + añoTIT,
                    fontSize:25

                  },
                  legend:{
                    position:'right'
                  },
                  layout:{

                  },
                  tooltips:{
                    enabled:true,
                  }
                }

              });//Cierre grafica de barras FIX

          }

        }//cierre success

      });//cierra ajax

  }); //cierre mostrarGrafica

  $('#mostrar').on('click',function()
  {

    var p = document.getElementById("periodoTIT");
    var c = document.getElementById("carrera");

    var periodoTIT = p.options[p.selectedIndex].value;
    var carrera = c.options[c.selectedIndex].value;
    var añoTIT = $("#añoTIT").val();

    var periodoLetra = "";

    if(periodoTIT == 1){
      periodoLetra = "Enero-Junio";

    }else if (periodoTIT == 2) {
      periodoLetra = "Agosto-Diciembre";

    }else {
      periodoLetra = "";
    }

    $.ajax({
      type: "GET",
      url : '{{URL::to('/titulados')}}',
      data:{ periodoTIT:periodoTIT, añoTIT:añoTIT, carrera:carrera },
      success:function(data){

        console.log(data);

        if(data.length > 0){

          $('.contenedor-de-tablas').empty();

          //variables para contar hombres y mujeres de cada carrera
          var hombres = 0;
          var mujeres = 0;

          //variables para contar hombres, mujeres y el total de un periodo determinado
          var hombresTotal = 0;
          var mujeresTotal = 0;
          var totalPeriodo = 0;

          var html = `<div class="panel-heading">
                        <h2 class="bold">Alumnos Titulados </h2>
                        <h4>${periodoLetra} ${añoTIT}</h4>
                        <br>
                      </div>`;


          var carreraActualTitulo = `<h4 class="capitalize titulo-color">${data[0].carrera.nombre}</h4>`;
          var inicioTabla = '<table class="table table-hover">';
          var cabecera = `<tr>
          <th>No.Control</th>
          <th>Apellidos</th>
          <th>Nombre</th>
          <th style="text-align:center">Periodo Ingreso</th>
          <th style="text-align:center">Año Ingreso</th>
          <th style="text-align:center">Proyecto</th>
          <th style="text-align:center">Periodo Titulación</th>
          <th style="text-align:center">Año Titulación</th>
          <th style="text-align:center">Fecha Titulación</th>

          </tr>`;

          //cabecera de la tabla
          html += carreraActualTitulo
          html += inicioTabla
          html += cabecera

          var actualCarrera = data[0].carrera.nombre;

          for ( var key in data) {

            var actualStudent = data[key]

            if(actualStudent.carrera.nombre != actualCarrera) {

              actualCarrera = actualStudent.carrera.nombre;
              carreraActualTitulo = `<h4 class="capitalize titulo-color">${actualStudent.carrera.nombre}</h4>`;

              var suma = mujeres + hombres;

              //sumatoria de titulados el periodo seleccionado
              mujeresTotal += mujeres;
              hombresTotal += hombres;
              totalPeriodo += suma;


              html+=`
              <tr class = "totalCarrera">
                <td>H: ${hombres}</td>
                <td>M: ${mujeres}</td>
                <td>Total: ${suma}</td>
              </tr>`

              //cerrar tabla actual
              html+="</table>";

              //reiniciar contadores de mujeres y hombres
              hombres = 0;
              mujeres = 0;

              //crear nueva tabla
              html+='<table class="table table-hover">';
              //repetir cabecera
              html += cabecera;
              html += carreraActualTitulo;

            } //cierre if

            if (actualStudent.Sexo == 'hombre'){

              hombres++;

            }else{

                mujeres++;

              }

            //datos del alumno
            html+= `<tr>
                        <td>${actualStudent.NoControl}</td>
                        <td>${actualStudent.Apellidos}</td>
                        <td>${actualStudent.Nombre}</td>
                        <td style="text-align:center">${actualStudent.PeriodoIngreso}</td>
                        <td style="text-align:center">${actualStudent.AñoIngreso}</td>
                        <td style="text-align:center">${actualStudent.seguimiento.metodo.nombre}</td>
                        <td style="text-align:center">${actualStudent.PeriodoTitulación}</td>
                        <td style="text-align:center">${actualStudent.AñoTitulación}</td>
                        <td style="text-align:center">${actualStudent.seguimiento.actoProtocolario}</td>
                    </tr>`;

          } //cierre ciclo


          var suma = mujeres + hombres;

          //sumatoria de titulados el periodo seleccionado
          mujeresTotal += mujeres;
          hombresTotal += hombres;
          totalPeriodo += suma;

          html+=`
          <tr class= "totalCarrera">
            <td>H: ${hombres}</td>
            <td>M: ${mujeres}</td>
            <td>Total: ${suma}</td>
          </tr>`

          //Cerrar ultima tabla
          html+= "</table>";

          html+= `
          <div class ="totalTitulados">
            <p> Total Hombres: ${hombresTotal} </p>
            <p> Total Mujeres: ${mujeresTotal} </p>
            <p> Total: ${totalPeriodo} </p>
          </div>`

          hombresTotal = 0;
          mujeresTotal = 0;
          totalPeriodo = 0;

          //insertar en html
          $('.contenedor-de-tablas').append(html);

          //$('tbody').html(data);

        }else {
          swal("No hay Alumnos Titulados con los Parámetros Seleccionados", "Alimente otros datos","warning");
        }

    } //cierre succes function

  }); //cierre ajax

}); //cierre funcion mostrar

</script>

<script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

@endsection
