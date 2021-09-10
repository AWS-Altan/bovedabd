@extends('layouts.app')


@section('content')
<div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="panel panel-default">
                    <div class="panel-heading my-2">Reporte Adminitrsación de Usuarios </div>
                    <!-- Vigencia del reporte -->
                    <div class="col-sm-2 mb-20">
                        <label class="help-block text-left">Fecha Inicio:</label>
                    </div>
                    <div class="col-sm-4 mb-20 select select-group" >
                        <input type='date' id="txtDateini" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                        <div class="help-block with-errors" id="inputTxtDateError"></div>
                    </div>
                    <!-- Vigencia del reporte -->
                    <div class="col-sm-2 mb-20">
                        <label class="help-block text-left">Fecha Final:</label>
                    </div>
                    <div class="col-sm-4 mb-20 select select-group" >
                        <input type='date' id="txtDatefin" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                        <div class="help-block with-errors" id="inputTxtDateError"></div>
                    </div>
                    <div class="col-sm-2 mb-20">
                        <button id="cboBusqueda" class="btn btn-primary btn-xs">Actualizar Reporte</button>
                    </div>

                    <div class="col-lg-8">
                        <canvas id="userChart" class="rounded shadow"></canvas>
                    </div>

              </div>
          </div>
      </div>
  </div>
@endsection

@section('jsfree')

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- CHARTS -->
<script>
    var ctx = document.getElementById('userChart').getContext('2d');
    var cJL_chart = new Chart(ctx,
    {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data:
        {
            labels:  {!!json_encode($cJL_chart->labels)!!} ,
            datasets:
            [
                {
                    label: 'Count of ages',
                    backgroundColor: {!! json_encode($cJL_chart->colours)!!} ,
                    data:  {!! json_encode($cJL_chart->dataset)!!} ,
                },
            ]
        },
// Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>

@endsection
