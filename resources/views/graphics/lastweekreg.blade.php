@extends('layouts.app')

@section('htmlheader_title')
Registros Ultima Semama
@endsection


@section('main-content')

<div class="row">
	<div class="col-md-12">
		<!-- AREA CHART -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-line-chart">Registros Ultima Semama</i></h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<form class="form-inline col-md-12">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="exampleInputName2">Desde</label>
							<input type="date" class="form-control input-sm" id="vdesde">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail2">Hasta</label>
							<input type="date" class="form-control input-sm" id="vhasta">
						</div>
						<button type="button" id="dates" class="btn btn-primary">Generar Grafica</button>
						<!-- <button type='submit' class="btn btn-success" id="dates"><i class="fa fa-line-chart"></i>Generar Grafica</button> -->
					</form>
				</div>
				<div class="row">
					<div id="graphic1" class="col-md-11"></div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>


<script type="text/javascript">
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).ready(function(){

	$("#dates").click(function(){

		var vdesde= $("#vdesde").val();
		var vhasta= $("#vhasta").val();

		var dataString = "desde="+vdesde+"&hasta="+vhasta;

		$.ajax({
			type: "GET",
			url: "/lastweekreg/get",
			data: dataString,
			success: function(data){
					console.log(data);
					var chart = {
						chart: {
							renderTo: 'graphic1',
				            type: 'line'
				        },
				        title: {
				            text: 'Registros Ultima Semama'
				        },
				        xAxis: {
				            categories: [],
				            labels: {
				                style: {
				                    color: 'black',
				                    fontSize:'16px'
				                }
				            }
				        },
				        yAxis: {
				            title: {
				                text: 'N° de Registros'
				            }
				        },
				        plotOptions: {
				            line: {
				                dataLabels: {
				                    enabled: true
				                },
				                enableMouseTracking: false
				            }
				        },
				        series: [{
				            name: 'Cantidad de Registros',
				            data: []
				        }]
				    };

				var series = [];
				var categories = [];

				var array = $.map(data, function(value, index) {
					[value];
				});
				var a = data.length;
				for(var i=0; i<a; i++){
					categories.push(data[i]["date_format(`fecha_registro`,'%m-%d-%Y')"]);
					series.push(parseInt(data[i]["count(date_format(`fecha_registro`,'%m-%d-%Y'))"]));
				};
				console.log('categorias');
				console.log(categories);
				console.log('series: ');
				console.log(series);

				 chart.series[0].data = series;
				 chart.xAxis.categories = categories;

				// console.log(chart);

				new Highcharts.Chart(chart);
			}
		});
	});
	



});
</script> <!-- your script -->
@endsection
