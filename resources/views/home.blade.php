@extends('layouts.app')

@section('content')
        <div class="col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading"><b>Bienvenido/a,</b> {{ Auth::user()->name}}
            
                </div>
                <div class="panel-body">
                 
{!! csrf_field() !!}
<div class="row">
    <div class='col-md-5'>
        <div class="form-group">
            <div class='input-group date' id='desde'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-5'>
        <div class="form-group">
            <div class='input-group date' id='hasta'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-2">
    	<button id="btnReport" class="btn btn-primary btn-xs" type="button">Buscar</button>
    </div>
</div>
<div class="row">
	<div id="chartContainer" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

</div>
                </div>
            </div>
        </div>


@endsection


@section('masterjs')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="/js/bootstrap-datetimepicker.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>



<script type="text/javascript">
var errores='';
function reporte(){
var dataChart=new Array();
	var _desde=$('#desde>input').val();
	var _hasta=$('#hasta>input').val();

						$.ajax({
						  method: "POST",
						  url: "/report",
						  data: { desde: _desde ,hasta:_hasta}
						})
						  .done(function( msg ) {
                                dataChart=msg.data;
                                if(dataChart.length==0){
                                    swal("Oops!", "No hay resultados", "warning");
                                }else{

                                                Highcharts.chart('chartContainer', {
                                                    chart: {
                                                        type: 'column'
                                                    },
                                                    title: {
                                                        text: 'Libros Publicados Por Categoria'
                                                    },
                                                    
                                                    xAxis: {
                                                        type: 'category',
                                                        labels: {
                                                            rotation: -45,
                                                            style: {
                                                                fontSize: '13px',
                                                                fontFamily: 'Verdana, sans-serif'
                                                            }
                                                        }
                                                    },
                                                    yAxis: {
                                                        min: 0,
                                                        title: {
                                                            text: 'Cantidad de Libros'
                                                        }
                                                    },
                                                    legend: {
                                                        enabled: false
                                                    },
                                                    tooltip: {
                                                        pointFormat: 'Libros Publicados: <b>{point.y:.1f} </b>'
                                                    },
                                                    series: [{
                                                        name: 'Libros',
                                                        data:
                                                            dataChart
                                                        ,
                                                        dataLabels: {
                                                            enabled: true,
                                                            rotation: -90,
                                                            color: '#FFFFFF',
                                                            align: 'right',
                                                            format: '{point.y:.0f}', // one decimal
                                                            y: 10, // 10 pixels down from the top
                                                            style: {
                                                                fontSize: '13px',
                                                                fontFamily: 'Verdana, sans-serif'
                                                            }
                                                        }
                                                    }]
                                                });



                                }


						  }).fail(function( objectError, textStatus ) {

						  		if( objectError.status == '422' ) {
								        errors = objectError.responseJSON;
								        
								        $.each( errors, function( key, value ) {
								            errores += value[0]+"\n";
								        });

								        if(errores.trim()!=""){
								        	 swal("Errores!", errores, "warning");
								        }
								}else{
									 swal("Error!", "Error de procesamiento "+objectError.status+ "\n"+objectError.statusText, "danger");
                                   
								}

							});
}

    $(function () {
        $('#desde').datetimepicker(
        		{ format:"YYYY-MM-DD"}
        	);
        $('#hasta').datetimepicker({
        	format:"YYYY-MM-DD",
            useCurrent: false //Important! See issue #1075
        });
        $("#desde").on("dp.change", function (e) {
            $('#hasta').data("DateTimePicker").minDate(e.date);
        });
        $("#hasta").on("dp.change", function (e) {
            $('#desde').data("DateTimePicker").maxDate(e.date);
        });


            $("#btnReport").on('click',function(){
            	reporte();
            });



    });



</script>

@endsection

@section('mastercss')
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
@endsection